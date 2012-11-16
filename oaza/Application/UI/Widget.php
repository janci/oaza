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
use Oaza\Setting\PropertyType;
use \Nette\Utils\Html;


/**
 *  Abstract class for rendered controls by oaza
 *
 *  @author     Jan Svantner
 */
abstract class Widget extends Control
{
    /** @var Html */
    protected $container;

    /** @var bool */
    private $settingMode=false;

    /**
     * Initialize render component
     */
    public function startup(){
        parent::startup();

        $this->addProperty(new Property( PropertyType::INT, 'min-width', 0, false ));
        $this->addProperty(new Property( PropertyType::INT, 'min-height', 0, false ));

        $currentDirectory = dirname($this->getReflection()->getFileName());
        $this->template->setFile($currentDirectory.DIRECTORY_SEPARATOR."template.latte");

        $this->container = Html::el('div');
    }

    /**
     * Sets component to setting mode
     * @param bool $state
     * @return \Oaza\Application\Widget
     */
    public function settingMode($state=true){
        $this->settingMode = $state;
        return $this;
    }

    /**
     * Render template
     * @param array|null $params
     */
    public function render($params=null){
        $this->container->addClass('widget');
        if($this->settingMode)
            $this->container->addClass('manage');

        $this->container->setHtml($this->template);

        $minHeight = $this->getProperty('min-height')->getValue();
        $minWidth = $this->getProperty('min-width')->getValue();

        $this->container->addStyle('min-height', "{$minHeight}px");
        $this->container->addStyle('min-width', "{$minWidth}px");

        echo $this->container;
    }
}
