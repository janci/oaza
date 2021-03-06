<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\DummyDriver\ControlRepository;

use Oaza\Application\Adapter\ControlRepository\IControlRepository,
    Oaza\Application\Adapter\ControlRepository\IControlEntity,
    Oaza\Application\Adapter\Entities\ControlEntity;

class ControlRepository extends \Oaza\Object implements IControlRepository
{

    /** @var array */
    private $entities;

    public function __construct()
    {
        $this->entities['demo'] = new ControlEntity('\Oaza\Sample\HelloWorld\HelloWorld', array('text' => 'Hello World demo.'));
    }

    /**
     * Returns entity for control by name.
     * @param string $controlName
     * @return IControlEntity
     */
    public function getControlEntity($controlName)
    {
        return (isset($this->entities[$controlName])) ? $this->entities[$controlName] : null;
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
