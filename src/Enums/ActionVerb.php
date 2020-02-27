<?php

namespace AlgoWeb\PODataLaravel\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static ActionVerb READ()
 * @method static ActionVerb CREATE()
 * @method static ActionVerb UPDATE()
 * @method static ActionVerb DELETE()
 */
class ActionVerb extends Enum
{
    public const CREATE = 'create';
    public const READ = 'read';
    public const UPDATE = 'update';
    public const DELETE = 'delete';
}
