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
		View::create('Login', $request)->show();
	}

	/**
	 * Handle Posted Login form
	 * 
	 * @param Request $request
	 * @return void
	 */
	public function postLogin(Request $request)
	{
		//Validate POST Data
		$error = false;

		foreach (['username', 'password'] as $key) {
			if (!array_key_exists($key, $_POST) || empty($_POST[$key])) {
				$error = true;
				break;
			}
		}

		// Missing Data
		if ($error) {
			header('Location: ../login?error=loginfields');
			return;
		}

		// Invalid Username
		if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $_POST['username'])) {
			header('Location: ../login?error=invalid_login');
			return;
		}

		// Account not found
		if (!User::getByUsernameOrEmail($_POST['username'])) {
			header('Location: ../login?error=invalid_login');
			return;
		}

		$userToLogIn = User::getByUsernameOrEmail($_POST['username']);

		// Wrong Password
		if (!password_verify($_POST['password'], $userToLogIn->password)) {
			header('Location: ../login?error=invalid_login');
			return;
		}

		// All is correct, log the user in
		$_SESSION['user_id'] = $userToLogIn->id;

		header('Location: ../');
		return;
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
			header('Location: ../login?error=email&username=' . $_POST['username']);
			return;
		}

		if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST['username'])) {
			header('Location: ../login?error=invalid_username&email=' . $_POST['email']);
			return;
		}

		if ($_POST['password'] != $_POST['password_confirm']) {
			header('Location: ../login?error=password_confirm&username=' . $_POST['username'] . '&email=' . $_POST['email']);
			return;
		}

		if (User::getByUsernameOrEmail($_POST['email'])) {
			header('Location: ../login?error=email_exists&username=' . $_POST['username']);
			return;
		}

		if (User::getByUsernameOrEmail($_POST['username'])) {
			header('Location: ../login?error=username_exists&email=' . $_POST['email']);
			return;
		}

		$newUser = new User([
			'username' => $_POST['username'],
			'email' => $_POST['email'],
			'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
			'admin' => 0
		]);

		$newUser->save();

		header('Location: ../login?register=success');
	}

	/**
	 * Log the currently logged in user out
	 * 
	 * @param Request $request
	 * @return void
	 */
	public function logout(Request $request)
	{
		if (!isset($_SESSION['user_id'])) {
			header('Location: ../login');
			return;
		}

		session_unset();

		header('Location: ../login?logout=success');
		return;
	}
}
