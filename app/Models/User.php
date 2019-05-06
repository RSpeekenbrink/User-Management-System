<?php

namespace App\Models;

use App\Application;

class User extends Model
{
    /**
     * The Database Table of the Model
     *
     * @var string
     */
    public static $table = 'users';

    /**
     * Remember token collumn
     *
     * @var string
     */
    public static $rememberTokenColumn = 'remember_token';

    /**
     * The Attributes for this class
     *
     * @var array
     */
    public $attributes = [
        'id',
        'username',
        'email',
        'password',
        'active',
        'last_login',
        'updated_at',
        'created_at',
        'admin',
        'security_question',
        'security_question_answer',
        'remember_token'
    ];

    /**
     * Find user by ID
     *
     * @param integer $id
     * @return mixed
     */
    public static function find($id)
    {
        $db = Application::getInstance()->databaseConnection()->pdo();

        $stmt = $db->prepare('SELECT * FROM ' . static::$table . ' WHERE id = ?');
        $stmt->execute([$id]);

        $result = null;

        while ($row = $stmt->fetch()) {
            $result = new self($row, true);
        }

        return $result;
    }

    /**
     * Get User By Username Or Email, Both Values should be Unique
     *
     * @param string $input
     * @return mixed
     */
    public static function getByUsernameOrEmail(string $input)
    {
        $db = Application::getInstance()->databaseConnection()->pdo();

        $stmt = $db->prepare('SELECT * FROM ' . static::$table . ' WHERE username = ? OR email = ?');
        $stmt->execute([$input, $input]);

        $result = null;

        while ($row = $stmt->fetch()) {
            $result = new self($row, true);
        }

        return $result;
    }

    /**
     * Get all users based on search input
     *
     * @param string $input
     * @return array
     */
    public static function search($input)
    {
        $input = '%' . $input . '%';

        $db = Application::getInstance()->databaseConnection()->pdo();

        $stmt = $db->prepare('SELECT * FROM ' . static::$table . ' WHERE username LIKE ? OR email LIKE ?');
        $stmt->execute([$input, $input]);

        $result = [];
        $currentClass = get_called_class();

        while ($row = $stmt->fetch()) {
            $result[] = new $currentClass($row, true);
        }

        return $result;
    }

    /**
     * Generate and save remember token for the user
     *
     * @return string Remember Token
     */
    public function generateRememberToken()
    {
        $remember_token = sha1($this->username . substr(md5(microtime()), rand(0, 26), 5));

        $this->{static::$rememberTokenColumn} = $remember_token;
        $this->save();

        return $remember_token;
    }

    /**
     * Unset and save remember token for the user
     *
     * @return void
     */
    public function unsetRememberToken()
    {
        $this->{static::$rememberTokenColumn} = null;
        $this->save();
    }

    /**
     * Get user by remember token
     *
     * @param string $token to validate
     * @return bool Remember Token Valid
     */
    public static function getByRememberToken(string $token)
    {
        $db = Application::getInstance()->databaseConnection()->pdo();

        $stmt = $db->prepare('SELECT * FROM ' . static::$table . ' WHERE ' . static::$rememberTokenColumn . ' = ?');
        $stmt->execute([$token]);

        $result = null;

        while ($row = $stmt->fetch()) {
            $result = new self($row, true);
        }

        return $result;
    }
}
