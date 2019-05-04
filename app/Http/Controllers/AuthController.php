<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\View;
use App\Models\User;

class AuthController extends Controller
{
	/**
	 * Show the login form
	 * 
	 * @param Request $request
	 * @return void
	 */
	public function showLoginForm(Request $request)
	{
		View::create('Login')->show();
	}

	/**
	 * Handle Posted Login form
	 * 
	 * @param Request $request
	 * @return void
	 */
	public function postLogin(Request $request)
	{
		echo "Login Post";
	}
}
