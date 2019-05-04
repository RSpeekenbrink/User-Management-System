<?php

namespace App\Contracts\Http;

/**
 * The Request class is responsible for gathering information about
 * the client's request to the server in order to handle the request
 * correctly.
 */
interface RequestInterface
{
	/**
	 * Create a new Request based on input from client.
	 *
	 * @return self
	 */
	public static function capture();

	/**
	 * Get the URL for the request.
	 *
	 * @return string
	 */
	public function url();

	/**
	 * Get the request method.
	 *
	 * @return string
	 */
	public function method();
}
