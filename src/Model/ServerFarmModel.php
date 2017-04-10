<?php

namespace App\Model;

/**
 * ServerFarm consists of servers used to host virtual machines.
 */
class ServerFarmModel
{
    /** @var ServerModel[] */
    protected $servers = [];
    /** @var ServerModel */
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
     * @param VmachineModel $vmachine
     */
    public function addVm(VmachineModel $vmachine)
    {
        if ($vmachine->greaterThan($this->max)) {
            return;
        }
        foreach ($this->getServers() as $server) {
            if (!$vmachine->greaterThan($server)) {
                $server->addVm($vmachine);

                return;
            }
        }
        $this->servers[] = ServerModel::createAsVm($this->max)->addVm($vmachine);
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
        foreach ($vmArray as $vmachine) {
            $this->addVm($vmachine);
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
        foreach ($vmArray as $vmachine) {
            $this->addVm($vmachine);
        }

        return $this;
    }

    /**
     * Output allocation
     */
    public function toString()
    {
        $counter = 1;
        $output = 'Server list' . PHP_EOL;
        foreach ($this->servers as $server) {
            $output .= $counter++ . '. ';
            foreach ($server->getVmArray() as $vmachine) {
                $output .= $vmachine->toString() . ' ';
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
