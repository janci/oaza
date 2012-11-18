<?php

namespace Oaza\Application\Adapter\Drivers\NetteDBDriver\ControlRepository;

use Oaza\Application\Adapter\ControlRepository\IControlEntity;

class ControlEntity extends \Oaza\Object implements IControlEntity {

    /** @var string */
    private $className;

    /** @var array */
    private $properties;

    public function __construct($className, $properties) {
        $this->className = $className;
        $this->properties = $properties;
    }

    /**
     * Returns control classname
     * @return string
     */
    public function getClassName() {
        return $this->className;
    }

    /**
     * Returns control properties
     * @return array
     */
    public function getProperties() {
        return $this->properties;
    }

}
