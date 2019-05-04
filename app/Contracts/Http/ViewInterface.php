<?php

namespace App\Contracts\Http;

/**
 * The View is responsible for fetching a HTML/PHP view from the Views
 * Folder. A view can also contain extra data.
 */
interface ViewInterface
{
	/**
	 * Create a view based on a view name
	 *
	 * @param string $viewName
	 * @return self
	 */
	public static function create(string $viewName);

	/**
	 * Set the path of the view file
	 * 
	 * @param string $path
	 * @return $this
	 */
	public function setPath($path);

	/**
	 * Show the view (include)
	 * 
	 * @return void
	 */
	public function show();
}
