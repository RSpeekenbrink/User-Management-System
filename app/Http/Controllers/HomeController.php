<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\Http\Request;

class HomeController extends Controller
{
	/**
	 * Prepare the index view and return it
	 * 
	 * @param Request $request
	 * @return View
	 */
	public function index($request)
	{
		echo 'Hello World!';
	}
}
