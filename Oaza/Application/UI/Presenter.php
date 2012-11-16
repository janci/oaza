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

use Oaza\Application\Adapter\IDriver;

/**
 * Abstract Oaza presenter
 */
abstract class Presenter extends \Nette\Application\UI\Presenter
{
    /** @var array */
    private $oazaDriver;

    /** @var array */
    private $oazaControlsProperties;

    /** @var \Oaza\Oaza */
    protected $oaza;

    /** @var \Nette\Localization\ITranslator */
    protected  $translator;

    /**
     * Append Oaza dependency by constructor
     * @param \Nette\DI\Container $context
     * @param \Oaza\Oaza $oaza
     */
    public function __construct(\Nette\DI\Container $context, \Oaza\Oaza $oaza=null, \Nette\Localization\ITranslator $translator=null, IDriver $oazaAdapterDriver){
        parent::__construct($context);

        if(!isset($oaza)) {
            $oaza = new \Oaza\Oaza();
            $oaza->registerExternalSources();
        }

        $this->oaza = $oaza;
        $this->oazaDriver = $oazaAdapterDriver;
        $this->translator = $translator;
    }

    /**
     * Sets oaza controls for autoloading
     * @param $controls
     * @param array $properties
     */
    final public function setOazaControls($controls, $properties=array()){
        $this->oazaControls = $controls;
        $this->oazaControlsProperties = $properties;
    }

    /**
     * Autoloading components
     * @param $name
     * @return \Nette\ComponentModel\IComponent|void
     */
    public function createComponent($name){
        $control = parent::createComponent($name);
        if(isset($control)) return $control;

        $controlEntity = $this->oazaDriver->getControlRepository()->getControlEntity($name);
        if($controlEntity) {
            $classname = $controlEntity->getClassname();
            $control = new $classname;
            if($control instanceof Control){
                $control->startup();
                $control->startupCheck();
                $control->settingMode();

                if(isset($this->translator))
                    $control->getTemplate()->setTranslator($this->translator);

                $control->setPropertiesValues($controlEntity->getProperties());
                $control->load();
            }
            return $control;
        }
    }

    public function beforeRender(){
        if(isset($this->translator))
            $this->getTemplate()->setTranslator($this->translator);
    }

    public function shutdown($response){
        parent::shutdown($response);
        $this->oaza->buildExternalSources();
    }

}
