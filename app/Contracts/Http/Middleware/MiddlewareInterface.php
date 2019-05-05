<?php

namespace App\Contracts\Http\Middleware;

use App\Http\Request;

interface MiddlewareInterface
{
	/**
	 * Handle the middleware
	 * 
	 * @return bool continue
	 */
	public function handle(Request $request);
}
