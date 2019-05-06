<?php

namespace App\Tests\Models;

use App\Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function testUserCanBeInstantiated()
    {
        $reflectionClass = new \ReflectionClass(User::class);

        $this->assertTrue($reflectionClass->isInstantiable());
        $this->assertTrue($reflectionClass->hasProperty('table'));
        $this->assertEquals('App\Models', $reflectionClass->getNamespaceName());
    }

    public function testUserInstanceOfModelClass()
    {
        $user = new User();

        $this->assertInstanceOf(\App\Models\Model::class, $user);
    }
}
