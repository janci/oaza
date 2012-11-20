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

use \Oaza\Application\Adapter\TranslateRepository\ITranslateRepository;

/**
 * Imlement translator in database
 *
 * @author  Jan Svantner
 */
class DatabaseTranslator implements ITranslator
{
    /** @var \Oaza\Application\Adapter\TranslateRepository\ITranslateRepository */
    private $translateRepository;

    /** @var string */
    private $language;

    public function __construct(ITranslateRepository $translateRepository) {
        $this->translateRepository = $translateRepository;
    }

    /**
     * Sets language
     *
     * @param string $language
     * @return DatabaseTranslator|ITranslator
     */
    public function setLanguage($language){
        $this->language = $language;
        return $this;
    }

    /**
     * Translates the given string.
     *
     * @param string $message
     * @param int $count
     * @param array $vars
     * @return string
     */
    public function translate($message, $count = NULL, $vars=null)
    {
        $translateEntity = $this->translateRepository->getTranslateEntity($message);
        if(isset($translateEntity)) $message = $translateEntity->getTranslateMessage($this->language, $count);
        if(isset($vars)) {
            foreach($vars as $keyword => $value) {
                str_replace("\{\$$keyword\}", $value, $message);
            }
        }
        return $message;
    }
}
