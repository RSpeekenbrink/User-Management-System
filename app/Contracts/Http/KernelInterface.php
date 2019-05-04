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
	 * Reboots the Kernel
	 * 
	 * @return void
	 */
	public function reboot();

	/**
	 * Enables Debug Mode
	 *
	 * @return void
	 */
	public function enableDebug();

	/**
	 * Disables Debug Mode
	 *
	 * @return void
	 */
	public function disableDebug();

	/**
	 * Handles a request and returns a response that will be send back to the client.
	 * 
	 * @param App\Application $app
	 * @param App\Http\Request $request The Request To Handle
	 */
	public function handle(\App\Application $app, \App\Http\Request $request);

	/**
	 * Registers Routes
	 *
	 * @return void
	 */
	public function setupRoutes();

	/**
	 * Sets up Exception Handling
	 * 
	 * @return void
	 */
	public function setupExceptionHandling();
}
