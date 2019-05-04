<?php

namespace App\Contracts;

/**
 * The Kernel is the main entry point for the application. It creates the
 * application and it's environment. Aswell as handle Requests and return
 * Responses.
 */
interface KernelInterface
{
	/**
	 * Boots the Kernel
	 */
	public function boot();

	/**
	 * Handles a request and returns a response that will be send back to the client.
	 */
	public function handle();
}
