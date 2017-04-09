<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Cpu;

class CpuTest extends TestCase
{
    public function test()
    {
        $amount = 1;
        $resource = new Cpu($amount);
        $this->assertSame($amount, $resource->getAmount());
    }
}
