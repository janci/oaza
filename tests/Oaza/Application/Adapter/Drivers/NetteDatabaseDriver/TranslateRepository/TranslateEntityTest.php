<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\TranslateRepository;

use \Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\NetteDatabaseDriver;

/**
 * Tests for TranslateEntity class
 *
 * @author Filip Vozar
 */
class TranslateEntityTest extends \PHPUnit_Framework_TestCase
{

    /** @var string */
    private $pathToSQLScripts;

    /** @var \Nette\Database\Connection */
    private $databaseConnection;

    /** @var TranslateEntity */
    private $testButtonSubmit;

    /** @var TranslateEntity */
    private $testButtonCancel;

    /** @var TranslateEntity */
    private $testButtonReset;

    /** @var TranslateEntity */
    private $testCar;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
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
        $repository = $driver->getTranslateRepository();
        $repository->prepareTranslateEntitiesForCurrentPage();

        $this->testButtonSubmit = $repository->getTranslateEntity('TEST_BUTTON_SUBMIT');
        $this->testButtonCancel = $repository->getTranslateEntity('TEST_BUTTON_CANCEL');
        $this->testButtonReset = $repository->getTranslateEntity('TEST_BUTTON_RESET');
        $this->testCar = $repository->getTranslateEntity('TEST_CAR');
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

    /**
     * @covers Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\TranslateRepository\TranslateEntity::getTranslateMessage
     */
    public function testGetTranslateMessage()
    {
        $this->assertEquals('Submit', $this->testButtonSubmit->getTranslateMessage('en'));
        $this->assertEquals('Odoslať', $this->testButtonSubmit->getTranslateMessage('sk'));

        $this->assertEquals('Cancel', $this->testButtonCancel->getTranslateMessage('en'));
        $this->assertEquals('Zrušiť', $this->testButtonCancel->getTranslateMessage('sk'));

        $this->assertEquals('Reset', $this->testButtonReset->getTranslateMessage('en'));
        $this->assertEquals('Resetovať', $this->testButtonReset->getTranslateMessage('sk'));

        $this->assertEquals('Car', $this->testCar->getTranslateMessage('en', 1));
        $this->assertEquals('Cars', $this->testCar->getTranslateMessage('en', 2));
        $this->assertEquals('Áut', $this->testCar->getTranslateMessage('sk', 0));
        $this->assertEquals('Auto', $this->testCar->getTranslateMessage('sk', 1));
        $this->assertEquals('Autá', $this->testCar->getTranslateMessage('sk', 3));
        $this->assertEquals('Áut', $this->testCar->getTranslateMessage('sk', 5));
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\TranslateRepository\TranslateEntity::setTranslateMessage
     */
    public function testSetTranslateMessage()
    {
        $this->assertEquals('Odoslať', $this->testButtonSubmit->getTranslateMessage('sk'));
        $this->testButtonSubmit->setTranslateMessage('sk', 'Potvrdiť');
        $this->assertEquals('Potvrdiť', $this->testButtonSubmit->getTranslateMessage('sk'));
    }
}
