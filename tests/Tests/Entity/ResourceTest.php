<?php

namespace Tests;

use App\Entity\Resource;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{
    public function test()
    {
        $amount = 3;
        $resource = new Resource($amount);
        $this->assertSame($amount, $resource->getAmount());
        $subtract = 2;
        $resource->subtract($subtract);
        $this->assertSame($amount - $subtract, $resource->getAmount());
    }
}
