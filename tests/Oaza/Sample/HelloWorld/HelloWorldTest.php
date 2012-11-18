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

/**
 * Base test presenter
 *
 * @author  Jan Svantner
 */
class testNettePresenter extends \Nette\Application\UI\Presenter {
    
}

/**
 * Tests for control HelloWorld
 *
 * @author  Jan Svantner
 */
class HelloWorldTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var HelloWorld
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        try {
            $container = build(new \Nette\Config\Configurator)->setTempDirectory(sys_get_temp_dir())->createContainer();
        } catch (\Exception $e) {
            $this->markTestSkipped('Container wasn\'t created correctly');
        }
        $presenter = new testNettePresenter($container);

        $this->object = new HelloWorld($presenter, 'hello'); //$presenter, 'hello'
        $this->object->startup();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Oaza\Sample\HelloWorld\HelloWorld::render
     */
    public function testRender() {
        $propertyText = $this->object->getProperty('text');
        $this->assertInstanceOf('\Oaza\Setting\Property', $propertyText);

        $propertyText->setValue('Test Lorem Ipsum text.');
        $this->expectOutputRegex('/Test Lorem Ipsum text./');
        $this->object->render();
    }

    /**
     * @covers Oaza\Sample\HelloWorld\HelloWorld::render
     */
    public function testRender_PropsHeightWidthBasic() {
        $this->object->getProperty('min-width')->setValue(397);
        $this->object->getProperty('min-height')->setValue(493);

        $this->expectOutputRegex('/min-width:\w?397px;/');
        $this->expectOutputRegex('/min-height:\w?493px;/');
        $this->object->render();
    }

    /**
     * @covers Oaza\Sample\HelloWorld\HelloWorld::render
     */
    public function testRender_PropsHeightWidthBasic2() {
        $this->object->getProperty('min-width')->setValue(129);
        $this->object->getProperty('min-height')->setValue(539);

        $this->expectOutputRegex('/min-width:\w?129px;/');
        $this->expectOutputRegex('/min-height:\w?539px;/');
        $this->object->render();
    }

    /**
     * @covers Oaza\Sample\HelloWorld\HelloWorld::render
     */
    public function testRender_PropsHeightWidthNegative() {
        $this->object->getProperty('min-width')->setValue(-123);
        $this->object->getProperty('min-height')->setValue(-240);

        $this->expectOutputRegex('/min-width:\w?50px;/');
        $this->expectOutputRegex('/min-height:\w?50px;/');
        $this->object->render();
    }

    /**
     * @covers Oaza\Sample\HelloWorld\HelloWorld::render
     */
    public function testRender_PropsHeightWidthZero() {

        $this->object->getProperty('min-width')->setValue(0);
        $this->object->getProperty('min-height')->setValue(0);

        $this->expectOutputRegex('/min-width:\w?50px;/');
        $this->expectOutputRegex('/min-height:\w?50px;/');
        $this->object->render();
    }

    /**
     * @covers Oaza\Sample\HelloWorld\HelloWorld::render
     */
    public function testRender_PropsHeightWidth20To50() {
        $this->object->getProperty('min-width')->setValue(20);
        $this->object->getProperty('min-height')->setValue(30);

        $this->expectOutputRegex('/min-width:\w?20px;/');
        $this->expectOutputRegex('/min-height:\w?30px;/');
        $this->object->render();
    }

}
