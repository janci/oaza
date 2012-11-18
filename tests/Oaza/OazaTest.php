<?php

/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza;

use \Oaza\Asset\JavascriptLibrary;

/**
 * Tests for instance of Oaza
 *
 * @author  Jan Svantner
 */
class OazaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Oaza
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Oaza( new \Oaza\Application\Adapter\Drivers\DummyDriver\DummyDriver() );
        $this->object->registerExternalSources();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Oaza\Oaza::addJavascriptLibrary
     * @todo   Implement testAddJavascriptLibrary().
     */
    public function testAddJavascriptLibrary()
    {
        $this->object->addJavascriptLibrary(JavascriptLibrary::JQUERY);
        $this->object->addJavascriptLibrary(JavascriptLibrary::JQUERY_TOOLS);
        $this->object->addJavascriptLibrary(JavascriptLibrary::JQUERY_UI);
    }

    /**
     * @covers Oaza\Oaza::getDatabaseAdapter
     * @todo   Implement testGetDatabaseAdapter().
     */
    public function testGetDatabaseAdapter()
    {
        $adapter = $this->object->getDatabaseAdapter();
        $this->assertInstanceOf('\Oaza\Application\Adapter\IDriver', $adapter);
    }


    /**
     * @covers Oaza\Oaza::buildExternalSources
     * @todo   Implement testBuildExternalSources().
     */
    public function testBuildExternalSources()
    {
        $this->object->buildExternalSources();
    }

    /**
     * @covers Oaza\Oaza::install
     * @todo   Implement testInstall().
     */
    public function testInstall()
    {
        $this->object->install();
    }

    /**
     * @covers Oaza\Oaza::update
     * @todo   Implement testUpdate().
     */
    public function testUpdate()
    {
        $this->object->update();
    }
}
