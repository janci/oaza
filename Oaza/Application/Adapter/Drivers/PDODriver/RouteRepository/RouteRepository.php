<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\PDODriver\RouteRepository;

use \Oaza\Application\Adapter\RouteRepository\IRouteRepository,
    \Oaza\Application\Adapter\Entities\RouteEntity;

/**
 * Implementation of Route Repository for PDO driver
 *
 * @author Filip Vozar
 */
class RouteRepository implements IRouteRepository
{

    /** @var array */
    private $entitiesByPath;

    /** @var array */
    private $entitiesById;

    /** @var array */
    private $entitiesByPrevious;


    public function __construct(\PDOStatement $PDOStatement)
    {
        $data = $PDOStatement->fetchAll();
        foreach ($data as $id => $dataRow) {
            $this->entitiesById[$id + 1] = $this->entitiesByPath[$dataRow['path']] = new RouteEntity($dataRow);
            if (isset($dataRow['previous_id']))
                $this->entitiesByPrevious[$dataRow['previous_id']] = $this->entitiesById[$id + 1];
        }
    }

    /**
     * Returns entity by path
     *
     * @param $path string
     * @param $params string
     * @return RouteEntity|NULL
     */
    public function getRouteEntity($path, $params = null)
    {
        if (isset($this->entitiesByPath[$path])) return $this->entitiesByPath[$path];
        return null;
    }

    /**
     * Returns new route by old route id - use for expired links
     *
     * @param $oldRouteId int
     * @return RouteEntity|NULL
     */
    public function findNewRoute($oldRouteId)
    {
        if (isset($this->entitiesByPrevious[$oldRouteId]))
            return $this->entitiesByPrevious[$oldRouteId];
        return null;
    }

    /**
     * Returns entity by id
     *
     * @param $id int
     * @return RouteEntity|NULL
     */
    public function findRouteEntity($id)
    {
        if (isset($this->entitiesById[$id])) return $this->entitiesById[$id];
        return null;
    }
}
