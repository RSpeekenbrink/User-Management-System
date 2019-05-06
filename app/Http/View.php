<?php

namespace App\Http;

use App\Contracts\Http\ViewInterface;
use App\Http\Request;

class View implements ViewInterface
{
    /**
     * The path to the view
     *
     * @var string
     */
    private $path;

    /**
     * The current Request
     *
     * @var Request
     */
    private $request;

    /**
     * Set the current Request
     *
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Create a view based on a view name
     *
     * @param string $viewName
     * @param Request $request (optional)
     * @return self
     */
    public static function create(string $viewName, Request $request = null)
    {
        $view = new View();

        $view->setRequest($request);

        $view->setPath($view->getViewPath() . str_replace('.', DIRECTORY_SEPARATOR, $viewName));

        return $view;
    }

    /**
     * Set the path of the view file
     *
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Show the view (include)
     *
     * @return void
     */
    public function show()
    {
        include $this->path . '.php';
    }

    /**
     * Return the path containing all views
     *
     * @return string
     */
    public function getViewPath()
    {
        return __DIR__ . '/../Views/';
    }
}
