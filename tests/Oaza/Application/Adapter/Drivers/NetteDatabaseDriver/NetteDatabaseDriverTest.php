<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\NetteDatabaseDriver;

/**
 * Tests for adapter driver Nette/Database
 *
 * @author Filip Vozar
 */
class NetteDatabaseDriverTest extends \PHPUnit_Framework_TestCase
{
    /** @var NetteDatabaseDriver */
    protected $firstDriver;

    /** @var NetteDatabaseDriver */
    protected $secondDriver;

    /** @var string */
    private $pathToScripts;

    /** @var \Nette\Database\Connection */
    private $databaseConnection;

    protected function setUp()
    {
        $this->pathToScripts = dirname(__DIR__) . "/NetteDatabaseDriver";
        $dsn = 'sqlite:' . $this->pathToScripts . '/db.sqlite3';
        $this->databaseConnection = new \Nette\Database\Connection($dsn);

        $this->databaseConnection->query(file_get_contents($this->pathToScripts . "/create_table.sql"));
        $this->firstDriver = new NetteDatabaseDriver($this->databaseConnection);
        $this->secondDriver = new NetteDatabaseDriver($this->databaseConnection);
    }

    protected function tearDown()
    {
        $this->databaseConnection->query(file_get_contents($this->pathToScripts . "/drop_table.sql"));
        $this->databaseConnection = NULL;
        unset($this->databaseConnection);
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\ControlRepository::getControlRepository
     */
    public function testGetControlRepository()
    {
        $driverClassName = 'Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\NetteDatabaseDriver';
        $controlRepositoryClassName = 'Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\ControlRepository\ControlRepository';

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

    public function testGetTranslateRepository()
    {
        $driverClassName = 'Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\NetteDatabaseDriver';
        $translateRepositoryClassName = 'Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\TranslateRepository\TranslateRepository';

        $this->assertInstanceOf($driverClassName, $this->firstDriver);
        $this->assertInstanceOf($driverClassName, $this->secondDriver);
        $this->assertInstanceOf($translateRepositoryClassName, $this->firstDriver->getControlRepository());
        $this->assertInstanceOf($translateRepositoryClassName, $this->secondDriver->getControlRepository());

        $this->assertNotNull($this->firstDriver->getTranslateRepository());
        $this->assertNotNull($this->secondDriver->getTranslateRepository());

        $firstSameRepository = $this->firstDriver->getTranslateRepository();
        $secondSameRepository = $this->firstDriver->getTranslateRepository();
        $this->assertSame($firstSameRepository, $secondSameRepository);

        $firstNotSameRepository = $this->firstDriver->getTranslateRepository();
        $secondNotSameRepository = $this->secondDriver->getTranslateRepository();
        $this->assertNotSame($firstNotSameRepository, $secondNotSameRepository);
    }
}
