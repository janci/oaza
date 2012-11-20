<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\TranslateRepository;

/**
 * Interface for management TransportEntity
 *
 * @author Jan Svantner
 */
interface ITranslateRepository
{
    /**
     * Prepare method for load translate entities for current page
     * @return ITranslateRepository
     */
    public function prepareTranslateEntitiesForCurrentPage();


    /**
     * Returns entity by keyword
     * @param $keyword
     * @return mixed
     */
    public function getTranslateEntity($keyword);


}
