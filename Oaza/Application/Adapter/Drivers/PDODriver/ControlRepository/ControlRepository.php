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
 * Implement ControlRepository for PDO
 *
 * @author Filip Vozar
 */
class ControlRepository extends \Oaza\Object implements IControlRepository
{

    /** @var \PDO */
    private $connection;

    /** @var array */
    private $entities;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;

        $statement = $this->connection->prepare("SELECT * FROM component");
        var_dump($statement);
        $statement->execute();
        $this->entities = $statement->fetchAll();
        $statement = null;
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
        $query = 'DELETE FROM component WHERE id = ' . $controlEntity->getID();
        $this->connection->exec($query);
        return $this;
    }

}
