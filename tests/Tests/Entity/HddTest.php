<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Hdd;

class HddTest extends TestCase
{
    public function test()
    {
        $amount = 1;
        $resource = new Hdd($amount);
        $this->assertSame($amount, $resource->getAmount());
    }
}
