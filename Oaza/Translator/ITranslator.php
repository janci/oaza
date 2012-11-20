<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Translator;

/**
 * Oaza translator interface
 */
interface ITranslator extends \Nette\Localization\ITranslator
{

    /**
     * Sets language for translator
     *
     * @param string $language
     * @return ITranslator
     */
    public function setLanguage($language);

    /**
     * Translates the given string.
     *
     * @param string $message
     * @param int $count
     * @param array $vars
     * @return string
     */
    public function translate($message, $count = NULL, $vars=null);

}
