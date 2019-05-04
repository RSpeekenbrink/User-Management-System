<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\View;

class AuthController extends Controller
{
	/**
	 * Show the login form
	 */
	public function showLoginForm(Request $request)
	{
		View::create('Login')->show();
	}
}
