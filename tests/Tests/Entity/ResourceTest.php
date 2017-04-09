<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Resource;

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
