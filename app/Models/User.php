<?php

namespace App\Models;

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
}
