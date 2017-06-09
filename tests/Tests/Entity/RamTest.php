<?php

namespace Tests;

use App\Entity\Ram;
use PHPUnit\Framework\TestCase;

class RamTest extends TestCase
{
    public function test()
    {
        $amount = 1;
        $resource = new Ram($amount);
        $this->assertSame($amount, $resource->getAmount());
    }
}
