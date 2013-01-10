<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\RouteRepository;

use \Oaza\Application\Adapter\RouteRepository\IRouteRepository,
    \Oaza\Application\Adapter\Entities\RouteEntity;

/**
 * Implementation of Route Repository for NetteDatabaseDriver
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

    public function __construct(\Nette\Database\Table\Selection $selection)
    {
        $data = $selection->fetchPairs('pageId');

        foreach ($data as $id => $dataRow) {
            $entityArgs = array(
                'module' => $dataRow['module'],
                'presenter' => $dataRow['presenter'],
                'action' => $dataRow['action'],
                'path' => $dataRow['path'],
                'pageId' => $dataRow['pageId'],
                'expire' => $dataRow['expire'],
            );

            $this->entitiesById[$id] = $this->entitiesByPath[$dataRow['path']] = new RouteEntity($entityArgs);
            if (isset($dataRow['previous_id']))
                $this->entitiesByPrevious[$dataRow['previous_id']] = $this->entitiesById[$id];
        }
    }

    /**
     * Returns entity by path
     *
     * @param $path string
     * @param $params string
     * @return RouteEntity|NULL
     */
    public
    function getRouteEntity($path, $params = null)
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
    public
    function findNewRoute($oldRouteId)
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
    public
    function findRouteEntity($id)
    {
        if (isset($this->entitiesById[$id])) return $this->entitiesById[$id];
        return null;
    }
}
