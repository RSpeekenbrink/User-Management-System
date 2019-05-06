<?php

namespace App\Tests;

use App\Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function testApplicationCanBeInstantiated()
    {
        $reflectionClass = new \ReflectionClass(\App\Application::class);

        $this->assertTrue($reflectionClass->isInstantiable());
        $this->assertEquals('App', $reflectionClass->getNamespaceName());
    }
}
