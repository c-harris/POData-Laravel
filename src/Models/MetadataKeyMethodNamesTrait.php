<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/02/20
 * Time: 4:22 AM.
 */
namespace AlgoWeb\PODataLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Mockery\Mock;
use POData\Common\InvalidOperationException;

trait MetadataKeyMethodNamesTrait
{
    /**
     * @param  Relation                  $foo
     * @throws InvalidOperationException
     * @return array|null
     */
    protected function getRelationsHasManyKeyNames(Relation $foo)
    {
        $thruName = $foo instanceof HasManyThrough ?
            $this->polyglotThroughKeyMethodNames($foo) :
            null;
        list($fkMethodName, $rkMethodName) = $this->polyglotKeyMethodNames($foo);
        return [$thruName, $fkMethodName, $rkMethodName];
    }

    /**
     * @param Relation $foo
     * @param mixed    $condition
     *
     * @throws InvalidOperationException
     * @return array
     */
    protected function polyglotKeyMethodNames(Relation $foo)
    {
        if ($foo instanceof BelongsTo) {
            // getForeignKey for laravel 5.5
            $fkList = ['getForeignKeyName', 'getForeignKey'];
            // getOwnerKeyName for laravel 5.5
            $rkList = ['getOwnerKey', 'getOwnerKeyName'];
        }elseif ($foo instanceof BelongsToMany) {
            $fkList = ['getForeignPivotKeyName'];
            $rkList = ['getRelatedPivotKeyName'];
        }elseif($foo instanceof HasOneOrMany){
            $fkList = ['getForeignKeyName'];
            $rkList = ['getLocalKeyName', 'getQualifiedParentKeyName'];
        }elseif($foo instanceof HasManyThrough) {
            $fkList = ['getQualifiedFarKeyName'];
            $rkList = ['getQualifiedParentKeyName'];
        }else{
            $msg = sprintf('Unknown Relationship Type %s', get_class($foo));
            throw new InvalidOperationException($msg);
        }
        $fkMethodName = $this->checkMethodNameList($foo, $fkList);

        $rkMethodName = $this->checkMethodNameList($foo, $rkList);

        return [$fkMethodName, $rkMethodName];
    }
    protected function polyglotFkKey(Relation $rel)
    {
        switch (true) {
            case $rel instanceof BelongsTo:
                return $rel->{$this->checkMethodNameList($rel, ['getForeignKeyName', 'getForeignKey'])}();
            case $rel instanceof BelongsToMany:
                return $rel->getForeignPivotKeyName();
            case $rel instanceof HasOneOrMany:
                return $rel->getForeignKeyName();
            case $rel instanceof HasManyThrough:
                $segments = explode('.', $rel->getQualifiedFarKeyName());
                return end($segments);
            default:
                $msg = sprintf('Unknown Relationship Type %s', get_class($rel));
                throw new InvalidOperationException($msg);
        }
    }
    protected function polyglotRkKey(Relation $rel)
    {
        switch (true) {
            case $rel instanceof BelongsTo:
                return $rel->{$this->checkMethodNameList($rel, ['getOwnerKey', 'getOwnerKeyName'])}();
            case $rel instanceof BelongsToMany:
                return $rel->getRelatedPivotKeyName();
            case $rel instanceof HasOneOrMany:
                $segments = explode('.', $rel->{$this->checkMethodNameList($rel, ['getLocalKeyName', 'getQualifiedParentKeyName'])}());
                return end($segments);
            case $rel instanceof HasManyThrough:
                $segments = explode('.', $rel->getQualifiedParentKeyName());
                return end($segments);
            default:
                $msg = sprintf('Unknown Relationship Type %s', get_class($rel));
                throw new InvalidOperationException($msg);
        }
    }

    protected function polyglotThroughKey(Relation $rel){
        if(! $rel instanceof HasManyThrough){
            return null;
        }
        $segments = explode('.', $rel->{$this->checkMethodNameList($rel, ['getThroughKey', 'getQualifiedFirstKeyName'])}());
        return end($segments);
    }

    /**
     * @param  HasManyThrough            $foo
     * @throws InvalidOperationException
     * @return string
     */
    protected function polyglotThroughKeyMethodNames(HasManyThrough $foo)
    {
        $thruList = ['getThroughKey', 'getQualifiedFirstKeyName'];

        return $this->checkMethodNameList($foo, $thruList);
    }

    /**
     * @param  Model $model
     * @return array
     */
    protected function getModelClassMethods(Model $model)
    {
        return array_diff(
            get_class_methods($model),
            get_class_methods(\Illuminate\Database\Eloquent\Model::class),
            //TODO: sandi what will happen if Mock is not installed (I.e. Production?)
            get_class_methods(Mock::class),
            get_class_methods(MetadataTrait::class)
        );
    }

    /**
     * @param  Relation                  $foo
     * @param  array                     $methodList
     * @throws InvalidOperationException
     * @return string
     */
    protected function checkMethodNameList(Relation $foo, array $methodList)
    {
        foreach ($methodList as $methodName) {
            if (method_exists($foo, $methodName)) {
                return $methodName;
            }
        }
        $msg = 'Expected at least 1 element in related-key list, got 0 for relation %s';
        throw new InvalidOperationException(sprintf($msg,get_class($foo)));
    }
}
