<?php

namespace Tests;

use App\Model\ServerFarmModel;
use App\Model\ServerModel;
use App\Model\VmachineModel;
use PHPUnit\Framework\TestCase;

class ServerFarmTest extends TestCase
{
    public function testGetNumber()
    {
        $max = new VmachineModel(4, 6, 7);
        $vmArray = [
            new VmachineModel(1, 1, 2),
            new VmachineModel(2, 2, 1),
            new VmachineModel(3, 4, 3),
            new VmachineModel(2, 1, 2),
        ];
        $sf = new ServerFarmModel($max);
        $sf->storeVmachines($vmArray);
        $actual = $sf->toString();
        $expected = "Server list\n"
            . "1. VM(1 MHz, 1 GB, 2 GB) VM(2 MHz, 2 GB, 1 GB) remains VM(1 MHz, 3 GB, 4 GB)\n"
            . "2. VM(3 MHz, 4 GB, 3 GB) remains VM(1 MHz, 2 GB, 4 GB)\n"
            . "3. VM(2 MHz, 1 GB, 2 GB) remains VM(2 MHz, 5 GB, 5 GB)\n";
        $this->assertSame($expected, $actual);
        $n = $sf->count();
        $this->assertSame(3, $n);
    }

    /**
     * Depending on order we can fit more VMs in less servers.
     */
    public function testGetNumberDifferentOrder()
    {
        $max = new VmachineModel(4, 6, 7);
        $vmArray = [
            new VmachineModel(1, 0, 0),
            new VmachineModel(3, 0, 0),
            new VmachineModel(2, 0, 0),
            new VmachineModel(2, 0, 0),
        ];
        $sf = new ServerFarmModel($max);
        $sf->storeVmachines($vmArray);
        $actual = $sf->toString();
        $expected = "Server list\n"
            . "1. VM(1 MHz, 0 GB, 0 GB) VM(3 MHz, 0 GB, 0 GB) remains VM(0 MHz, 6 GB, 7 GB)\n"
            . "2. VM(2 MHz, 0 GB, 0 GB) VM(2 MHz, 0 GB, 0 GB) remains VM(0 MHz, 6 GB, 7 GB)\n";
        $this->assertSame($expected, $actual);
        $n = $sf->count();
        $this->assertSame(2, $n);
    }

    public function testGetNumberTwo()
    {
        $max = new VmachineModel(5, 6, 7);
        $vmArray = [
            new VmachineModel(1, 2, 3),
            new VmachineModel(4, 5, 6),
        ];
        $sf = new ServerFarmModel($max);
        $n = count($sf->serversNeededForVmachineArray($vmArray));
        $this->assertSame(2, $n);
    }

    public function testGetNumberZero()
    {
        $max = new VmachineModel(5, 6, 7);
        $vmArray = [];
        $sf = new ServerFarmModel($max);
        $n = count($sf->serversNeededForVmachineArray($vmArray));
        $this->assertSame(0, $n);
    }

    public function testGetNumberOne()
    {
        $vmArray = [
            VmachineModel::create(1, 2, 3),
            VmachineModel::create(4, 4, 3),
        ];
        $sf = new ServerFarmModel(ServerModel::create(5, 6, 7));
        $n = count($sf->serversNeededForVmachineArray($vmArray));
        $this->assertSame(1, $n);
    }

    public function testGetNumberOverLimit()
    {
        $vmArray = [
            new VmachineModel(100, 2, 3),
        ];
        $sf = new ServerFarmModel(ServerModel::create(5, 6, 7));
        $n = count($sf->serversNeededForVmachineArray($vmArray));
        $this->assertSame(0, $n);
    }
}
