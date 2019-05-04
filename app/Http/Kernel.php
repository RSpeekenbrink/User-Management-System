<?php

namespace App\Http;

use App\Contracts\KernelInterface;

class Kernel implements KernelInterface
{
	/**
	 * Boots the Kernel
	 */
	public function boot()
	{
		// TODO: Setup Environment
	}

	/**
	 * Handles a request and returns a response that will be send back to the client.
	 */
	public function handle()
	{
		$this->boot();

		// TODO: Handle Request
	}
}
