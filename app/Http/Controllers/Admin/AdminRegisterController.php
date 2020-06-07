<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminRegisterController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:admin');
	}

	public function show()
	{
		return view('auth.admin-register');
	}

	public function create()
	{
		request()->validate([
			'name' => 'required | min:5 | max:100',
			'email' => "required",
			'password' => 'required | min:5 | max:25',
		]);
		Admin::create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => bcrypt(request('password')),
		]);
		return redirect()->route('admin.home');
	}
}
