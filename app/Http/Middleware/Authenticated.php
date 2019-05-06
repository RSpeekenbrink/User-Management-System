<?php

namespace App\Http\Middleware;

use App\Contracts\Http\Middleware\MiddlewareInterface;
use App\Http\Request;
use App\Models\User;
use App\Http\Controllers\AuthController;

class Authenticated implements MiddlewareInterface
{
    /**
     * Handle the middleware
     *
     * @return bool continue
     */
    public function handle(Request $request)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../login');
            return false;
        }

        $user = User::find($_SESSION['user_id']);

        if (!$user) {
            header('Location: ../login');
            return false;
        }

        if (!$user->active) {
            $auth = new AuthController();

            $auth->logout($request);

            return false;
        }

        return true;
    }
}
