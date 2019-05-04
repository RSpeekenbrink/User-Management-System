<?php

namespace App\Contracts\Http;

use App\Http\Request;

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
	 * 
	 * @param App\Http\Request $request The Request To Handle
	 */
	public function handle(Request $request);
}
