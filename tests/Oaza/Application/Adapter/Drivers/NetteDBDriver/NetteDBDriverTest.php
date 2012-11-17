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
class NetteDBDriverTest extends \Oaza\Application\Adapter\Drivers\DummyDriver\DummyDriverTest {

    /** @var string */
    private $pathToScripts;
    
    /** @var \Nette\Database\Connection  */
    private $database;

    protected function setUp() {

        $this->className = 'Oaza\Application\Adapter\Drivers\NetteDBDriver\NetteDBDriver';

        $this->pathToScripts = dirname(__DIR__) . "/NetteDBDriver";

        $path = 'sqlite:' . $this->pathToScripts . '/db.sqlite3';
        $this->database = new \Nette\Database\Connection($path);

        $this->database->query(file_get_contents($this->pathToScripts . "/create_table.sql"));

        $this->firstDriver = new NetteDBDriver($this->database);
        $this->secondDriver = new NetteDBDriver($this->database);
    }

    protected function tearDown() {
        $this->database->query(file_get_contents($this->pathToScripts . "/drop_table.sql"));
        $this->database = NULL;
        unset($this->database);
    }
}
