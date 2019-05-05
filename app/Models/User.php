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
	 * The Attributes for this class
	 * 
	 * @var array
	 */
	public $attributes = [
		'id',
		'username',
		'email',
		'password',
		'updated_at',
		'created_at',
		'admin'
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
}
