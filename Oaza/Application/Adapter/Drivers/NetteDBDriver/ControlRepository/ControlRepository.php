<?php

namespace Oaza\Application\Adapter\Drivers\NetteDBDriver\ControlRepository;

use Oaza\Application\Adapter\ControlRepository\IControlRepository,
    Oaza\Application\Adapter\ControlRepository\IControlEntity;

class ControlRepository extends \Oaza\Object implements IControlRepository {

    /** @var \Nette\Database\Table\Selection */
    private $selection;

    /** @var array */
    private $entities;

    public function __construct(\Nette\Database\Table\Selection $selection) {
        $this->selection = $selection;
        $this->entities = $selection->fetchPairs('control_name');
    }

    /**
     * Returns entity for control by name.
     * @param string $controlName
     * @return IControlEntity
     */
    public function getControlEntity($controlName) {
        return (isset($this->entities[$controlName]) ? $this->entities[$controlName] : null);
    }

    /**
     * Remove control entity from application
     * @param $controlEntity
     * @return IControlRepository
     */
    public function delete(\Oaza\Application\Adapter\ControlRepository\IControlEntity $controlEntity) {
        $selection = clone $this->selection;
        $selection->where('id', $controlEntity->getID())->delete();
        return $this;
    }

}
