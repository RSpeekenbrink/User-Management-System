<?php

namespace App\Http\Middleware;

use App\Contracts\Http\Middleware\MiddlewareInterface;
use App\Http\Request;

class Guest implements MiddlewareInterface
{
    /**
     * Handle the middleware
     *
     * @return bool continue
     */
    public function handle(Request $request)
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: ../');
            return false;
        }

        return true;
    }
}
