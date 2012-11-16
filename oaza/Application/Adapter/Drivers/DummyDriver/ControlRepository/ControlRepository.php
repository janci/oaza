<?php

namespace Oaza\Application\Adapter\Drivers\DummyDriver\ControlRepository;

use  Oaza\Application\Adapter\ControlRepository\IControlRepository,
     Oaza\Application\Adapter\ControlRepository\IControlEntity;

class ControlRepository extends \Oaza\Object implements IControlRepository
{
    private $entities;
    public function __construct() {
        $this->entities['demo'] = new ControlEntity('\Oaza\Sample\HelloWorld\HelloWorld', array('text'=> 'Hello World demo.'));
    }

    /**
     * Returns entity for control by name.
     * @param string $controlName
     * @return IControlEntity
     */
    public function getControlEntity($controlName)
    {
        return (isset($this->entities[$controlName]))? $this->entities[$controlName]:null;
    }

    /**
     * Remove control entity from application
     * @param $controlEntity
     * @return IControlRepository
     */
    public function delete(IControlEntity $controlEntity)
    {
        return $this;
    }
}
