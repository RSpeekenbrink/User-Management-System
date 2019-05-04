<?php

namespace App\Models;

use App\Contracts\Models\ModelInterface;
use App\Application;

class Model implements ModelInterface
{
	/**
	 * The Database Table of the Model
	 * 
	 * @var string
	 */
	public static $table = '';

	/**
	 * Get an array of All Models
	 * 
	 * @return array
	 */
	public static function all()
	{
		$db = Application::getInstance()->databaseConnection()->pdo();

		$stmt = $db->query('SELECT * FROM ' . static::$table);

		$result = [];

		while ($row = $stmt->fetch()) {
			$result[] = $row;
		}

		return $result;
	}

	/**
	 * Save current Instance to the Database
	 * 
	 * @return bool success
	 */
	public function save()
	{
		return false;
	}
}
