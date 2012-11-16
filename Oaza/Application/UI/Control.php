<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\UI;

use Oaza\Setting\Property;
use Oaza\Developer\InvalidArgumentException;





/**
 * Abstract class for oaza controls
 *
 * @author      Jan Svantner
 */
abstract class Control extends \Nette\Application\UI\Control
{
    /**  @var Array(Properties) */
    private $properties;

    /** @var bool */
    private $startupRun = false;

    /**
     * Add new property for component
     * @param Property $property
     * @throws InvalidArgumentException
     */
    public function addProperty(Property $property){
        if(isset($this->properties[$property->name]))
            throw new InvalidArgumentException("Property with name {$property->name} already exists.");

        $this->properties[$property->name] = $property;
    }

    /**
     * Return property by name
     * @param $propertyName
     * @return Property
     * @throws InvalidArgumentException
     */
    public function getProperty($propertyName){
        if(!isset($this->properties[$propertyName]))
            throw new InvalidArgumentException("Missing property with name {$propertyName}.");

        return $this->properties[$propertyName];
    }

    /**
     * Initialize component
     */
    public function startup(){
        $this->startupRun = true;
    }

    /**
     * Check startup call
     * @throws \Oaza\Developer\DeveloperException
     */
    final public function startupCheck(){
        if(!$this->startupRun)
            throw new \Oaza\Developer\DeveloperException("Missing `parent::startup` in startup method.");
    }

    /**
     * Sets values for all properties
     * @param $args array($propertyName => $value)
     */
    public function setPropertiesValues($args){
        foreach($args as $key=>$value){
            $this->getProperty($key)->setValue($value);
        }
    }

    /**
     * Load component
     */
    public function load(){

    }

}
