<?php namespace League\Fractal\Test;

use League\Fractal\Manager;
use League\Fractal\Scope;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class TransformerAbstractTest extends TestCase
{
    /**
     * @covers \League\Fractal\TransformerAbstract::setAvailableIncludes
     */
    public function testSetAvailableIncludes()
    {
        $transformer = m::mock('League\Fractal\TransformerAbstract')->makePartial();
        $this->assertInstanceOf('League\Fractal\TransformerAbstract', $transformer->setAvailableIncludes(['foo']));
    }

    /**
     * @covers \League\Fractal\TransformerAbstract::getAvailableIncludes
     */
    public function testGetAvailableIncludes()
    {
        $transformer = m::mock('League\Fractal\TransformerAbstract')->makePartial();

        $transformer->setAvailableIncludes(['foo', 'bar']);
        $this->assertSame(['foo', 'bar'], $transformer->getAvailableIncludes());
    }

    /**
     * @covers \League\Fractal\TransformerAbstract::setDefaultIncludes
     */
    public function testSetDefaultIncludes()
    {
        $transformer = m::mock('League\Fractal\TransformerAbstract')->makePartial();
        $this->assertInstanceOf('League\Fractal\TransformerAbstract', $transformer->setDefaultIncludes(['foo']));
    }

    /**
     * @covers \League\Fractal\TransformerAbstract::getDefaultIncludes
     */
    public function testGetDefaultIncludes()
    {
        $transformer = m::mock('League\Fractal\TransformerAbstract')->makePartial();

        $transformer->setDefaultIncludes(['foo', 'bar']);
        $this->assertSame(['foo', 'bar'], $transformer->getDefaultIncludes());
    }

    /**
     * @covers \League\Fractal\TransformerAbstract::setCurrentScope
     */
    public function testSetCurrentScope()
    {
        $transformer = $this->getMockForAbstractClass('League\Fractal\TransformerAbstract');
        $manager = new Manager();
        $scope = new Scope($manager, m::mock('League\Fractal\Resource\ResourceAbstract'));
        $this->assertInstanceOf('League\Fractal\TransformerAbstract', $transformer->setCurrentScope($scope));
    }

    /**
     * @covers \League\Fractal\TransformerAbstract::getCurrentScope
     */
    public function testGetCurrentScope()
    {
        $transformer = m::mock('League\Fractal\TransformerAbstract')->makePartial();
        $manager = new Manager();
        $scope = new Scope($manager, m::mock('League\Fractal\Resource\ResourceAbstract'));
        $transformer->setCurrentScope($scope);
        $this->assertSame($transformer->getCurrentScope(), $scope);
    }

    /**
     * @covers \League\Fractal\TransformerAbstract::item
     */
    public function testItem()
    {
        $mock = m::mock('League\Fractal\TransformerAbstract');
        $item = $mock->item([], function () {
        });
        $this->assertInstanceOf('League\Fractal\Resource\Item', $item);
    }

    /**
     * @covers \League\Fractal\TransformerAbstract::collection
     */
    public function testCollection()
    {
        $mock = m::mock('League\Fractal\TransformerAbstract');
        $collection = $mock->collection([], function () {
        });
        $this->assertInstanceOf('League\Fractal\Resource\Collection', $collection);
    }

    public function tearDown()
    {
        m::close();
    }
}
