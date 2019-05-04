<?php

namespace App\Database;

use App\Contracts\Database\DatabaseInterface;
use \PDO;

class Database implements DatabaseInterface
{
	/**
	 * The PDO instance
	 * 
	 * @var PDO
	 */
	private $pdo;

	/**
	 * Database Host
	 *
	 * @var string
	 */
	private $host;

	/**
	 * Database Name
	 *
	 * @var string
	 */
	private $dbName;

	/**
	 * Database Username
	 *
	 * @var string
	 */
	private $username;

	/**
	 * Database Password
	 *
	 * @var string
	 */
	private $password;

	/**
	 * Database Driver
	 *
	 * @var string
	 */
	private $driver;

	/**
	 * Database Charset
	 *
	 * @var string
	 */
	private $charset;

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
	public function __construct($host, $dbName, $username, $password, $driver = 'mysql', $charset = 'utf8')
	{
		$this->host = $host;
		$this->dbName = $dbName;
		$this->username = $username;
		$this->password = $password;
		$this->driver = $driver;
		$this->charset = $charset;

		$this->setupPDO();
	}

	/**
	 * Setup a fresh PDO instance
	 * 
	 * @return void
	 */
	private function setupPDO()
	{
		$pdo = new PDO(
			$this->driver . ':host=' . $this->host . ';dbname=' . $this->dbName . ';charset=' . $this->charset,
			$this->username,
			$this->password
		);

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$this->pdo = $pdo;
	}


	/**
	 * Get the PDO instance
	 * 
	 * @return PDO
	 */
	public function pdo()
	{
		return $this->pdo;
	}
}
