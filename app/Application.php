<?php

namespace App;

use App\Database\Database;

class Application
{
    /**
     * Get the Application Instance
     *
     * @var self
     */
    private static $instance;

    /**
     * Stored Database Connection Used By The Application
     *
     * @var Database
     */
    private $databaseConnection;

    /**
     * If the application runs in debug mode or not
     *
     * @var boolean
     */
    private $debug;

    /**
     * Holds the application's config file
     *
     * @var array
     */
    private $config;

    /**
     * Get the singleton instance of the class
     *
     * @return self
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Construct new instance of the application class
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * Boot the application
     *
     * @return void
     */
    private function boot()
    {
        $this->loadConfig();
    }

    /**
     * Setup the database connection
     *
     * @return void
     */
    public function setupDatabaseConnection()
    {
        $this->databaseConnection = new Database(
            $this->config['database']['host'],
            $this->config['database']['database'],
            $this->config['database']['username'],
            $this->config['database']['password'],
            $this->config['database']['driver'],
            $this->config['database']['charset']
        );
    }

    /**
     * Loads the config
     *
     * @return void
     */
    private function loadConfig()
    {
        $this->config = require_once(__DIR__ . '/../config.php');

        $this->debug = $this->config['debug'];
    }

    /**
     * Returns if the application runs in debug or not
     *
     * @return bool
     */
    public function debug()
    {
        return $this->debug;
    }

    /**
     * Get the database connection for the Application
     *
     * @return Database
     */
    public function databaseConnection()
    {
        return $this->databaseConnection;
    }
}
