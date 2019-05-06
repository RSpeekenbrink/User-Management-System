<?php

namespace App\Contracts\Http;

/**
 * The Route Class contains information about a route. The route configures
 * what controller to speak to on each request which eventually shows a view again.
 */
interface RouteInterface
{
    /**
     * Returns array of routes for method x
     *
     * @param string $method
     * @return array
     */
    public static function getRoutesForMethod($method);

    /**
     * Returns array of all routes
     *
     * @return array
     */
    public static function getRoutes();

    /**
     * Add a new POST route to the Route collection
     *
     * @param string $route
     * @param string $handler in format 'Controller@Function'
     * @param string $middleware (optional)
     * @return void
     */
    public static function post(string $route, string $handler, string $middleware = '');

    /**
     * Add a new GET route to the Route collection
     *
     * @param string $route
     * @param string $handler in format 'Controller@Function'
     * @param string $middleware (optional)
     * @return void
     */
    public static function get(string $route, string $handler, string $middleware = '');

    /**
     * Add a new DELETE route to the Route collection
     *
     * @param string $route
     * @param string $handler in format 'Controller@Function'
     * @param string $middleware (optional)
     * @return void
     */
    public static function delete(string $route, string $handler, string $middleware = '');

    /**
     * Add a new PUT route to the Route collection
     *
     * @param string $route
     * @param string $handler in format 'Controller@Function'
     * @param string $middleware (optional)
     * @return void
     */
    public static function put(string $route, string $handler, string $middleware = '');

    /**
     * Add a new PATCH route to the Route collection
     *
     * @param string $route
     * @param string $handler in format 'Controller@Function'
     * @param string $middleware (optional)
     * @return void
     */
    public static function patch(string $route, string $handler, string $middleware = '');
}
