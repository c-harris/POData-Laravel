<?php

declare(strict_types=1);

namespace Tests\Legacy\AlgoWeb\PODataLaravel\Unit\Serialisers;

use AlgoWeb\PODataLaravel\Serialisers\ModelSerialiser;
use Tests\Legacy\AlgoWeb\PODataLaravel\Facets\Models\TestCastModel;
use Tests\Legacy\AlgoWeb\PODataLaravel\Facets\Models\TestGetterModel;
use Tests\Legacy\AlgoWeb\PODataLaravel\Facets\Models\TestModel;
use Tests\Legacy\AlgoWeb\PODataLaravel\TestCase as TestCase;

class ModelSerialiserTest extends TestCase
{
    private $serialiser;

    public function setUp(): void
    {
        parent::setUp();
        $this->serialiser = new ModelSerialiser();
    }

    public function tearDown(): void
    {
        self::resetModelSerialiser($this->serialiser);
    }


    public function testBulkSerialiseBasicModel()
    {
        $meta          = [];
        $meta['id']    = ['type' => 'integer', 'nullable' => false, 'fillable' => false, 'default' => null];
        $meta['name']  = ['type' => 'string', 'nullable' => false, 'fillable' => true, 'default' => null];
        $meta['photo'] = ['type' => 'blob', 'nullable' => true, 'fillable' => true, 'default' => null];

        $bar       = new TestModel($meta, null);
        $bar->id   = 1;
        $bar->name = 'model';

        $foo = new ModelSerialiser();

        $expected = [];
        foreach ($meta as $key => $val) {
            $expected[$key] = $bar->{$key};
        }

        $actual = $foo->bulkSerialise($bar);
        $this->assertEquals($expected, $actual);
    }

    public function testBulkSerialiseWithSimpleGetter()
    {
        $meta               = [];
        $meta['name']       = ['type' => 'string', 'nullable' => false, 'fillable' => true, 'default' => null];
        $meta['weight']     = ['type' => 'integer', 'nullable' => false, 'fillable' => false, 'default' => null];
        $meta['code']       = ['type' => 'string', 'nullable' => false, 'fillable' => true, 'default' => null];
        $meta['WeightCode'] = ['type' => 'string', 'nullable' => false, 'fillable' => true, 'default' => null];
        $meta['added_at']   = ['type' => 'datetime', 'nullable' => false, 'fillable' => true, 'default' => null];

        $bar = new TestGetterModel($meta, null);

        $foo = new ModelSerialiser();

        $expected = [];
        foreach ($meta as $key => $val) {
            $expected[$key] = $bar->{$key};
        }

        $actual = $foo->bulkSerialise($bar);
        $this->assertEquals($expected, $actual);
    }

    public function testBulkSerialiseWithDateTimeAsDateTime()
    {
        $meta               = [];
        $meta['id']         = ['type' => 'integer', 'nullable' => false, 'fillable' => false, 'default' => null];
        $meta['name']       = ['type' => 'string', 'nullable' => false, 'fillable' => true, 'default' => null];
        $meta['photo']      = ['type' => 'blob', 'nullable' => true, 'fillable' => true, 'default' => null];
        $meta['created_at'] = ['type' => 'datetime', 'nullable' => true, 'fillable' => true, 'default' => null];

        $bar             = new TestGetterModel($meta, null);
        $bar->id         = 1;
        $bar->name       = 'model';
        $bar->created_at = new \DateTime('2015-11-10 09:08:07');

        $foo = new ModelSerialiser();

        $expected = [];
        foreach ($meta as $key => $val) {
            $expected[$key] = $bar->{$key};
        }
        $actual = $foo->bulkSerialise($bar);
        $this->assertEquals($expected, $actual);
    }

    public function testBulkSerialiseWithCast()
    {
        $meta            = [];
        $meta['id']      = ['type' => 'integer', 'nullable' => false, 'fillable' => false, 'default' => null];
        $meta['name']    = ['type' => 'string', 'nullable' => false, 'fillable' => true, 'default' => null];
        $meta['photo']   = ['type' => 'blob', 'nullable' => true, 'fillable' => true, 'default' => null];
        $meta['is_bool'] = ['type' => 'boolean', 'nullable' => true, 'fillable' => true, 'default' => null];

        $bar          = new TestCastModel($meta, null);
        $bar->id      = 1;
        $bar->name    = 'model';
        $bar->is_bool = 1;

        $foo = new ModelSerialiser();

        $expected = [];
        foreach ($meta as $key => $val) {
            $expected[$key] = $bar->{$key};
        }
        $actual = $foo->bulkSerialise($bar);
        $this->assertEquals($expected, $actual);
    }

    public function testBulkSerialiseWithCastFromRawAttributes()
    {
        $meta            = [];
        $meta['id']      = ['type' => 'integer', 'nullable' => false, 'fillable' => false, 'default' => null];
        $meta['name']    = ['type' => 'string', 'nullable' => false, 'fillable' => true, 'default' => null];
        $meta['photo']   = ['type' => 'blob', 'nullable' => true, 'fillable' => true, 'default' => null];
        $meta['is_bool'] = ['type' => 'boolean', 'nullable' => true, 'fillable' => true, 'default' => null];

        $bar     = new TestCastModel($meta, null);
        $attribs = ['id' => '1', 'name' => 'model', 'is_bool' => 1];
        $bar->setRawAttributes($attribs);

        $foo = new ModelSerialiser();

        $expected = [];
        foreach ($meta as $key => $val) {
            $expected[$key] = $bar->{$key};
        }
        $actual = $foo->bulkSerialise($bar);
        $this->assertEquals($expected, $actual);
        $this->assertTrue($expected['is_bool'] === $actual['is_bool']);
    }
}
