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
     * Add resources from given machine.
     *
     * @param VmachineModel $vm
     *
     * @return $this
     */
    public function addResources(VmachineModel $vm)
    {
        $this->getCpu()->add($vm->getCpu()->getAmount());
        $this->getRam()->add($vm->getRam()->getAmount());
        $this->getHdd()->add($vm->getHdd()->getAmount());

        return $this;
    }

    /**
     * Subtract resources from given machine.
     *
     * @param VmachineModel $vm
     *
     * @return $this
     */
    public function subtractResources(VmachineModel $vm)
    {
        $this->getCpu()->subtract($vm->getCpu()->getAmount());
        $this->getRam()->subtract($vm->getRam()->getAmount());
        $this->getHdd()->subtract($vm->getHdd()->getAmount());

        return $this;
    }

    /**
     * if resources are greater than given.
     *
     * @param ServerModel $vm
     *
     * @return boolean
     */
    public function greaterThan(ServerModel $vm)
    {
        return $this->getCpu()->getAmount() > $vm->getCpu()->getAmount()
            || $this->getRam()->getAmount() > $vm->getRam()->getAmount()
            || $this->getHdd()->getAmount() > $vm->getHdd()->getAmount();
    }

    public function toString()
    {
        return "VM("
            . $this->getCpu()->toString() . ', '
            . $this->getRam()->toString() . ', '
            . $this->getHdd()->toString() . ')';
    }

    public function addVm(VMachineModel $vm)
    {
        $this->vmArray[] = $vm;
        $this->subtractResources($vm);

        return $this;
    }

    //public static function create(VMachineModel $max)
    //{
    //    $server = new VMachineModel(0, 0, 0);
    //    $server->addResources($max);
    //
    //    return $server;
    //}
}
