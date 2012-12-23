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
 * Route entity
 *
 * @author Jan Svantner
 */
interface IRouteEntity
{

    public function getModule();

    public function getPresenter();

    public function getAction();

    public function getPageId();

    public function getPath();

}
