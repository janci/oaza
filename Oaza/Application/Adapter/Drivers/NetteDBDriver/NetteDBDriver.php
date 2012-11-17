<?php

namespace Oaza\Application\Adapter\Drivers\NetteDBDriver;

use \Oaza\Application\Adapter\IDriver,
    Oaza\Application\Adapter\Drivers\NetteDBDriver\ControlRepository\ControlRepository;

class NetteDBDriver extends \Oaza\Object implements IDriver {

    private $controlRepository;
    private $connection;

    public function __construct(\Nette\Database\Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * Returns Control Repository implement in driver
     * @return \Oaza\Application\Adapter\ControlRepository\IControlRepository
     */
    public function getControlRepository() {
        return isset($this->controlRepository) ? $this->controlRepository : $this->controlRepository = new ControlRepository($this->connection->table('component'));
    }

}
