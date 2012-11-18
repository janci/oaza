<?php

namespace Oaza\Application\Adapter\Drivers\DummyDriver;

class DummyDriverTest extends \PHPUnit_Framework_TestCase {

    /** @var string */
    protected $className;

    /** @var Oaza\Application\Adapter\Drivers\DummyDriver */
    protected $firstDriver;

    /** @var Oaza\Application\Adapter\Drivers\DummyDriver */
    protected $secondDriver;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->className = 'Oaza\Application\Adapter\Drivers\DummyDriver\DummyDriver';
        $this->firstDriver = new DummyDriver;
        $this->secondDriver = new DummyDriver;
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\DummyDriver::getControlRepository
     * @todo   Implement testGetControlRepository().
     */
    public function testGetControlRepository() {
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

}
