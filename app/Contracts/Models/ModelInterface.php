<?php

namespace App\Contracts\Models;

interface ModelInterface
{
    /**
     * Get an array of All Models
     *
     * @return array
     */
    public static function all();

    /**
     * Save current Instance to the Database
     *
     * @return bool success
     */
    public function save();
}
