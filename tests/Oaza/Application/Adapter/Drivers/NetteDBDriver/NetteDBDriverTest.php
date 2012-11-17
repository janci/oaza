<?php

namespace Oaza\Application\Adapter\Drivers\NetteDBDriver;

class NetteDBDriverTest extends \Oaza\Application\Adapter\Drivers\DummyDriver\DummyDriverTest {

    private $pathToScripts;
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
    }

}
