<?php


namespace AlgoWeb\PODataLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Mockery\Mock;

abstract class ModelReflectionHelper
{
    protected static $relTypes = [
        'hasMany',
        'hasManyThrough',
        'belongsToMany',
        'hasOne',
        'belongsTo',
        'morphOne',
        'morphTo',
        'morphMany',
        'morphToMany',
        'morphedByMany'
    ];

    /**
     * @param  \ReflectionMethod         $method
     * @return string
     */
    public static function getCodeForMethod(\ReflectionMethod $method) : string
    {
        $fileName = $method->getFileName();

        $file = new \SplFileObject($fileName);
        $file->seek($method->getStartLine() - 1);
        $code = '';
        while ($file->key() < $method->getEndLine()) {
            $code .= $file->current();
            $file->next();
        }

        $code = trim(preg_replace('/\s\s+/', '', $code));
        $begin = strpos($code, 'function(');
        $code = substr($code, $begin, strrpos($code, '}') - $begin + 1);
        return $code;
    }

    /**
     * @param  Model $model
     * @return array
     */
    public static function getModelClassMethods(Model $model):array
    {
        // TODO: Handle case when Mock::class not present
        return array_diff(
            get_class_methods($model),
            get_class_methods(Model::class),
            get_class_methods(Mock::class),
            get_class_methods(MetadataTrait::class)
        );
    }

    /**
     * @param Model $model
     * @return array|string[]
     * @throws \ReflectionException
     */
    public static function getRelationshipsFromMethods(Model $model): array
    {
        $relationships = [];
        $methods = self::getModelClassMethods($model);
        foreach ($methods as $method) {
            //Use reflection to inspect the code, based on Illuminate/Support/SerializableClosure.php
            $reflection = new \ReflectionMethod($model, $method);
            $code = self::getCodeForMethod($reflection);
            foreach (static::$relTypes as $relation) {
                //Resolve the relation's model to a Relation object.
                if (
                    !stripos($code, sprintf('$this->%s(', $relation)) ||
                    !(($relationObj = $model->$method()) instanceof Relation) ||
                    !in_array(MetadataTrait::class, class_uses($relationObj->getRelated()))
                ) {
                    continue;
                }
                $relationships[]= $method;
            }
        }
        return $relationships;
    }
}
