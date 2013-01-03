<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\RouteRepository;

use \Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\NetteDatabaseDriver,
    \Oaza\Application\Adapter\Entities\RouteEntity;

/**
 * Test for Route Entity in Nette Database Driver
 */
class RouteEntityTest extends \PHPUnit_Framework_TestCase
{
    /** @var string */
    private $pathToSQLScripts;

    /** @var \PDO */
    private $databaseConnection;

    /** @var RouteEntity */
    private $entity;

    /** @var RouteEntity */
    private $entity1;

    /** @var RouteEntity */
    private $entity2;

    /** @var RouteEntity */
    private $entity3;

    protected function setUp()
    {
        $this->pathToSQLScripts = dirname(__DIR__);
        $dsn = 'sqlite:' . $this->pathToSQLScripts . '/db.sqlite3';
        $this->databaseConnection = new \Nette\Database\Connection($dsn);

        $createStatements = explode(';', file_get_contents($this->pathToSQLScripts . '/create_table.sql'));
        foreach ($createStatements as $statement) {
            $this->databaseConnection->exec($statement);
        }

        $insertStatements = explode(';', file_get_contents($this->pathToSQLScripts . '/fill_table.sql'));
        foreach ($insertStatements as $statement) {
            $this->databaseConnection->exec($statement);
        }

        $driver = new NetteDatabaseDriver($this->databaseConnection);
        $repository = $driver->getRouteRepository();


        $this->entity1 = $repository->findRouteEntity(1);
        $this->entity2 = $repository->findRouteEntity(2);
        $this->entity3 = $repository->findRouteEntity(3);

        $this->entity = $repository->getRouteEntity('/tests/test-page');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $dropStatements = explode(';', file_get_contents($this->pathToSQLScripts . '/drop_table.sql'));
        foreach ($dropStatements as $statement) {
            $this->databaseConnection->exec($statement);
        }
        $this->databaseConnection = NULL;
        unset($this->databaseConnection);
    }

    public function testGetModule()
    {
        $this->assertEquals('Admin', $this->entity1->getModule());
        $this->assertNull($this->entity2->getModule());
        $this->assertNull($this->entity3->getModule());
        $this->assertNull($this->entity->getModule());
    }

    public function testGetPresenter()
    {
        $this->assertEquals('Homepage', $this->entity1->getPresenter());
        $this->assertEquals('Homepage', $this->entity2->getPresenter());
        $this->assertEquals('Homepage', $this->entity3->getPresenter());
        $this->assertEquals('Homepage', $this->entity->getPresenter());
    }

    public function testGetAction()
    {
        $this->assertEquals('default', $this->entity1->getAction());
        $this->assertEquals('default', $this->entity2->getAction());
        $this->assertEquals('default', $this->entity3->getAction());
        $this->assertEquals('default', $this->entity->getAction());
    }

    public function testGetPageId()
    {
        $this->assertEquals(1, $this->entity1->getPageId());
        $this->assertEquals(2, $this->entity2->getPageId());
        $this->assertEquals(3, $this->entity3->getPageId());
    }

    public function testGetPath()
    {
        $this->assertEquals('/', $this->entity1->getPath());
        $this->assertEquals('/test-page', $this->entity2->getPath());
        $this->assertEquals('/tests/test-page', $this->entity3->getPath());
    }

    public function testGetExpireDate()
    {
        $this->assertNull($this->entity1->getExpireDate());
        $this->assertNull($this->entity2->getExpireDate());
        $this->assertNull($this->entity3->getExpireDate());
    }
}
