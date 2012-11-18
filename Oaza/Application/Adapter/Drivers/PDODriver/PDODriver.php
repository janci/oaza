<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\PDODriver;

use \Oaza\Application\Adapter\IDriver,
    \Oaza\Application\Adapter\Drivers\PDODriver\ControlRepository\ControlRepository;

/**
 * Oaza adaptert driver for PDO
 *
 * @author Filip Vozar
 */
class PDODriver extends \Oaza\Object implements IDriver
{

    /** @var \Oaza\Application\Adapter\ControlRepository\IControlRepository */
    private $controlRepository;

    /** @var \PDO */
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Returns Control Repository implement in driver
     * @return \Oaza\Application\Adapter\ControlRepository\IControlRepository
     */
    public function getControlRepository()
    {

        return (isset($this->controlRepository) ? $this->controlRepository : $this->controlRepository = new ControlRepository($this->connection));
    }
}
