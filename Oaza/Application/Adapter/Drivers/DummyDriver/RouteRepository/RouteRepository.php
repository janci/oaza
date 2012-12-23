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

    /** @var array */
    private $entitiesByPrevious;

    public function __construct(){
        $data[] = array(
            'module' => null,
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/',
            'pageId' => 1,
            'expire' => null,
            'previous_id' => null
        );

        $data[] = array(
            'module' => null,
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/new-page',
            'pageId' => 2,
            'expire' => null,
            'previous_id' => null
        );

        $data[] = array(
            'module' => 'Admin',
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/new-page2',
            'pageId' => 3,
            'expire' => null,
            'previous_id' => null
        );

        $data[] = array(
            'module' => null,
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/new-page/new-page',
            'pageId' => 4,
            'expire' => null,
            'previous_id' => 4
        );

        $data[] = array(
            'module' => null,
            'presenter' => 'Homepage',
            'action' => 'default',
            'path' => '/new-page/new-page2',
            'pageId' => 5,
            'expire' => \DateTime::createFromFormat('d.m.Y H:i', '12.12.2012 13:14'),
            'previous_id' => null
        );

        foreach($data as $id => $dataRow) {
            $this->entitiesById[$id+1] = $this->entitiesByPath[$dataRow['path']] = new RouteEntity($dataRow);
            if(isset($dataRow['previous_id']))
                $this->entitiesByPrevious[$dataRow['previous_id']] = $this->entitiesById[$id+1];
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
     * Returns new route by old route id - use for expired links
     *
     * @param $oldRouteId int
     * @return RouteEntity|NULL
     */
    public function findNewRoute($oldRouteId){
        if(isset($this->entitiesByPrevious[$oldRouteId]))
            return $this->entitiesByPrevious[$oldRouteId];
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
