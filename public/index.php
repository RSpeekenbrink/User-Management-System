<?php

/**
 * User Management System
 * 
 * A User Management System without any frameworks to test PHP knowledge
 * 
 * @author Remco Speekenbrink
 */

/**
 * Register the autoloader from Composer. This will also load our App namespace.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Build the Request
 */
$request = \App\Http\Request::capture();

/**
 * Run the application
 */
$kernel = new \App\Http\Kernel();

$kernel->handle($request);
