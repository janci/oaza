<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\PDODriver\ControlRepository;

use Oaza\Application\Adapter\ControlRepository\IControlRepository,
    Oaza\Application\Adapter\ControlRepository\IControlEntity;

/**
 * Implementation of ControlRepository for PDO
 *
 * @author Filip Vozar
 */
class ControlRepository extends \Oaza\Object implements IControlRepository
{

    /** @var \PDO */
    private $PDOStatement;

    /** @var array */
    private $entities;

    public function __construct(\PDOStatement $PDOStatement)
    {
        $this->PDOStatement = $PDOStatement;

        $rows = $this->PDOStatement->fetchAll();
        foreach ($rows as $row) {
            if (!isset($this->entities[$row['control_name']])) {
                $this->translateEntities[$row['control_name']] = new ControlEntity($row['class_name'], $row['properties']);
            }
        }
    }

    /**
     * Returns entity for control by name.
     * @param string $controlName
     * @return IControlEntity
     */
    public function getControlEntity($controlName)
    {
        return (isset($this->entities[$controlName]) ? $this->entities[$controlName] : null);
    }

    /**
     * Remove control entity from application
     * @param $controlEntity
     * @return IControlRepository
     */
    public function delete(\Oaza\Application\Adapter\ControlRepository\IControlEntity $controlEntity)
    {
        if (isset($this->entities[$controlEntity->getClassName()])) {
            unset($this->entities[$controlEntity->getClassName()]);
        }
        return $this;
    }
}
