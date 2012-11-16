<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Setting;


/**
 * Property for oaza controls
 *
 * @author      Jan Svantner
 */
class Property extends \Oaza\Object
{
    /** @var PropertyType */
    private $type;

    /** @var string */
    private $name;

    /** @var mixed */
    private $value;

    /** @var bool */
    private $visible;

    /** @var mixed */
    private $defaultValue;

    public function __construct($propertyType, $name, $defaultValue=null, $visible=true){
        $this->visible = $visible;
        $this->type  = $propertyType;
        $this->name  = $name;
        $this->defaultValue = $defaultValue;
    }

    /**
     * Return value of property
     * @return mixed
     */
    public function getValue(){
        return isset($this->value)? $this->value:$this->defaultValue;
    }

    /**
     * Return name of property
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Sets new value for property
     * @param $value
     * @return Property
     */
    public function setValue($value){
        $this->value = $value;
        return $this;
    }

    /**
     * Is property visible in property box?
     * @return bool
     */
    public function isVisible(){
        return $this->visible;
    }

    /**
     * Return property as string (represent value)
     * @return string
     */
    public function __toString(){
        return "{$this->getValue()}";
    }
}
