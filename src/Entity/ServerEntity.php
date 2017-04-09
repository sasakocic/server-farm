<?php

namespace App\Entity;

use App\Model\VMachineModel;

class ServerEntity
{
    /** @var Cpu */
    public $cpu;
    /** @var Ram */
    public $ram;
    /** @var Hdd */
    public $hdd;

    /**
     * VMachine constructor.
     *
     * @param int $cpu
     * @param int $ram
     * @param int $hdd
     */
    public function __construct(int $cpu, int $ram, int $hdd)
    {
        $this->cpu = new Cpu($cpu);
        $this->ram = new Ram($ram);
        $this->hdd = new Hdd($hdd);
    }

    /**
     * @return Cpu
     */
    public function getCpu(): Cpu
    {
        return $this->cpu;
    }

    /**
     * @return Ram
     */
    public function getRam(): Ram
    {
        return $this->ram;
    }

    /**
     * @return Hdd
     */
    public function getHdd(): Hdd
    {
        return $this->hdd;
    }

    /**
     * VMachine create.
     *
     * @param int $cpu
     * @param int $ram
     * @param int $hdd
     *
     * @return static
     */
    public static function create(int $cpu, int $ram, int $hdd)
    {
        return new static($cpu, $ram, $hdd);
    }

    /**
     * VMachine create.
     *
     * @param ServerEntity $vm
     *
     * @return static
     * @internal param int $cpu
     * @internal param int $ram
     * @internal param int $hdd
     *
     */
    public static function createAsVm(self $vm)
    {
        return new static(
            $vm->getCpu()->getAmount(),
            $vm->getRam()->getAmount(),
            $vm->getHdd()->getAmount()
        );
    }
}
