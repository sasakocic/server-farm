<?php

namespace Tests;

use App\Entity\Hdd;
use PHPUnit\Framework\TestCase;

class HddTest extends TestCase
{
    public function test()
    {
        $amount = 1;
        $resource = new Hdd($amount);
        $this->assertSame($amount, $resource->getAmount());
    }
}
