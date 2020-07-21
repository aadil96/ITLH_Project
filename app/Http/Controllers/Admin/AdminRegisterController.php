<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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

	public function create(Request $request, Admin $admin)
	{
		$attributes = $admin->validateAdminRegistrationRequest($request);
		$admin->create($attributes);
		return redirect()->route('admin.home');
	}
}
