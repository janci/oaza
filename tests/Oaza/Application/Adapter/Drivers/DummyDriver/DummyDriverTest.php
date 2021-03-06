<?php

/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\DummyDriver;

/**
 * Tests for adapter DummyDriver
 *
 * @author Filip Vozar
 */
class DummyDriverTest extends \PHPUnit_Framework_TestCase
{

    /** @var string */
    protected $className;

    /** @var DummyDriver */
    protected $firstDriver;

    /** @var DummyDriver */
    protected $secondDriver;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->className = 'Oaza\Application\Adapter\Drivers\DummyDriver\DummyDriver';
        $this->firstDriver = new DummyDriver;
        $this->secondDriver = new DummyDriver;
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\DummyDriver::getControlRepository
     */
    public function testGetControlRepository()
    {
        $this->assertNotNull($this->firstDriver->getControlRepository());
        $this->assertNotNull($this->secondDriver->getControlRepository());

        $this->assertInstanceOf($this->className, $this->firstDriver);
        $this->assertInstanceOf($this->className, $this->secondDriver);

        $firstSameRepository = $this->firstDriver->getControlRepository();
        $secondSameRepository = $this->firstDriver->getControlRepository();
        $this->assertSame($firstSameRepository, $secondSameRepository);

        $firstNotSameRepository = $this->firstDriver->getControlRepository();
        $secondNotSameRepository = $this->secondDriver->getControlRepository();
        $this->assertNotSame($firstNotSameRepository, $secondNotSameRepository);
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\DummyDriver::getRoutelRepository
     */
    public function testGetRouteRepository()
    {
        $this->assertNotNull($this->firstDriver->getRouteRepository());
        $this->assertNotNull($this->secondDriver->getRouteRepository());

        $this->assertInstanceOf($this->className, $this->firstDriver);
        $this->assertInstanceOf($this->className, $this->secondDriver);

        $firstSameRepository = $this->firstDriver->getRouteRepository();
        $secondSameRepository = $this->firstDriver->getRouteRepository();
        $this->assertSame($firstSameRepository, $secondSameRepository);

        $firstNotSameRepository = $this->firstDriver->getRouteRepository();
        $secondNotSameRepository = $this->secondDriver->getRouteRepository();
        $this->assertNotSame($firstNotSameRepository, $secondNotSameRepository);
    }

}
