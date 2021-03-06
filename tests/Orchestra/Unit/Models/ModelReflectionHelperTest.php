<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/03/20
 * Time: 1:53 PM.
 */
namespace AlgoWeb\PODataLaravel\Orchestra\Tests\Unit\Models;

use AlgoWeb\PODataLaravel\Models\ModelReflectionHelper;
use AlgoWeb\PODataLaravel\Orchestra\Tests\Models\OrchestraBelongsToTestModel;
use AlgoWeb\PODataLaravel\Orchestra\Tests\Models\OrchestraPolymorphToManySourceMalformedModel;
use AlgoWeb\PODataLaravel\Orchestra\Tests\Models\RelationTestDummyModel;
use AlgoWeb\PODataLaravel\Orchestra\Tests\TestCase;
use Mockery as m;

class ModelReflectionHelperTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testGetCodeForSingleLineMethod()
    {
        $foo    = new OrchestraPolymorphToManySourceMalformedModel();
        $reflec = new \ReflectionClass($foo);

        $method = $reflec->getMethod('sourceChildren');

        $expected = 'public function sourceChildren() { return $this->morphToMany'
                    .'(OrchestraPolymorphToManyTestModel::class, \'manyable\', \'test_manyables\', \'manyable_id\','
                    .' \'many_id\'); }';
        $actual = ModelReflectionHelper::getCodeForMethod($method);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetCodeForSingleLineMethodJustAfterAnotherMethod()
    {
        $foo    = new OrchestraPolymorphToManySourceMalformedModel();
        $reflec = new \ReflectionClass($foo);

        $method = $reflec->getMethod('child');

        $expected = 'public function child() { return $this->morphMany(OrchestraMorphToTestModel::class, \'morph\');}';
        $actual   = ModelReflectionHelper::getCodeForMethod($method);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetCodeForMethodContainingAnonymousFunction()
    {
        $foo    = new OrchestraPolymorphToManySourceMalformedModel();
        $reflec = new \ReflectionClass($foo);

        $method = $reflec->getMethod('voodooChild');

        $expected = 'function(){return $this->morphMany(OrchestraMorphToTestModel::class, \'morph\');'.PHP_EOL
                .'})();}';
        $actual = ModelReflectionHelper::getCodeForMethod($method);
        $this->assertEquals($expected, $actual);
    }

    public function testMockedClassMethods()
    {
        $expected = [0 => 'parent'];

        $foo = m::mock(OrchestraBelongsToTestModel::class)->makePartial();

        $actual = ModelReflectionHelper::getModelClassMethods($foo);
        $this->assertEquals($expected, $actual);
    }

    public function testProblematicMethodExcluded()
    {
        $foo = new RelationTestDummyModel();

        $expected = [];
        $actual = ModelReflectionHelper::getRelationshipsFromMethods($foo);

        $this->assertEquals($expected, $actual);
    }

    public function testMethodWhitelistOverlap()
    {
        $foo = new RelationTestDummyModel();
        $foo->bigReset();

        $expected = [0 => 'getRelationClassMethods', 1 => 'setRelationClassMethods', 2 => 'bigReset',
            3 => 'polyglotFkKeyAccess', 4 => 'polyglotRkKeyAccess', 5 => 'checkMethodNameListAccess'];
        $actual = ModelReflectionHelper::getModelClassMethods($foo);
        $this->assertEquals($expected, $actual);

        $foo->setVisible(['bigReset', 'foobar']);

        $expected = ['bigReset'];
        $actual = ModelReflectionHelper::getModelClassMethods($foo);
        $this->assertEquals($expected, $actual);
        $foo->bigReset();
    }
}
