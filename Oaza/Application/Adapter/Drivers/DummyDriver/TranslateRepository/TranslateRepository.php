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

use Oaza\Application\Adapter\TranslateRepository\ITranslateRepository;
use Oaza\Application\Adapter\Entities\TranslateEntity;

/**
 * Dummy implementation of translate repository
 *
 * @author  Jan Svantner
 */
class TranslateRepository implements ITranslateRepository
{

    /** @var TranslateEntity[] */
    private $currentEntities;

    /**
     * Prepare method for load translate entities for current page
     * @return ITranslateRepository
     */
    public function prepareTranslateEntitiesForCurrentPage()
    {
        $this->currentEntities['MESSAGE_BUTTON_SUBMIT'] = new TranslateEntity();
        $this->currentEntities['MESSAGE_BUTTON_CANCEL'] = new TranslateEntity();
        $this->currentEntities['MESSAGE_BUTTON_TEST'] = new TranslateEntity();

        $this->currentEntities['MESSAGE_BUTTON_SUBMIT']->setTranslateMessage('sk', 'Potvrdiť');
        $this->currentEntities['MESSAGE_BUTTON_SUBMIT']->setTranslateMessage('en', 'Submit');

        $this->currentEntities['MESSAGE_BUTTON_CANCEL']->setTranslateMessage('sk', 'Zrušiť');
        $this->currentEntities['MESSAGE_BUTTON_CANCEL']->setTranslateMessage('en', 'Cancel');

        $this->currentEntities['MESSAGE_BUTTON_TEST']->setTranslateMessage('sk', 'Testov', 0);
        $this->currentEntities['MESSAGE_BUTTON_TEST']->setTranslateMessage('sk', 'Test', 1);
        $this->currentEntities['MESSAGE_BUTTON_TEST']->setTranslateMessage('sk', 'Testy', 2);
        $this->currentEntities['MESSAGE_BUTTON_TEST']->setTranslateMessage('sk', 'Testov', 5);

        return $this;
    }

    /**
     * Returns entity by keyword
     * @param $keyword
     * @return mixed
     */
    public function getTranslateEntity($keyword)
    {
        return (isset($this->currentEntities[$keyword])) ? $this->currentEntities[$keyword] : null;
    }
}
