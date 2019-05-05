<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\View;
use App\Models\User;

class AdminController extends Controller
{
	/**
	 * Prepare the index view and return it
	 * 
	 * @param Request $request
	 * @return View
	 */
	public function index(Request $request)
	{
		View::create('Admin.Dashboard', $request)->show();
	}
}
