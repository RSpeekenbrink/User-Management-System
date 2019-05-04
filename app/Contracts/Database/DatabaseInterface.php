<?php

namespace App\Contracts\Database;

interface DatabaseInterface
{
	/**
	 * Creates a new instance of the Database class
	 * 
	 * @param string $host Database Host
	 * @param string $dbName Name of the Database
	 * @param string $username Database Username
	 * @param string $password Password for the Database
	 * @param string $driver Database Driver is standard mysql
	 * @param string $charset Database Charset, is standard utf8
	 * @return self
	 */
	public function __construct($host, $dbName, $username, $password, $driver = 'mysql', $charset = 'utf8');

	/**
	 * Get the PDO instance
	 * 
	 * @return PDO
	 */
	public function pdo();
}
