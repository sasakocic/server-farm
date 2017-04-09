<?php

namespace App\Model;

/**
 * ServerFarm consists of servers used to host virtual machines.
 */
class ServerFarmModel
{
    /** @var ServerModel[] */
    protected $servers = [];
    /** @var VMachineModel */
    protected $max;

    /**
     * ServerFarm constructor.
     *
     * @param ServerModel $max
     */
    public function __construct(ServerModel $max)
    {
        $this->max = $max;
    }

    /**
     * @return ServerModel[]
     */
    public function getServers(): array
    {
        return $this->servers;
    }

    /**
     * Add Virtual machine to the farm.
     *
     * @param VmachineModel $vm
     */
    public function addVm(VmachineModel $vm)
    {
        if ($vm->greaterThan($this->max)) {
            return;
        }
        foreach ($this->getServers() as $server) {
            if (!$vm->greaterThan($server)) {
                $server->addVm($vm);

                return;
            }
        }
        $this->servers[] = ServerModel::createAsVm($this->max)->addVm($vm);
    }

    /**
     * Get number of servers needed to store given array of VMs.
     *
     * @param VMachineModel[] $vmArray
     *
     * @return ServerModel[]
     */
    public function serversNeededForVmachineArray(array $vmArray)
    {
        foreach ($vmArray as $vm) {
            $this->addVm($vm);
        }

        return $this->getServers();
    }

    /**
     * Store given array of VMs.
     *
     * @param VMachineModel[] $vmArray
     *
     * @return $this
     */
    public function storeVmachines(array $vmArray)
    {
        foreach ($vmArray as $vm) {
            $this->addVm($vm);
        }

        return $this;
    }

    /**
     * Output allocation
     */
    public function toString()
    {
        $n = 1;
        $output = 'Server list' . PHP_EOL;
        foreach ($this->servers as $server) {
            $output .= $n++ . '. ';
            foreach ($server->getVmArray() as $vm) {
                $output .= $vm->toString() . ' ';
            }
            $output .= 'remains ' . $server->toString();
            $output .= PHP_EOL;
        }

        return $output;
    }

    public function count()
    {
        return count($this->servers);
    }
}
