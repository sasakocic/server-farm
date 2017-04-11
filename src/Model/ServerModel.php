<?php

namespace App\Model;

use App\Entity\ServerEntity;

class ServerModel extends ServerEntity
{
    /** @var VmachineModel[] */
    protected $vmArray = [];

    /**
     * @return VmachineModel[]
     */
    public function getVmArray(): array
    {
        return $this->vmArray;
    }

    /**
     * Subtract resources from given machine.
     *
     * @param VmachineModel $vmachine
     *
     * @return $this
     */
    public function subtractResources(VmachineModel $vmachine)
    {
        $this->getCpu()->subtract($vmachine->getCpu()->getAmount());
        $this->getRam()->subtract($vmachine->getRam()->getAmount());
        $this->getHdd()->subtract($vmachine->getHdd()->getAmount());

        return $this;
    }

    /**
     * if resources are greater than given.
     *
     * @param ServerModel $vmachine
     *
     * @return boolean
     */
    public function isGreaterThan(ServerModel $vmachine)
    {
        return $this->getCpu()->getAmount() > $vmachine->getCpu()->getAmount()
            || $this->getRam()->getAmount() > $vmachine->getRam()->getAmount()
            || $this->getHdd()->getAmount() > $vmachine->getHdd()->getAmount();
    }

    /**
     * String output of VM.
     *
     * @return string
     */
    public function toString()
    {
        return 'VM('
            . $this->getCpu()->toString() . ', '
            . $this->getRam()->toString() . ', '
            . $this->getHdd()->toString() . ')';
    }

    /**
     * Add VM to the server.
     *
     * @param VMachineModel $vmachine
     *
     * @return $this
     */
    public function addVm(VMachineModel $vmachine)
    {
        $this->vmArray[] = $vmachine;
        $this->subtractResources($vmachine);

        return $this;
    }
}
