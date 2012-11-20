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
 * Translate entity
 *
 * @author Jan Svantner
 */
interface ITranslateEntity
{
    /**
     * Returns translate message by $language and $count
     * @param string $language
     * @param integer|null $count
     * @return string
     */
    public function getTranslateMessage($language, $count=null);

}
