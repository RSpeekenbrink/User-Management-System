<?php

namespace App\Tests\Http;

use App\Tests\TestCase;

class RequestTest extends TestCase
{
    public function testRequestCanBeInstantiated()
    {
        $reflectionClass = new \ReflectionClass(\App\Http\Request::class);

        $this->assertTrue($reflectionClass->isInstantiable());
        $this->assertEquals('App\Http', $reflectionClass->getNamespaceName());
    }
}
