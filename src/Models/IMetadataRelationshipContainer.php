<?php declare(strict_types=1);

namespace AlgoWeb\PODataLaravel\Models;

use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\Association;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\AssociationStubBase;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\EntityGubbins;
use POData\Common\InvalidOperationException;

interface IMetadataRelationshipContainer
{
    /**
     * Add entity to Container.
     *
     * @param EntityGubbins $entity
     * @throws InvalidOperationException
     */
    public function addEntity(EntityGubbins $entity): void ;

    /**
     * returns all Relation Stubs that are permitted at the other end.
     *
     * @param $className
     * @param $relName
     * @return AssociationStubBase[]
     */
    public function getRelationsByRelationName(string $className, string $relName): array;

    /**
     * gets All Association On a given class.
     *
     * @param string $className
     * @return Association[]
     * @throws InvalidOperationException
     */
    public function getRelationsByClass(string $className): array;

    /**
     * gets all defined Association
     *
     * @return Association[]
     * @throws InvalidOperationException
     */
    public function getRelations(): array;

    /**
     * checks if a class is loaded into the relation container
     *
     * @param string $className
     * @return bool
     */
    public function hasClass(string $className): bool ;
}