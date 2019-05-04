<?php

/**
 * This file contains the application's config such as database credentials
 */

return [
	/**
	 * When in debug modus exceptions will show more information.
	 */
	'debug' => true,

	/**
	 * Holds the information for the database connection
	 */
	'database' => [
		'host' 	   => 'localhost',
		'database' => 'ums',
		'username' => 'root',
		'password' => '',
		'driver'   => 'mysql',
		'charset'  => 'utf8'
	]
];
