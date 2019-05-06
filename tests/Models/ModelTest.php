<?php

namespace App\Tests\Models;

use App\Tests\TestCase;

class ModelTest extends TestCase
{
    public function testModelCanBeInstantiated()
    {
        $reflectionClass = new \ReflectionClass(\App\Models\Model::class);

        $this->assertTrue($reflectionClass->isInstantiable());
        $this->assertTrue($reflectionClass->hasProperty('table'));
        $this->assertEquals('App\Models', $reflectionClass->getNamespaceName());
    }
}
