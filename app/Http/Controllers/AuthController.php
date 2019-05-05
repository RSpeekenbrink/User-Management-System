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

	/**
	 * Handle Posted Register form
	 * 
	 * @param Request $request
	 * @return void
	 */
	public function postRegister(Request $request)
	{
		//Validate POST Data
		$error = false;

		foreach (['username', 'email', 'password', 'password_confirm'] as $key) {
			if (!array_key_exists($key, $_POST) || empty($_POST[$key])) {
				$error = true;
				break;
			}
		}

		if ($error) {
			header('Location: ../login?error=fields&username=' . $_POST['username'] . '&email=' . $_POST['email']);
			return;
		}

		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			header('Location: ../login?error=email&username=' . $_POST['username'] . '&email=' . $_POST['email']);
			return;
		}

		if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST['username'])) {
			header('Location: ../login?error=invalid_username&username=' . $_POST['username'] . '&email=' . $_POST['email']);
			return;
		}

		if ($_POST['password'] != $_POST['password_confirm']) {
			header('Location: ../login?error=password_confirm&username=' . $_POST['username'] . '&email=' . $_POST['email']);
			return;
		}

		//TODO: CHECK IF USER ALREADY EXISTS

		$newUser = new User([
			'username' => $_POST['username'],
			'email' => $_POST['email'],
			'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
			'admin' => 0
		]);

		$newUser->save();

		header('Location: ../login?register=success');
	}
}
