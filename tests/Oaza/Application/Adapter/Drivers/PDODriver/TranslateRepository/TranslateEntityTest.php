<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\PDODriver\TranslateRepository;

use \Oaza\Application\Adapter\Drivers\PDODriver\PDODriver,
    \Oaza\Application\Adapter\Entities\TranslateEntity;

/**
 * Test for Translate Entity (PDO Driver)
 *
 * @author Filip Vozar
 */
class TranslateEntityTest extends \PHPUnit_Framework_TestCase
{
    /** @var string */
    public $pathToSQLScripts;

    /** @var \PDO */
    public $databaseConnection;

    /** @var TranslateEntity */
    public $testButtonSubmit;

    /** @var TranslateEntity */
    public $testButtonCancel;

    /** @var TranslateEntity */
    public $testButtonReset;

    /** @var TranslateEntity */
    public $testCar;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->pathToSQLScripts = dirname(__DIR__);
        var_dump($this->pathToSQLScripts);
        $dsn = 'sqlite:' . $this->pathToSQLScripts . '/db.sqlite3';
        $this->databaseConnection = new \PDO($dsn);

        $this->databaseConnection->exec(file_get_contents($this->pathToSQLScripts . "/create_table.sql"));
        $this->databaseConnection->exec(file_get_contents($this->pathToSQLScripts . "/fill_table.sql"));
        $driver = new PDODriver($this->databaseConnection);
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
        $this->databaseConnection->exec(file_get_contents($this->pathToSQLScripts . "/drop_table.sql"));
        $this->databaseConnection = null;
        unset($this->databaseConnection);
    }

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

    public function testSetTranslateMessage()
    {
        $this->assertEquals('Odoslať', $this->testButtonSubmit->getTranslateMessage('sk'));
        $this->testButtonSubmit->setTranslateMessage('sk', 'Potvrdiť');
        $this->assertEquals('Potvrdiť', $this->testButtonSubmit->getTranslateMessage('sk'));
    }
}
