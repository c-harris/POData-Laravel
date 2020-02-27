<?php

namespace AlgoWeb\PODataLaravel\Models\ObjectMap\Entities;

use MyCLabs\Enum\Enum;

/**
 * Class EntityFieldType.
 *
 * @method static EntityFieldPrimitiveType TARRAY()
 * @method static EntityFieldPrimitiveType SIMPLE_ARRAY()
 * @method static EntityFieldPrimitiveType JSON_ARRAY()
 * @method static EntityFieldPrimitiveType JSON()
 * @method static EntityFieldPrimitiveType BIGINT()
 * @method static EntityFieldPrimitiveType BOOLEAN()
 * @method static EntityFieldPrimitiveType DATETIME()
 * @method static EntityFieldPrimitiveType DATETIMETZ()
 * @method static EntityFieldPrimitiveType DATE()
 * @method static EntityFieldPrimitiveType TIME()
 * @method static EntityFieldPrimitiveType DECIMAL()
 * @method static EntityFieldPrimitiveType INTEGER()
 * @method static EntityFieldPrimitiveType OBJECT()
 * @method static EntityFieldPrimitiveType SMALLINT()
 * @method static EntityFieldPrimitiveType STRING()
 * @method static EntityFieldPrimitiveType TEXT()
 * @method static EntityFieldPrimitiveType BINARY()
 * @method static EntityFieldPrimitiveType BLOB()
 * @method static EntityFieldPrimitiveType FLOAT()
 * @method static EntityFieldPrimitiveType GUID()
 * @method static EntityFieldPrimitiveType DATEINTERVAL()
 */
class EntityFieldPrimitiveType extends Enum
{
    public const TARRAY = 'array';
    public const SIMPLE_ARRAY = 'simple_array';
    public const JSON_ARRAY = 'json_array';
    public const JSON = 'json';
    public const BIGINT = 'bigint';
    public const BOOLEAN = 'boolean';
    public const DATETIME = 'datetime';
    public const DATETIMETZ = 'datetimetz';
    public const DATE = 'date';
    public const TIME = 'time';
    public const DECIMAL = 'decimal';
    public const INTEGER = 'integer';
    public const OBJECT = 'object';
    public const SMALLINT = 'smallint';
    public const STRING = 'string';
    public const TEXT = 'text';
    public const BINARY = 'binary';
    public const BLOB = 'blob';
    public const FLOAT = 'float';
    public const GUID = 'guid';
    public const DATEINTERVAL = 'dateinterval';
}
