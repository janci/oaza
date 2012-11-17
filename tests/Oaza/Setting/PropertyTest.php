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
 * Tests for class Property
 *
 * @author  Jan Svantner
 */
class PropertyTest extends \PHPUnit_Framework_TestCase
{
    /** @var Property */
    protected $prop1;

    /** @var Property */
    protected $prop2;

    /** @var Property */
    protected $prop3;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->prop1 = new Property(PropertyType::TEXT, 'test1', 'default', false);
        $this->prop2 = new Property(PropertyType::TEXT, 'test2', 'default2', true);
        $this->prop3 = new Property(PropertyType::CHECKBOX, 'test1', 'defaultščť');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Oaza\Setting\Property::getValue
     */
    public function testGetValue()
    {
        $this->assertEquals('default', $this->prop1->getValue());
        $this->assertEquals('default2', $this->prop2->getValue());
        $this->assertEquals('defaultščť', $this->prop3->getValue());
    }

    /**
     * @covers Oaza\Setting\Property::getName
     */
    public function testGetName()
    {
        $this->assertEquals('test1', $this->prop1->getName());
        $this->assertEquals('test2', $this->prop2->getName());
        $this->assertEquals('test1', $this->prop3->getName());
    }

    /**
     * @covers Oaza\Setting\Property::setValue
     */
    public function testSetValue()
    {
        $this->prop1->setValue('doubletest');
        $this->assertEquals('doubletest', $this->prop1->getValue());

        $this->assertEquals('default2', $this->prop2->getValue());
        $this->assertEquals('defaultščť', $this->prop3->getValue());

    }

    /**
     * @covers Oaza\Setting\Property::isVisible
     */
    public function testIsVisible()
    {
        $this->assertTrue($this->prop2->isVisible());
        $this->assertTrue($this->prop3->isVisible());
        $this->assertFalse($this->prop1->isVisible());
    }

    /**
     * @covers Oaza\Setting\Property::__toString
     */
    public function test__toString()
    {
        $this->assertEquals('default', (string) $this->prop1);
        $this->assertEquals('default2', (string) $this->prop2);
        $this->assertEquals('defaultščť', (string) $this->prop3);
    }
}
