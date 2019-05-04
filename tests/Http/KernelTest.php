<?php

namespace App\Tests\Http;

use App\Tests\TestCase;

class KernelTest extends TestCase
{
	public function testKernelCanBeInstantiated()
	{
		$kernel = new \App\Http\Kernel();

		$this->assertInstanceOf('\App\Http\Kernel', $kernel);
	}
}
