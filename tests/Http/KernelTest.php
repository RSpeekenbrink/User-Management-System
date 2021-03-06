<?php

namespace App\Tests\Http;

use App\Tests\TestCase;

class KernelTest extends TestCase
{
    public function testKernelCanBeInstantiated()
    {
        $reflectionClass = new \ReflectionClass(\App\Http\Kernel::class);

        $this->assertTrue($reflectionClass->isInstantiable());
        $this->assertEquals('App\Http', $reflectionClass->getNamespaceName());
    }
}
