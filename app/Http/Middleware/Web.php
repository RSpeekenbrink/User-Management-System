<?php

namespace App\Http\Middleware;

use App\Contracts\Http\Middleware\MiddlewareInterface;
use App\Http\Request;
use App\Models\User;

/**
 * The WEB middleware is responsible for the global tasks such as showing
 * a secret-question setup on first login (and enforcing it). Aswell as checking
 * for CSRF tokens (TODO)
 */
class Web implements MiddlewareInterface
{
	/**
	 * Handle the middleware
	 * 
	 * @return bool continue
	 */
	public function handle(Request $request)
	{
		return true;
	}
}
