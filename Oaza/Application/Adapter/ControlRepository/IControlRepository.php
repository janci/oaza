<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\ControlRepository;

/**
 * Interface for management controlEntity
 */
interface IControlRepository
{
    /**
     * Returns entity for control by name.
     * @param string $controlName
     * @return IControlEntity
     */
    public function getControlEntity($controlName);

    /**
     * Remove control entity from application
     * @param $controlEntity
     * @return IControlRepository
     */
    public function delete(IControlEntity $controlEntity);

}
