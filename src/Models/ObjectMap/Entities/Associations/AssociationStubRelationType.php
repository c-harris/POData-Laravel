<?php

namespace AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations;

use MyCLabs\Enum\Enum;

/**
 * Class AssociationStubRelationType.
 *
 * @method static AssociationStubRelationType NULL_ONE()
 * @method static AssociationStubRelationType ONE()
 * @method static AssociationStubRelationType MANY()
 */
class AssociationStubRelationType extends Enum
{
    public const NULL_ONE = 1;
    public const ONE = 2;
    public const MANY = 4;
}
