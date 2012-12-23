<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\DummyDriver\RouteRepository;

use Oaza\Application\Adapter\RouteRepository\IRouteEntity;

/**
 * Dummy implementation of Route entity
 *
 * @author  Jan Svantner
 */
class RouteEntity implements IRouteEntity
{
    private $data;

    public function __construct(array $rowData){
        $this->data = $rowData;
    }

    public function getModule()
    {
        return $this->data['module'];
    }

    public function getPresenter()
    {
        return $this->data['presenter'];
    }

    public function getAction()
    {
        return $this->data['action'];
    }

    public function getPageId()
    {
        return $this->data['pageId'];
    }


    public function getPath()
    {
        return $this->data['path'];
    }


    public function getExpireDate()
    {
        return $this->data['expire'];
    }
}
