<?php

namespace App\Http;

use App\Contracts\Http\ViewInterface;

class View implements ViewInterface
{
	/**
	 * The path to the view
	 *
	 * @var string
	 */
	private $path;

	/**
	 * Create a view based on a view name
	 *
	 * @param string $viewName
	 * @return self
	 */
	public static function create(string $viewName)
	{
		$view = new View();

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
