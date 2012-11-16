<?php
namespace Oaza\Application\Adapter;

interface IDriver
{
    /**
     * Returns Control Repository implement in driver
     * @return \Oaza\Application\Adapter\ControlRepository\IControlRepository
     */
    public function getControlRepository();

}
