<?php
/**
 * Created by PhpStorm.
 * User: Barnso
 * Date: 20/09/2017
 * Time: 10:43 PM.
 */
namespace AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations;

use MyCLabs\Enum\Enum;

/**
 * Class AssociationType.
 *
 * @method static AssociationStubRelationType NULL_ONE_TO_NULL_ONE()
 * @method static AssociationStubRelationType ONE_TO_ONE()
 * @method static AssociationStubRelationType NULL_ONE_TO_ONE()
 * @method static AssociationStubRelationType MANY_TO_MANY()
 * @method static AssociationStubRelationType NULL_ONE_TO_MANY()
 * @method static AssociationStubRelationType ONE_TO_MANY()
 */
class AssociationType extends Enum
{
    public const NULL_ONE_TO_NULL_ONE = 1;
    public const ONE_TO_ONE = 2;
    public const NULL_ONE_TO_ONE = 3;
    public const MANY_TO_MANY = 4;
    public const NULL_ONE_TO_MANY = 5;
    public const ONE_TO_MANY = 6;
}
