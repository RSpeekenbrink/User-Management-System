<?php

/**
 * User Management System
 * 
 * A User Management System without any frameworks to test PHP knowledge
 * 
 * @author Remco Speekenbrink
 */

// $test = 'secret';
// $password = password_hash('secret', PASSWORD_BCRYPT);

// echo $test . '<br>';

// echo $password . '<br>';

// echo password_verify($test, $password) ? 'yes' : 'no';

// exit();

/**
 * Register the autoloader from Composer. This will also load our App namespace.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Bootstrap the application
 */
$app = App\Application::getInstance();

/**
 * Build the Request
 */
$request = \App\Http\Request::capture();

/**
 * Run the application
 */
$kernel = new \App\Http\Kernel();

$kernel->handle($app, $request);
