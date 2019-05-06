<?php

namespace App\Http;

use App\Contracts\Http\KernelInterface;
use App\Http\Request;
use App\Http\Route;
use App\Application;

class Kernel implements KernelInterface
{
    /**
     * The application Instance
     *
     * @var Application
     */
    private $app;

    /**
     * Controllers Namespace
     *
     * @var string
     */
    public $controllerNamespace = '\\App\\Http\\Controllers';

    /**
     * Middleware Namespace
     *
     * @var string
     */
    public $middlewareNamespace = '\\App\\Http\\Middleware';

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
     *
     * @return void
     */
    public function boot()
    {
        $this->setupExceptionHandling();
        $this->setupRoutes();
        $this->startSession();
        $this->app->setupDatabaseConnection();
    }

    /**
     * Start the Client's session
     *
     * @return void
     */
    private function startSession()
    {
        session_start();
    }

    /**
     * Handles a request and returns a response that will be send back to the client.
     *
     * @param App\Application $app
     * @param App\Http\Request $request The Request To Handle
     */
    public function handle(Application $app, Request $request)
    {
        $this->app = $app;

        $this->boot();

        if ($this->handleMiddleware($request)) {
            $handler = $this->getHandlerForRequest($request);

            $controller = $this->controllerNamespace . '\\' . explode('@', $handler)[0];
            $function = explode('@', $handler)[1];

            $controller = new $controller();
            $controller->{$function}($request);
        }
    }

    /**
     * Handle the middleware for the request when pressent
     *
     * @return bool continue
     */
    private function handleMiddleware(Request $request)
    {
        $routes = Route::getRoutesForMethod($request->method());

        foreach ($routes as $route) {
            if ($route['route'] == $request->url()) {
                if (isset($route['middleware'])) {
                    $middlewares = explode(',', $route['middleware']);

                    foreach ($middlewares as $middleware) {
                        $middlewareClass = $this->middlewareNamespace . '\\' . $middleware;
                        $middlewareClass = new $middlewareClass();

                        if (!$middlewareClass->handle($request)) {
                            return false;
                        }
                    }
                }
                break;
            }
        }

        return true;
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
        $url = strtok($request->url(), '?');
        $result = null;

        foreach ($routes as $route) {
            if ($route['route'] == $url) {
                $result = $route['handler'];
                break;
            }
        }

        if ($result == null) {
            View::create('Error.404', $request)->show();
            exit();
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
        Route::get('/', 'HomeController@index', 'Web');
        Route::get('/login', 'AuthController@showLoginForm', 'Web');
        Route::post('/login', 'AuthController@postLogin', 'Web');
        Route::get('/register', 'AuthController@showLoginForm', 'Web');
        Route::post('/register', 'AuthController@postRegister', 'Web');
        Route::post('/logout', 'AuthController@logout', 'Web');
        Route::get('/logout', 'AuthController@logout', 'Web');
        Route::get('/profile', 'ProfileController@getProfile', 'Web,Authenticated');
        Route::post('/updateProfile', 'ProfileController@updateProfile', 'Web,Authenticated');
        Route::post('/changePassword', 'ProfileController@changePassword', 'Web,Authenticated');
        Route::get('/admin', 'AdminController@index', 'Web,Authenticated,Admin');
        Route::get('/admin/delete', 'AdminController@deleteUser', 'Web,Authenticated,Admin');
        Route::get('/admin/edit', 'AdminController@editUserForm', 'Web,Authenticated,Admin');
        Route::post('/admin/edit', 'AdminController@editUser', 'Web,Authenticated,Admin');
        Route::get('/admin/add', 'AdminController@addUserForm', 'Web,Authenticated,Admin');
        Route::post('/admin/add', 'AdminController@addUser', 'Web,Authenticated,Admin');
        Route::get('/admin/block', 'AdminController@deactivateUser', 'Web,Authenticated,Admin');
        Route::get('/admin/unblock', 'AdminController@activateUser', 'Web,Authenticated,Admin');
        Route::get('/securityQuestion', 'AuthController@showSecurityQuestionForm', 'Web,Authenticated');
        Route::post('/securityQuestion', 'AuthController@postSecurityQuestionForm', 'Web,Authenticated');
        Route::get('/forgot-password', 'AuthController@showForgotPasswordForm', 'Web,Guest');
        Route::post('/forgot-password', 'AuthController@postForgotPasswordForm', 'Web,Guest');
        Route::post('/resetpassword', 'AuthController@resetPassword', 'Web,Guest');
    }

    /**
     * Sets up Exception Handling
     *
     * @return void
     */
    public function setupExceptionHandling()
    {
        if ($this->app->debug()) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        } else {
            // TODO Setup Status 500 Screen On Error Catch
        }
    }
}
