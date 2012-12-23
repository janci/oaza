<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Router;

use Nette\Application\Request;
use \Nette\Application\Routers\Route;
use \Oaza\Application\Adapter\RouteRepository\IRouteRepository;

class Router implements \Nette\Application\IRouter
{

    /** @var \Oaza\Application\Adapter\RouteRepository\IRouteRepository */
    private $routeRepository;

    /** @var bool */
    private $secure;

    public function __construct(IRouteRepository $repository, $isSecure=false) {
        $this->routeRepository = $repository;
        $this->secure = $isSecure;
    }

    /**
     * Maps HTTP request to a Request object.
     * @param \Nette\Http\IRequest $httpRequest
     * @return Request|NULL
     */
    public function match(\Nette\Http\IRequest $httpRequest)
    {
        $url = $httpRequest->getUrl();

        $host = $url->getHost();
        $path = $url->getPath();

        $routeEntity = $this->routeRepository->getRouteEntity($path, array());
        if(!isset($routeEntity)) return null;

        $module = $routeEntity->getModule();
        $presenter = $routeEntity->getPresenter();

        $params[Route::PRESENTER_KEY] = $presenter;
        $params['action'] = $routeEntity->getAction();
        $params['pageId'] = $routeEntity->getPageId();

        if(isset($module)) $params[Route::MODULE_KEY] = $module;

        return new Request(
            $presenter,
            $httpRequest->getMethod(),
            $params,
            $httpRequest->getPost(),
            $httpRequest->getFiles(),
            array(Request::SECURED => $httpRequest->isSecured())
        );
    }

    /**
     * Constructs absolute URL from Request object.
     * @param \Nette\Application\Request $appRequest
     * @param \Nette\Http\Url $refUrl
     * @return string|NULL
     */
    public function constructUrl(Request $appRequest, \Nette\Http\Url $refUrl)
    {
        $presenter = $appRequest->getPresenterName();
        $params = $appRequest->getParameters();
        $params[Route::PRESENTER_KEY] = $presenter;

        $routeEntity = $this->routeRepository->findRouteEntity($params['pageId']);
        if(!isset($routeEntity)) return null;

        $url = $routeEntity->getPath();
        $url = '//' . $refUrl->getHost() . $url;
        return ($this->secure)? 'https:':'http:' . $url;
    }
}
