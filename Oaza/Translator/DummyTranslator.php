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
 * Dummy translator
 */
class DummyTranslator implements \Nette\Localization\ITranslator
{

    /**
     * Translates the given string.
     * @param  string   message
     * @param  int      plural count
     * @return string
     */
    function translate($message, $count = NULL)
    {
        return $message;
    }
}
