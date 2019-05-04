<?php

namespace App\Http;

use App\Contracts\Http\KernelInterface;
use App\Http\Request;
use App\Http\Route;

class Kernel implements KernelInterface
{
	/**
	 * Determires if the app runs in debug mode
	 * 
	 * @var bool
	 */
	protected $debug = false;

	/**
	 * Controllers Namespace
	 *
	 * @var string
	 */
	public $controllerNamespace = '\\App\\Http\\Controllers';

	/**
	 * Enables Debug Mode
	 *
	 * @return void
	 */
	public function enableDebug()
	{
		$this->debug = true;

		$this->reboot();
	}

	/**
	 * Disables Debug Mode
	 *
	 * @return void
	 */
	public function disableDebug()
	{
		$this->debug = false;

		$this->reboot();
	}

	/**
	 * Reboots the Kernel
	 * 
	 * @return void
	 */
	public function reboot()
	{
		$this->boot();
	}

	/**
	 * Boots the Kernel
	 */
	public function boot()
	{
		$this->setupExceptionHandling();

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

		$handler = $this->getHandlerForRequest($request);

		$controller = $this->controllerNamespace . '\\' . explode('@', $handler)[0];
		$function = explode('@', $handler)[1];

		$controller = new $controller();
		$controller->{$function}($request);
	}

	/**
	 * Get the Handler for request
	 *
	 * @param App\Http\Request $request The Request To Handle
	 * @return string controller@function
	 */
	private function getHandlerForRequest(Request $request)
	{
		$routes = Route::getRoutesForMethod($request->method());
		$url = $request->url();

		$result = null;

		foreach ($routes as $route) {
			if ($route['route'] == $url) {
				$result = $route['handler'];
				break;
			}
		}

		if ($result == null) {
			// TODO: Catch and show 404
			throw new \Exception(' Request Handler  not Fo und');
		} else {
			return $result;
		}
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

	/**
	 * Sets up Exception Handling
	 * 
	 * @return void
	 */
	public function setupExceptionHandling()
	{
		if ($this->debug) {
			$whoops = new \Whoops\Run;
			$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
			$whoops->register();
		} else {
			//TODO: Normal Exception Screen
		}
	}
}
