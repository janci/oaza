<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\PDODriver\ControlRepository;

use Oaza\Application\Adapter\ControlRepository\IControlEntity;

/**
 * Implement ControlEntity for PDO
 *
 * @author Filip Vozar
 */
class ControlEntity extends \Oaza\Object implements IControlEntity
{

    /** @var string */
    private $className;

    /** @var array */
    private $properties;

    public function __construct($className, $properties)
    {
        $this->className = $className;
        $this->properties = $properties;
    }

    /**
     * Returns control classname
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Returns control properties
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

}
