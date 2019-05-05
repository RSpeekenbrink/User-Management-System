<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\View;
use App\Models\User;

class ProfileController extends Controller
{
	/**
	 * Prepare the index view and return it
	 * 
	 * @param Request $request
	 * @return void
	 */
	public function getProfile(Request $request)
	{
		View::create('Profile', $request)->show();
	}

	/**
	 * Update Own profile
	 * 
	 * @param Request $request
	 * @return void
	 */
	public function updateProfile(Request $request)
	{
		$user = User::find($_SESSION['user_id']);

		//Validate POST Data
		$error = false;

		foreach (['username', 'email'] as $key) {
			if (!array_key_exists($key, $_POST) || empty($_POST[$key])) {
				$error = true;
				break;
			}
		}

		if ($error) {
			header('Location: ../profile?error=fields');
			return;
		}

		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			header('Location: ../profile?error=email');
			return;
		}

		if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST['username'])) {
			header('Location: ../profile?error=invalid_username');
			return;
		}

		if ($existingUser = User::getByUsernameOrEmail($_POST['email'])) {
			if ($existingUser->id != $user->id) {
				header('Location: ../profile?error=email_exists');
				return;
			}
		}

		if ($existingUser = User::getByUsernameOrEmail($_POST['username'])) {
			if ($existingUser->id != $user->id) {
				header('Location: ../profile?error=username_exists');
				return;
			}
		}

		$user->email = $_POST['email'];
		$user->username = $_POST['username'];

		$user->save();

		header('Location: ../profile?edit=success');
	}

	/**
	 * Change Password
	 * 
	 * @param Request $request
	 * @return void
	 */
	public function changePassword(Request $request)
	{
		$user = User::find($_SESSION['user_id']);

		//Validate POST Data
		$error = false;

		foreach (['current_password', 'password', 'password_confirm'] as $key) {
			if (!array_key_exists($key, $_POST) || empty($_POST[$key])) {
				$error = true;
				break;
			}
		}

		if ($error) {
			header('Location: ../profile?error=fields');
			return;
		}

		if ($_POST['password'] != $_POST['password_confirm']) {
			header('Location: ../profile?error=password_confirm');
			return;
		}

		if (!password_verify($_POST['current_password'], $user->password)) {
			header('Location: ../profile?error=password');
			return;
		}

		$user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);

		$user->save();

		header('Location: ../profile?password=success');
	}
}
