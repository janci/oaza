<?php
namespace Oaza\Application\Adapter\Drivers;

use \Oaza\Application\Adapter\IDriver,
    Oaza\Application\Adapter\Drivers\DummyDriver\ControlRepository\ControlRepository;

class DummyDriver extends \Oaza\Object implements IDriver
{

    private $controlRepository;

    /**
     * Returns Control Repository implement in driver
     * @return \Oaza\Application\Adapter\ControlRepository\IControlRepository
     */
    public function getControlRepository()
    {
        return isset($this->controlRepository)? $this->controlRepository:$this->controlRepository=new ControlRepository;
    }
}
