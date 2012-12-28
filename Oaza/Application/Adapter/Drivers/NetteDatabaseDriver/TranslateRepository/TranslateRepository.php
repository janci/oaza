<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\NetteDatabaseDriver\TranslateRepository;

use \Oaza\Application\Adapter\TranslateRepository\ITranslateRepository;


/**
 * Implementation of translate repository for NetteDatabaseDriver
 *
 * @author  Filip Vozar
 */
class TranslateRepository implements ITranslateRepository
{

    /** @var \Nette\Database\Table\Selection */
    private $tableSelection;

    /** @var array */
    private $translateEntities;

    public function __construct(\Nette\Database\Table\Selection $tableSelection)
    {
        $this->tableSelection = $tableSelection;
    }

    /**
     * Prepare method for load translate entities for current page
     * @return TranslateRepository
     */
    public function prepareTranslateEntitiesForCurrentPage()
    {
        $rows = $this->tableSelection->fetchPairs('id');

        foreach ($rows as $row) {
            if (!isset($this->translateEntities[$row['keyword']])) {
                $this->translateEntities[$row['keyword']] = new TranslateEntity();
            }
            $this->translateEntities[$row['keyword']]->setTranslateMessage($row['language'], $row['translate'], $row['count']);
        }

        return $this;
    }

    /**
     * Returns entity by keyword
     * @param $keyword
     * @return mixed
     */
    public function getTranslateEntity($keyword)
    {
        return (isset($this->translateEntities[$keyword]) ? $this->translateEntities[$keyword] : null);
    }
}
