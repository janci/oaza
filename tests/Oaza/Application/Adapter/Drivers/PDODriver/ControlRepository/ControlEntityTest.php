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

/**
 * Test for ControlEntity class of PDODriver
 */
class ControlEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ControlEntity
     */
    protected $entity;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $props = array(
            "id" => 1,
            "text" => "test entity",
            "color" => "#F3CBC3"
        );
        $this->entity = new ControlEntity("TestEntity", $props);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\PDODriver\ControlRepository\ControlEntity::getClassName
     */
    public function testGetClassName()
    {
        $this->assertEquals("TestEntity", $this->entity->getClassName());
    }

    /**
     * @covers Oaza\Application\Adapter\Drivers\PDODriver\ControlRepository\ControlEntity::getProperties
     */
    public function testGetProperties()
    {
        $this->assertArrayHasKey("id", $this->entity->getProperties());
        $this->assertArrayHasKey("text", $this->entity->getProperties());
        $this->assertArrayHasKey("color", $this->entity->getProperties());

        $properties = $this->entity->getProperties();
        $this->assertEquals(1, $properties['id']);
        $this->assertEquals('test entity', $properties['text']);
        $this->assertEquals('#F3CBC3', $properties['color']);
    }
}
