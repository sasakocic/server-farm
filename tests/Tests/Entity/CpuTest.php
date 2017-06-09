<?php

namespace Tests;

use App\Entity\Cpu;
use PHPUnit\Framework\TestCase;

class CpuTest extends TestCase
{
    public function test()
    {
        $amount = 1;
        $resource = new Cpu($amount);
        $this->assertSame($amount, $resource->getAmount());
    }
}
