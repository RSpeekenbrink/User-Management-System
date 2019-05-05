<?php

namespace App\Http;

use App\Contracts\Http\RouteInterface;

class Route implements RouteInterface
{
	/**
	 * Array of all post routes
	 *
	 * @var array
	 */
	private static $postRoutes = [];

	/**
	 * Array of all get routes
	 *
	 * @var array
	 */
	private static $getRoutes = [];

	/**
	 * Array of all delete routes
	 *
	 * @var array
	 */
	private static $deleteRoutes = [];

	/**
	 * Array of all put routes
	 *
	 * @var array
	 */
	private static $putRoutes = [];

	/**
	 * Array of all patch routes
	 *
	 * @var array
	 */
	private static $patchRoutes = [];

	/**
	 * Returns array of routes for method x
	 *
	 * @throws Exception when given method is not valid
	 * @param string $method
	 * @return array
	 */
	public static function getRoutesForMethod($method)
	{
		switch ($method) {
			case 'POST':
				return self::$postRoutes;
				break;
			case 'GET':
				return self::$getRoutes;
				break;
			case 'DELETE':
				return self::$deleteRoutes;
				break;
			case 'PUT':
				return self::$putRoutes;
				break;
			case 'PATCH':
				return self::$patchRoutes;
				break;
			default:
				throw new \Exception('Invalid Method passed to getRoutesForMethod function');
				break;
		}
	}

	public static function getRoutes()
	{
		return array(
			'post' 	 => self::$postRoutes,
			'get' 	 => self::$getRoutes,
			'delete' => self::$deleteRoutes,
			'patch'  => self::$patchRoutes,
			'put' 	 => self::$deleteRoutes,
		);
	}

	/**
	 * Add a new POST route to the Route collection
	 *
	 * @param string $route
	 * @param string $handler in format 'Controller@Function'
	 * @param string $middleware (optional)
	 * @return void
	 */
	public static function post(string $route, string $handler, string $middleware = '')
	{
		static::set('postRoutes', $route, $handler, $middleware);
	}

	/**
	 * Add a new GET route to the Route collection
	 *
	 * @param string $route
	 * @param string $handler in format 'Controller@Function'
	 * @param string $middleware (optional)
	 * @return void
	 */
	public static function get(string $route, string $handler, string $middleware = '')
	{
		static::set('getRoutes', $route, $handler, $middleware);
	}

	/**
	 * Add a new DELETE route to the Route collection
	 *
	 * @param string $route
	 * @param string $handler in format 'Controller@Function'
	 * @param string $middleware (optional)
	 * @return void
	 */
	public static function delete(string $route, string $handler, string $middleware = '')
	{
		static::set('deleteRoutes', $route, $handler, $middleware);
	}

	/**
	 * Add a new PUT route to the Route collection
	 *
	 * @param string $route
	 * @param string $handler in format 'Controller@Function'
	 * @param string $middleware (optional)
	 * @return void
	 */
	public static function put(string $route, string $handler, string $middleware = '')
	{
		static::set('putRoutes', $route, $handler, $middleware);
	}

	/**
	 * Add a new PATCH route to the Route collection
	 *
	 * @param string $route
	 * @param string $handler in format 'Controller@Function'
	 * @param string $middleware (optional)
	 * @return void
	 */
	public static function patch(string $route, string $handler, string $middleware = '')
	{
		static::set('patchRoutes', $route, $handler, $middleware);
	}

	/**
	 * Add Route to collection
	 * 
	 * @param string $collectionName
	 * @param string $route
	 * @param string $handler in format 'Controller@Function'
	 * @param string $middleware (optional)
	 * @return void
	 */
	private static function set($collectionName, $route, $handler, $middleware = '')
	{
		self::$$collectionName[] = array(
			'route' => $route,
			'handler' => $handler,
			'middleware' => (empty($middleware) ? null : $middleware)
		);
	}
}
