<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application\Adapter\Drivers\PDODriver\TranslateRepository;

use \Oaza\Application\Adapter\TranslateRepository\ITranslateRepository;

/**
 * Implementation of translate repository for PDO Driver
 *
 * @author  Filip Vozar
 */
class TranslateRepository implements ITranslateRepository
{

    /** @var \PDOStatement */
    private $PDOStatement;

    /** @var TranslateEntity[] */
    public $translateEntities;

    public function __construct(\PDOStatement $PDOStatement)
    {
        $this->PDOStatement = $PDOStatement;
    }

    /**
     * Prepare method for load translate entities for current page
     * @return ITranslateRepository
     */
    public function prepareTranslateEntitiesForCurrentPage()
    {
        $rows = $this->PDOStatement->fetchAll();

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