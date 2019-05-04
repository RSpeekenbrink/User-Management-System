<?php

namespace App\Http;

use App\Contracts\Http\KernelInterface;
use App\Http\Request;
use App\Http\Route;

class Kernel implements KernelInterface
{
	/**
	 * Boots the Kernel
	 */
	public function boot()
	{
		$this->setupRoutes();
	}

	/**
	 * Handles a request and returns a response that will be send back to the client.
	 *
	 * @param App\Http\Request $request The Request To Handle
	 */
	public function handle(Request $request)
	{
		$this->boot();

		// TODO: Handle Request
		echo $request->url() . PHP_EOL;
		echo $request->method() . PHP_EOL;
		print_r(Route::getRoutes());
	}

	/**
	 * Registers Routes
	 *
	 * @return void
	 */
	public function setupRoutes()
	{
		Route::get('/', 'HomeController@index');
	}
}
