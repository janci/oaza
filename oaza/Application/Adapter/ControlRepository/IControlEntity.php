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
 * Control entity
 */
interface IControlEntity
{
    /**
     * Returns control classname
     * @return string
     */
    public function getClassName();

    /**
     * Returns control properties
     * @return array
     */
    public function getProperties();
}
