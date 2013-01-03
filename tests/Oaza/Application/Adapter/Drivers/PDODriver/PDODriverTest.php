<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\PDODriver;

class PDODriverTest extends \PHPUnit_Framework_TestCase
{

    /** @var string */
    public $pathToSQLScripts;

    /** @var \PDO */
    public $databaseConnection;

    /** @var PDODriver */
    public $firstDriver;

    /** @var PDODriver */
    public $secondDriver;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->pathToSQLScripts = dirname(__DIR__) . '/PDODriver';
        $dsn = 'sqlite:' . $this->pathToSQLScripts . '/db.sqlite3';
        $this->databaseConnection = new \PDO($dsn);

        $this->databaseConnection->exec(file_get_contents($this->pathToSQLScripts . "/create_table.sql"));
        $this->firstDriver = new PDODriver($this->databaseConnection);
        $this->secondDriver = new PDODriver($this->databaseConnection);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->databaseConnection->exec(file_get_contents($this->pathToSQLScripts . "/drop_table.sql"));
        $this->databaseConnection = null;
        unset($this->databaseConnection);
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\PDODriver\PDODriver::getControlRepository
     */
    public function testGetControlRepository()
    {
        $driverClassName = 'Oaza\Application\Adapter\Drivers\PDODriver\PDODriver';
        $controlRepositoryClassName = 'Oaza\Application\Adapter\Drivers\PDODriver\ControlRepository\ControlRepository';

        $this->assertInstanceOf($driverClassName, $this->firstDriver);
        $this->assertInstanceOf($driverClassName, $this->secondDriver);
        $this->assertInstanceOf($controlRepositoryClassName, $this->firstDriver->getControlRepository());
        $this->assertInstanceOf($controlRepositoryClassName, $this->secondDriver->getControlRepository());

        $this->assertNotNull($this->firstDriver->getControlRepository());
        $this->assertNotNull($this->secondDriver->getControlRepository());

        $firstSameRepository = $this->firstDriver->getControlRepository();
        $secondSameRepository = $this->firstDriver->getControlRepository();
        $this->assertSame($firstSameRepository, $secondSameRepository);

        $firstNotSameRepository = $this->firstDriver->getControlRepository();
        $secondNotSameRepository = $this->secondDriver->getControlRepository();
        $this->assertNotSame($firstNotSameRepository, $secondNotSameRepository);
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\PDODriver\PDODriver::getTranslateRepository
     */
    public function testGetTranslateRepository()
    {
        $driverClassName = 'Oaza\Application\Adapter\Drivers\PDODriver\PDODriver';
        $translateRepositoryClassName = 'Oaza\Application\Adapter\Drivers\PDODriver\TranslateRepository\TranslateRepository';

        $this->assertInstanceOf($driverClassName, $this->firstDriver);
        $this->assertInstanceOf($driverClassName, $this->secondDriver);
        $this->assertInstanceOf($translateRepositoryClassName, $this->firstDriver->getTranslateRepository());
        $this->assertInstanceOf($translateRepositoryClassName, $this->secondDriver->getTranslateRepository());

        $this->assertNotNull($this->firstDriver->getTranslateRepository());
        $this->assertNotNull($this->secondDriver->getTranslateRepository());

        $firstSameRepository = $this->firstDriver->getTranslateRepository();
        $secondSameRepository = $this->firstDriver->getTranslateRepository();
        $this->assertSame($firstSameRepository, $secondSameRepository);

        $firstNotSameRepository = $this->firstDriver->getTranslateRepository();
        $secondNotSameRepository = $this->secondDriver->getTranslateRepository();
        $this->assertNotSame($firstNotSameRepository, $secondNotSameRepository);
    }

    public function testGetRouteRepository()
    {
        $driverClassName = 'Oaza\Application\Adapter\Drivers\PDODriver\PDODriver';
        $translateRepositoryClassName = 'Oaza\Application\Adapter\Drivers\PDODriver\RouteRepository\RouteRepository';

        $this->assertInstanceOf($driverClassName, $this->firstDriver);
        $this->assertInstanceOf($driverClassName, $this->secondDriver);
        $this->assertInstanceOf($translateRepositoryClassName, $this->firstDriver->getRouteRepository());
        $this->assertInstanceOf($translateRepositoryClassName, $this->secondDriver->getRouteRepository());

        $this->assertNotNull($this->firstDriver->getRouteRepository());
        $this->assertNotNull($this->secondDriver->getRouteRepository());

        $firstSameRepository = $this->firstDriver->getRouteRepository();
        $secondSameRepository = $this->firstDriver->getRouteRepository();
        $this->assertSame($firstSameRepository, $secondSameRepository);

        $firstNotSameRepository = $this->firstDriver->getRouteRepository();
        $secondNotSameRepository = $this->secondDriver->getRouteRepository();
        $this->assertNotSame($firstNotSameRepository, $secondNotSameRepository);
    }
}
