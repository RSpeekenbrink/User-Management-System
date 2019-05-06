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
     * @return void
     */
    public function index(Request $request)
    {
        View::create('Admin.Dashboard', $request)->show();
    }

    /**
     * Delete a user by id
     *
     * @param Request $request
     * @return void
     */
    public function deleteUser(Request $request)
    {
        if (!isset($_GET['user'])) {
            header('Location: ../admin');
            return;
        }

        $user = User::find($_GET['user']);

        if (!$user) {
            header('Location: ../admin');
            return;
        }

        $user->delete();

        header('Location: ../admin?delete=success');
    }

    /**
     * Prepare the add user view
     *
     * @param Request $request
     * @return void
     */
    public function addUserForm(Request $request)
    {
        View::create('Admin.Add', $request)->show();
    }

    /**
     * Create new User
     *
     * @param Request $request
     * @return void
     */
    public function addUser(Request $request)
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
            header('Location: ../admin/add?error=fields&username=' . $_POST['username'] . '&email=' . $_POST['email']);
            return;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: ../admin/add?error=email&username=' . $_POST['username']);
            return;
        }

        if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST['username'])) {
            header('Location: ../admin/add?error=invalid_username&email=' . $_POST['email']);
            return;
        }

        if ($_POST['password'] != $_POST['password_confirm']) {
            header('Location: ../admin/add?error=password_confirm&username=' . $_POST['username'] . '&email=' . $_POST['email']);
            return;
        }

        if (User::getByUsernameOrEmail($_POST['email'])) {
            header('Location: ../admin/add?error=email_exists&username=' . $_POST['username']);
            return;
        }

        if (User::getByUsernameOrEmail($_POST['username'])) {
            header('Location: ../admin/add?error=username_exists&email=' . $_POST['email']);
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

        header('Location: ../admin?create=success');
    }

    /**
     * Activate the given user
     *
     * @param Request $request
     * @return void
     */
    public function activateUser(Request $request)
    {
        $this->changeUserActive(true);
    }

    /**
     * Activate the given user
     *
     * @param Request $request
     * @return void
     */
    public function deactivateUser(Request $request)
    {
        $this->changeUserActive(false);
    }

    /**
     * Handle active changes
     *
     * @param bool $active
     * @return void
     */
    private function changeUserActive(bool $active)
    {
        if (!isset($_GET['user'])) {
            return;
        }

        $user = User::find($_GET['user']);

        if (!$user) {
            return;
        }

        $user->active = $active ? 1 : 0;
        $user->save();

        header('Location: ../admin/edit?edit=success&user=' . $_GET['user']);
    }

    /**
     * Show the EditUser form
     *
     * @param Request $request
     * @return void
     */
    public function editUserForm(Request $request)
    {
        if (!isset($_GET['user'])) {
            header('Location: ../admin');
            return;
        }

        $user = User::find($_GET['user']);

        if (!$user) {
            header('Location: ../admin');
            return;
        }

        View::create('Admin.Edit', $request)->show();
    }

    /**
     * Update User Profile
     *
     * @param Request $request
     * @return void
     */
    public function editUser(Request $request)
    {

        //Validate POST Data
        $error = false;

        foreach (['username', 'email', 'user'] as $key) {
            if (!array_key_exists($key, $_POST) || empty($_POST[$key])) {
                $error = true;
                break;
            }
        }

        if ($error) {
            header('Location: ../admin?error=fields');
            return;
        }

        $user = User::find($_POST['user']);

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: ../admin/edit?error=email&user=' . $_POST['user']);
            return;
        }

        if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST['username'])) {
            header('Location: ../profile?error=invalid_username&user=' . $_POST['user']);
            return;
        }

        if ($existingUser = User::getByUsernameOrEmail($_POST['email'])) {
            if ($existingUser->id != $user->id) {
                header('Location: ../profile?error=email_exists&user=' . $_POST['user']);
                return;
            }
        }

        if ($existingUser = User::getByUsernameOrEmail($_POST['username'])) {
            if ($existingUser->id != $user->id) {
                header('Location: ../profile?error=username_exists&user=' . $_POST['user']);
                return;
            }
        }

        $user->email = $_POST['email'];
        $user->username = $_POST['username'];

        $user->save();

        header('Location: ../admin/edit?edit=success&user=' . $_POST['user']);
    }
}
