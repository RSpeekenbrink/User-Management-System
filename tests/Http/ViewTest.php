<?php

namespace App\Tests\Http;

use App\Tests\TestCase;

class ViewTest extends TestCase
{
    public function testViewCanBeInstantiated()
    {
        $reflectionClass = new \ReflectionClass(\App\Http\View::class);

        $this->assertTrue($reflectionClass->isInstantiable());
        $this->assertEquals('App\Http', $reflectionClass->getNamespaceName());
    }
}
