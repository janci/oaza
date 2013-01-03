<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Entities;

use \Oaza\Application\Adapter\RouteRepository\IRouteEntity;

/**
 * Implementation of Route entity
 *
 * @author  Jan Svantner
 */
class RouteEntity implements IRouteEntity
{

    private $module;

    private $presenter;

    private $action;

    private $pageId;

    private $path;

    private $expire;

    public function __construct($data, $module = null, $presenter = null, $action = null, $pageId = null, $path = null, $expire = null)
    {
        if (is_array($data)) {
            if (!(array_key_exists('module', $data) && array_key_exists('presenter', $data) && array_key_exists('action', $data)
                && array_key_exists('pageId', $data) && array_key_exists('path', $data) && array_key_exists('expire', $data))
            ) {
                throw new \Oaza\Developer\InvalidArgumentException();
            }

            $this->module = $data['module'];
            $this->presenter = $data['presenter'];
            $this->action = $data['action'];
            $this->pageId = $data['pageId'];
            $this->path = $data['path'];
            $this->expire = $data['expire'];
        } else {
            $this->module = $module;
            $this->presenter = $presenter;
            $this->action = $action;
            $this->pageId = $pageId;
            $this->path = $path;
            $this->expire = $expire;
        }
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getPresenter()
    {
        return $this->presenter;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getPageId()
    {
        return $this->pageId;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getExpireDate()
    {
        return $this->expire;
    }
}
