<?php declare(strict_types=1);


namespace AlgoWeb\PODataLaravel\Models;

use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\Association;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\AssociationFactory;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\AssociationStubBase;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\AssociationStubMonomorphic;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\AssociationStubPolymorphic;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\EntityGubbins;
use POData\Common\InvalidOperationException;

class MetadataRelationshipContainer implements IMetadataRelationshipContainer
{
    /**
     * @var EntityGubbins[] all entities keyed by class name
     */
    private $entities = [];
    /**
     * @var AssociationStubBase[][][] AssociationStubMonomorphic keyed as [BaseClass][targetClass]
     */
    private $stubs = [
    ];
    /**
     * A Complete Set of Assocations Keyed by classname.
     *
     * @var Association[]
     */
    private $assocations = [];

    /**
     * Add entity to Container.
     *
     * @param EntityGubbins $entity
     */
    public function addEntity(EntityGubbins $entity): void
    {
        $baseType                  = $entity->getClassName();
        $this->entities[$baseType] = $entity;
        if (array_key_exists($baseType, $this->stubs)) {
            throw new \InvalidArgumentException(sprintf('%s already added', $baseType));
        }
        $this->stubs[$baseType] = [];
        foreach ($entity->getStubs() as $stub) {
            $this->stubs[$baseType][$stub->getTargType()][] = $stub;
        }
    }


    private function buildAssocations(): void
    {
        array_walk_recursive($this->stubs, [$this, 'buildAssocationFromStub']);
    }

    /**
     * @param  string                $baseType
     * @param  string                $targetType
     * @return AssociationStubBase[]
     */
    private function getStubs(?string $baseType, ?string $targetType): array
    {
        if ($baseType === null ||
           !array_key_exists($baseType, $this->stubs) ||
           !array_key_exists($targetType, $this->stubs[$baseType])) {
            return [];
        }
        return $this->stubs[$baseType][$targetType];
    }

    private function buildAssocationFromStub(AssociationStubBase $item)
    {
        $baseTypeCheck = ($item instanceof AssociationStubPolymorphic &&
            count($item->getThroughFieldChain()) == 3) ? null : $item->getBaseType();

        $otherCandidates = array_filter($this->getStubs($item->getTargType(), $baseTypeCheck), [$item, 'isCompatible']);
        $assocations     = array_reduce($otherCandidates,
            function ($carry, $candidate) use ($item) {
                $newAssocation = AssociationFactory::getAssocationFromStubs($candidate, $item);
                $carry[spl_object_hash($newAssocation)] = $newAssocation;
                return $carry;
            },
            []);
        $this->addAssocations($assocations);
    }

    private function addAssocations(array $additionals)
    {
        $this->assocations = array_merge($this->assocations, $additionals);
    }


    /**
     * returns all Relation Stubs that are permitted at the other end.
     *
     * @param $className
     * @param $relName
     * @return AssociationStubBase[]
     */
    public function getRelationsByRelationName(string $className, string $relName): array
    {
        $this->checkClassExists($className);
        if (!array_key_exists($relName, $this->entities[$className]->getStubs())) {
            $msg = 'Relation %s not registered on %s';
            throw new \InvalidArgumentException(sprintf($msg, $relName, $className));
        }

        if (empty($this->assocations)) {
            $this->buildAssocations();
        }
        $entites  = $this->entities[$className];
        $relation = $entites->getStubs()[$relName];
        return array_reduce($relation->getAssocations(), function ($carry, Association $item) use ($relation) {
            $carry[] = ($item->getFirst() === $relation) ? $item->getLast() : $item->getFirst();
            return $carry;
        }, []);
    }

    /**
     * gets All Association On a given class.
     *
     * @param  string        $className
     * @return Association[]
     */
    public function getRelationsByClass(string $className): array
    {
        if (empty($this->assocations)) {
            $this->buildAssocations();
        }

        $this->checkClassExists($className);
        return array_reduce($this->entities[$className]->getStubs(), function ($carry, AssociationStubBase $item) {
            return array_merge($carry, $item->getAssocations());
        }, []);
    }

    /**
     * @param string $className
     */
    protected function checkClassExists(string $className)
    {
        if (!$this->hasClass($className)) {
            $msg = '%s does not exist in holder';
            throw new \InvalidArgumentException(sprintf($msg, $className));
        }
    }
    /**
     * gets all defined Association.
     *
     * @throws InvalidOperationException
     * @return Association[]
     */
    public function getRelations(): array
    {
        if (empty($this->assocations)) {
            $this->buildAssocations();
        }
        return array_values($this->assocations);
    }

    /**
     * checks if a class is loaded into the relation container.
     *
     * @param  string $className
     * @return bool
     */
    public function hasClass(string $className): bool
    {
        return array_key_exists($className, $this->entities);
    }
}
