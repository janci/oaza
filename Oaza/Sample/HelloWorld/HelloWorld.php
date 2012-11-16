<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Sample\HelloWorld;

use Oaza\Setting\Property;
use Oaza\Setting\PropertyType;


/**
 * Sample example for oaza control
 */
class HelloWorld extends \Oaza\Application\UI\Widget
{
    public function startup(){
        parent::startup();
        $this->getProperty('min-width')->setValue(50);
        $this->getProperty('min-height')->setValue(50);

        $this->addProperty(new Property(PropertyType::STRING, "text", ""));
    }

    public function render($params=null){
        $this->template->text = $this->getProperty("text");
        $this->container->addStyle('width', "200px");
        $this->container->addStyle('height', "100px");
        $this->container->addStyle('background-color', "#ffdddd");
        parent::render($params);
    }
}
