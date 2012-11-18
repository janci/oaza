<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Translator;

/**
 * Tests for class DummyTranslator
 *
 * @author  Jan Svantner
 */
class DummyTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DummyTranslator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new DummyTranslator;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Oaza\Translator\DummyTranslator::translate
     */
    public function testTranslate()
    {
        $this->assertEquals("Super text.", $this->object->translate("Super text."));
        $this->assertEquals("Šalamánač.", $this->object->translate("Šalamánač."));
        $this->assertEquals("12 Test.", $this->object->translate("12 Test."));

    }
}
