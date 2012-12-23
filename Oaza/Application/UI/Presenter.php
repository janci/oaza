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
 *
 * @author  Jan Svantner
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
     * @param \Nette\Localization\ITranslator $translator
     */
    public function __construct(\Nette\DI\Container $context, \Oaza\Oaza $oaza, \Nette\Localization\ITranslator $translator=null){
        $this->oaza = $oaza;
        $this->oazaDriver = $this->oaza->getDatabaseAdapter();
        $this->translator = $translator;
    }

    public function startup() {
        parent::startup();
        $this->checkExipiratedLink();
    }

    private function checkExpiratedLink(){
        /* @var $expired \Nette\DateTime | NULL */
        $expired = $this->getParameter('expired', null);
        if(isset($expired)) {
            $current = new \Nette\DateTime();
            if($expired->getTimestamp() < $current->getTimestamp() ) {
                $pageId = $this->getCurrentPageId();
                $path = $this->getHttpRequest()->getUrl()->getPath();
                $routeEntity = $this->oazaDriver->getRouteRepository()->getRouteEntity($path);

                $link = $this->lazyLink('Homepage:default', array('pageId'=>$routeEntity->getPageId()));
                $parameters = $link->getParameters();

                if($parameters['pageId'] == $pageId) {
                    throw new \Nette\Application\BadRequestException("Page with id {$pageId} is expired.");
                }

                $this->redirect($link);
            }
        }
    }

    /**
     * Returns current page id
     * @return int
     */
    public function getCurrentPageId(){
        return $this->getParameter('pageId', null);
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
