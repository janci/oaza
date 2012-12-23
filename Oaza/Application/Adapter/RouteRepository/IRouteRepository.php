<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\RouteRepository;

/**
 * Interface for management RouteEntity
 *
 * @author Jan Svantner
 */
interface IRouteRepository
{
    /**
     * Returns entity by path
     *
     * @param $path string
     * @param $params string
     * @return \Oaza\Application\Adapter\Drivers\DummyDriver\RouteRepository\RouteEntity|NULL
     */
    public function getRouteEntity($path, $params=null);

    /**
     * Returns entity by id
     *
     * @param $id int
     * @return \Oaza\Application\Adapter\Drivers\DummyDriver\RouteRepository\RouteEntity|NULL
     */
    public function findRouteEntity($id);

    /**
     * Returns new route by old route id - use for expired links
     *
     * @param $oldRouteId int
     * @return RouteEntity|NULL
     */
    public function findNewRoute($oldRouteId);
}
