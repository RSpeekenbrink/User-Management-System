<?php

namespace App\Contracts\Http\Controllers;

use App\Http\Controlllers\Controller;

class HomeController extends Controller
{
	/**
	 * Prepare the index view and return it
	 * 
	 * @return View
	 */
	public function index()
	{
		echo 'Hello World!';
	}
}
