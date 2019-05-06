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

        if (!$userToLogIn->active) {
            header('Location: ../login?error=invalid_login');
            return;
        }

        // Wrong Password
        if (!password_verify($_POST['password'], $userToLogIn->password)) {
            header('Location: ../login?error=invalid_login');
            return;
        }

        // All is correct, log the user in
        $_SESSION['user_id'] = $userToLogIn->id;
        $userToLogIn->last_login = date("Y-m-d H:i:s");
        $userToLogIn->save();

        if (isset($_POST['remember-me']) && $_POST['remember-me']) {
            setcookie('remember_token', $userToLogIn->generateRememberToken(), time() + (86400 * 7), "/"); // 7 Days
        }

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
            'admin' => 0,
            'active' => 1
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

        if ($user = User::find($_SESSION['user_id'])) {
            $user->unsetRememberToken();
        }

        session_unset();

        header('Location: ../login?logout=success');
        return;
    }

    /**
     * Show Security Question Form
     *
     * @param Request $request
     * @return void
     */
    public function showSecurityQuestionForm(Request $request)
    {
        View::create('SecurityQuestion', $request)->show();
    }

    /**
     * Save new Security Question for User
     *
     * @param Request $request
     * @return void
     */
    public function postSecurityQuestionForm(Request $request)
    {
        //Validate POST Data
        $error = false;

        foreach (['question', 'answer'] as $key) {
            if (!array_key_exists($key, $_POST) || empty($_POST[$key])) {
                $error = true;
                break;
            }
        }

        if ($error) {
            header('Location: ../securityQuestion?error=fields');
            return;
        }

        $user = User::find($_SESSION['user_id']);
        $user->security_question = $_POST['question'];
        $user->security_question_answer = $_POST['answer'];

        $user->save();

        header('Location: ../profile?edit=success');
    }

    /**
     * Show Forgot Password Form
     *
     * @param Request $request
     * @return void
     */
    public function showForgotPasswordForm(Request $request)
    {
        View::create('ForgotPassword', $request)->show();
    }

    /**
     * Get Questionform By Username/Email
     *
     * @param Request $request
     * @return void
     */
    public function postForgotPasswordForm(Request $request)
    {
        //Validate POST Data
        $error = false;

        foreach (['username'] as $key) {
            if (!array_key_exists($key, $_POST) || empty($_POST[$key])) {
                $error = true;
                break;
            }
        }

        // Missing Data
        if ($error) {
            header('Location: ../forgot-password?error=fields');
            return;
        }

        // Invalid Username
        if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $_POST['username'])) {
            header('Location: ../forgot-password?error=invalid_username');
            return;
        }

        // Account not found
        if (!User::getByUsernameOrEmail($_POST['username'])) {
            header('Location: ../forgot-password?error=invalid_username');
            return;
        }

        $user = User::getByUsernameOrEmail($_POST['username']);

        header('Location: ../forgot-password?user=' . $user->id);
    }

    /**
     * Reset Password
     *
     * @param Request $request
     * @return void
     */
    public function resetPassword(Request $request)
    {
        //Validate POST Data
        $error = false;

        foreach (['user', 'answer', 'password', 'password_confirm'] as $key) {
            if (!array_key_exists($key, $_POST) || empty($_POST[$key])) {
                $error = true;
                break;
            }
        }

        // Missing Data
        if ($error) {
            header('Location: ../forgot-password?error=fields');
            return;
        }

        // Account not found
        if (!User::find($_POST['user'])) {
            header('Location: ../forgot-password?error=invalid_username');
            return;
        }

        if ($_POST['password'] != $_POST['password_confirm']) {
            header('Location: ../forgot-password?error=password_confirm');
            return;
        }

        $user = User::find($_POST['user']);

        if (!$user->security_question) {
            header('Location: ../forgot-password?error=security_question');
            return;
        }

        if ($user->security_question_answer != $_POST['answer']) {
            header('Location: ../forgot-password?error=answer');
            return;
        }

        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->save();

        header('Location: ../login?reset=success');
    }
}
