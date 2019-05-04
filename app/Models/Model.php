<?php

namespace App\Models;

use App\Contracts\Models\ModelInterface;
use App\Database\Database;
use App\Application;

class Model implements ModelInterface
{
	/**
	 * Database Connection
	 * 
	 * @var Database
	 */
	protected $dbConnection = null;

	/**
	 * Get the Database Connection
	 * 
	 * @return Database
	 */
	private function db()
	{
		if ($this->dbConnection == null) {
			$this->dbConnection = Application::getInstance()->databaseConnection();
		}

		return $this->dbConnection;
	}
}
