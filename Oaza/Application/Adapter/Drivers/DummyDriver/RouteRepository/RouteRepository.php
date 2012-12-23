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

use Oaza\Application\Adapter\RouteRepository\IRouteRepository;

/**
 * Dummy implementation of route repository
 *
 * @author  Jan Svantner
 */
class RouteRepository implements IRouteRepository
{

    /** @var array */
    private $entitiesByPath;

    /** @var array */
    private $entitiesById;

    public function __construct(){
        $data[] = array(
            'module' => null,
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/',
            'pageId' => 1,
            'expire' => null
        );

        $data[] = array(
            'module' => null,
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/new-page',
            'pageId' => 2,
            'expire' => null
        );

        $data[] = array(
            'module' => 'Admin',
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/new-page2',
            'pageId' => 3,
            'expire' => null
        );

        $data[] = array(
            'module' => null,
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/new-page/new-page',
            'pageId' => 4,
            'expire' => null
        );

        $data[] = array(
            'module' => null,
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/new-page/new-page2',
            'pageId' => 5
        );

        foreach($data as $id => $dataRow) {
            $this->entitiesById[$id+1] = $this->entitiesByPath[$dataRow['path']] = new RouteEntity($dataRow);
        }

    }

    /**
     * Returns entity by path
     *
     * @param $path string
     * @param $params string
     * @return RouteEntity|NULL
     */
    public function getRouteEntity($path, $params=null)
    {
        if(isset($this->entitiesByPath[$path])) return $this->entitiesByPath[$path];
        return null;
    }


    /**
     * Returns entity by id
     *
     * @param $id int
     * @return \Oaza\Application\Adapter\Drivers\DummyDriver\RouteRepository\RouteEntity|NULL
     */
    public function findRouteEntity($id)
    {
        if(isset($this->entitiesById[$id])) return $this->entitiesById[$id];
        return null;
    }
}
