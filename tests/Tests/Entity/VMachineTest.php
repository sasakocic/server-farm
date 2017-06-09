<?php

namespace Tests;

use App\Entity\VMachineEntity;
use PHPUnit\Framework\TestCase;

class VMachineTest extends TestCase
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
