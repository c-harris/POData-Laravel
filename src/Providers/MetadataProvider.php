<?php

declare(strict_types=1);

namespace AlgoWeb\PODataLaravel\Providers;

use AlgoWeb\PODataLaravel\Models\ClassReflectionHelper;
use AlgoWeb\PODataLaravel\Models\IMetadataRelationshipContainer;
use AlgoWeb\PODataLaravel\Models\MetadataRelationshipContainer;
use AlgoWeb\PODataLaravel\Models\MetadataTrait;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\AssociationMonomorphic;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\AssociationStubRelationType;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\Associations\AssociationType;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\EntityField;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\EntityFieldType;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Entities\EntityGubbins;
use AlgoWeb\PODataLaravel\Models\ObjectMap\Map;
use Cruxinator\ClassFinder\ClassFinder;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Support\Str;
use POData\Common\InvalidOperationException;
use POData\Providers\Metadata\ResourceEntityType;
use POData\Providers\Metadata\ResourceStreamInfo;
use POData\Providers\Metadata\SimpleMetadataProvider;
use POData\Providers\Metadata\Type\TypeCode;

class MetadataProvider extends MetadataBaseProvider
{
    use MetadataProviderStepTrait;

    /** @var array<array>  */
    protected $multConstraints      = ['0..1' => ['1'], '1' => ['0..1', '*'], '*' => ['1', '*']];
    /** @var string  */
    protected static $metaNAMESPACE = 'Data';
    /** @var bool */
    protected static $isBooted      = false;
    const POLYMORPHIC               = 'polyMorphicPlaceholder';
    const POLYMORPHIC_PLURAL        = 'polyMorphicPlaceholders';

    /**
     * @var Map The completed object map set at post Implement;
     */
    private $completedObjectMap;

    /**
     * @return \AlgoWeb\PODataLaravel\Models\ObjectMap\Map
     */
    public function getObjectMap()
    {
        return $this->completedObjectMap;
    }


    public function __construct($app)
    {
        parent::__construct($app);
        self::$isBooted = false;
    }

    /**
     * Bootstrap the application services.  Post-boot.
     *
     * @throws InvalidOperationException
     * @throws \ReflectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     * @return void
     */
    public function boot()
    {
        App::forgetInstance('metadata');
        App::forgetInstance('objectmap');

        self::$metaNAMESPACE = env('ODataMetaNamespace', 'Data');
        // If we aren't migrated, there's no DB tables to pull metadata _from_, so bail out early
        try {
            if (!Schema::hasTable(strval(config('database.migrations')))) {
                return;
            }
        } catch (\Exception $e) {
            return;
        }

        $isCaching = true === $this->getIsCaching();
        $meta      = Cache::get('metadata');
        $objectMap = Cache::get('objectmap');
        $hasCache  = null != $meta && null != $objectMap;

        if ($isCaching && $hasCache) {
            App::instance('metadata', $meta);
            App::instance('objectmap', $objectMap);
            self::$isBooted = true;
            return;
        }
        $meta = App::make('metadata');

        $this->completedObjectMap = $meta->completedObjectMap;
        $key                      = 'metadata';
        $objKey                   = 'objectmap';
        $this->handlePostBoot($isCaching, $hasCache, $key, $meta);
        $this->handlePostBoot($isCaching, $hasCache, $objKey, $this->completedObjectMap);
        self::$isBooted = true;
    }

    /**
     * Register the application services.  Boot-time only.
     *
     * @return void
     */
    public function register()
    {
        $this->app->/* @scrutinizer ignore-call */singleton('metadata', function () {
            return new OdataSimpleMetadata('Data', self::$metaNAMESPACE);
        });
        $this->app->/* @scrutinizer ignore-call */singleton('objectmap', function () {
            return new Map();
        });
    }

    /**
     * @return IMetadataRelationshipContainer|null
     */
    public function getRelationHolder(): ?IMetadataRelationshipContainer
    {
        return $this->relationHolder;
    }

    public function isRunningInArtisan(): bool
    {
        return App::runningInConsole() && !App::runningUnitTests();
    }
}
