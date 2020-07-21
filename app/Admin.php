<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	protected $guard = 'admin';

	protected $fillable = ['name', 'email', 'password'];

	public function validateAdminRegistrationRequest()
	{

		$attributes = request()->validate([
			'name' => 'required | min:5 | max:100',
			'email' => "required",
			'password' => 'required | min:5 | max:25',
		]);

		$attributes['password'] = bcrypt($attributes['password']);

		return $attributes;
	}
}
