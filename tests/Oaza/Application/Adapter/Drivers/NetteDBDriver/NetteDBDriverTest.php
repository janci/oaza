<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\NetteDBDriver;

/**
 * Tests for adapter driver Nette/Database
 *
 * @author Filip Vozar
 */
class NetteDBDriverTest extends \PHPUnit_Framework_TestCase
{
    /** @var string */
    protected $className;

    /** @var NetteDBDriver */
    protected $firstDriver;

    /** @var NetteDBDriver */
    protected $secondDriver;

    /** @var string */
    private $pathToScripts;

    /** @var \Nette\Database\Connection */
    private $databaseConnection;

    protected function setUp()
    {
        $this->className = 'Oaza\Application\Adapter\Drivers\NetteDBDriver\NetteDBDriver';
        $this->pathToScripts = dirname(__DIR__) . "/NetteDBDriver";

        $dsn = 'sqlite:' . $this->pathToScripts . '/db.sqlite3';
        var_dump($dsn);
        $this->databaseConnection = new \Nette\Database\Connection($dsn);

        $this->databaseConnection->query(file_get_contents($this->pathToScripts . "/create_table.sql"));
        $this->firstDriver = new NetteDBDriver($this->databaseConnection);
        $this->secondDriver = new NetteDBDriver($this->databaseConnection);
    }

    protected function tearDown()
    {
        $this->databaseConnection->query(file_get_contents($this->pathToScripts . "/drop_table.sql"));
        $this->databaseConnection = NULL;
        unset($this->databaseConnection);
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\NetteDBDriver::getControlRepository
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
}
