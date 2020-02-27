<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/02/20
 * Time: 1:08 PM.
 */
namespace AlgoWeb\PODataLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use POData\Common\InvalidOperationException;
use ReflectionException;

trait MetadataRelationsTrait
{
    /**
     * @var string[]|null a cache for the relationship names
     */
    private static $relationNames = null;

    /**
     * Get model's relationships.
     *
     * @throws InvalidOperationException
     * @throws ReflectionException
     * @return array
     */
    public function getRelationships()
    {
        return self::$relationNames = self::$relationNames ??
                                      ModelReflectionHelper::getRelationshipsFromMethods(/* @scrutinizer ignore-type */$this);
    }
}
