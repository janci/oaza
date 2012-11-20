<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\DummyDriver\TranslateRepository;

use Oaza\Application\Adapter\TranslateRepository\ITranslateEntity;

/**
 * Dummy implementation of Translate entity
 *
 * @author  Jan Svantner
 */
class TranslateEntity implements ITranslateEntity
{
    private $messages;

    public function setMessage($language, $translate, $count=1){
        $this->messages[$language][$count] = $translate;
    }

    /**
     * Returns translate message by $language and $count
     * @param string $language
     * @param integer|null $count
     * @return string
     */
    public function getTranslateMessage($language, $count = null)
    {
        if(!isset($count)) $count = 1;
        $count = abs($count);

        if(!isset($this->messages[$language]) && !isset($this->messages['default'])) return "";
        if(!isset($this->messages[$language]) && isset($this->messages['default'])) $this->messages[$language] = $this->messages['default'];
        if(count($this->messages[$language])==1 || isset($this->messages[$language][$count])) return $this->messages[$language][$count];

        $prev = reset($this->messages[$language]);
        $counts = array_keys($this->messages[$language]);
        sort($counts);

        foreach($counts as $val) {
            if($val > $count) return $this->messages[$language][$prev];
            $prev = $val;
        }
        return $this->messages[$language][max($counts)];
    }
}
