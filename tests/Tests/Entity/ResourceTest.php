<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Resource;

class ResourceTest extends TestCase
{
    public function test()
    {
        $amount = 1;
        $resource = new Resource($amount);
        $this->assertSame($amount, $resource->getAmount());
        $add = 2;
        $resource->add($add);
        $this->assertSame($amount + $add, $resource->getAmount());
        $resource->subtract($add);
        $this->assertSame($amount, $resource->getAmount());
    }
}
