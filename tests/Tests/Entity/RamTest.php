<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Ram;

class RamTest extends TestCase
{
    public function test()
    {
        $amount = 1;
        $resource = new Ram($amount);
        $this->assertSame($amount, $resource->getAmount());
    }
}
