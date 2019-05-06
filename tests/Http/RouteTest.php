<?php

namespace App\Tests\Http;

use App\Tests\TestCase;

class RouteTest extends TestCase
{
    public function testRouteCanBeInstantiated()
    {
        $reflectionClass = new \ReflectionClass(\App\Http\Route::class);

        $this->assertTrue($reflectionClass->isInstantiable());
        $this->assertEquals('App\Http', $reflectionClass->getNamespaceName());
    }
}
