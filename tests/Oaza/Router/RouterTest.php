<?php
namespace Oaza\Router;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-12-23 at 07:30:10.
 */
class RouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Router
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $dummyDriver = new \Oaza\Application\Adapter\Drivers\DummyDriver\DummyDriver();
        $routeRepository = $dummyDriver->getRouteRepository();
        $this->object = new Router($routeRepository);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Oaza\Router\Router::match
     */
    public function testMatch_test1()
    {
        $urlScript = new \Nette\Http\UrlScript();
        $urlScript->setHost('www.demopage.sk');
        $urlScript->setPath('/');

        $request = new \Nette\Http\Request($urlScript);
        $appRequest = $this->object->match($request);
        $params = $appRequest->getParameters();
        $presenter = $appRequest->getPresenterName();

        $this->assertEquals('Homepage', $presenter);
        $this->assertEquals('default', $params['action']);
        $this->assertEquals('1', $params['pageId']);
    }

    /**
     * @covers Oaza\Router\Router::match
     */
    public function testMatch_test2()
    {
        $urlScript = new \Nette\Http\UrlScript();
        $urlScript->setHost('www.demopage.sk');
        $urlScript->setPath('/new-page');

        $request = new \Nette\Http\Request($urlScript);
        $appRequest = $this->object->match($request);
        $params = $appRequest->getParameters();
        $presenter = $appRequest->getPresenterName();

        $this->assertEquals('Homepage', $presenter);
        $this->assertEquals('default', $params['action']);
        $this->assertEquals('2', $params['pageId']);
    }

    /**
     * @covers Oaza\Router\Router::match
     */
    public function testMatch_test3()
    {
        $urlScript = new \Nette\Http\UrlScript();
        $urlScript->setHost('www.demopage.sk');
        $urlScript->setPath('/new-page/new-page');

        $request = new \Nette\Http\Request($urlScript);
        $appRequest = $this->object->match($request);
        $params = $appRequest->getParameters();
        $presenter = $appRequest->getPresenterName();

        $this->assertEquals('Homepage', $presenter);
        $this->assertEquals('default', $params['action']);
        $this->assertEquals('4', $params['pageId']);
    }

    /**
     * @covers Oaza\Router\Router::match
     */
    public function testMatch_missingPage()
    {
        $urlScript = new \Nette\Http\UrlScript();
        $urlScript->setHost('www.demopage.sk');
        $urlScript->setPath('/test-page-missing-page');

        $request = new \Nette\Http\Request($urlScript);
        $appRequest = $this->object->match($request);
        $this->assertNull($appRequest);
    }

    /**
     * @covers Oaza\Router\Router::constructUrl
     */
    public function testConstructUrl()
    {
        $urlScript = new \Nette\Http\UrlScript();
        $urlScript->setHost('www.demopage.sk');
        $urlScript->setPath('/new-page/new-page');

        $request = new \Nette\Http\Request($urlScript);
        $appRequest = $this->object->match($request);

        $urlScript2 = new \Nette\Http\UrlScript();
        $urlScript2->setHost('www.demopage.sk');
        $urlScript2->setPath('/new-page');

        $url = $this->object->constructUrl($appRequest, $urlScript2);
        $this->assertEquals('http://www.demopage.sk/new-page/new-page', $url);
    }
}
