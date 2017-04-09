<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\VMachineEntity;

class VmachineTest extends TestCase
{
    public function test()
    {
        $cpu = 1;
        $ram = 2;
        $hdd = 3;
        $vm = new VMachineEntity($cpu, $ram, $hdd);

        $this->assertSame($cpu, $vm->getCpu()->getAmount());
        $this->assertSame($ram, $vm->getRam()->getAmount());
        $this->assertSame($hdd, $vm->getHdd()->getAmount());
    }
}
