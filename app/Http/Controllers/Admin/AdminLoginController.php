<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
	use AuthenticatesUsers;

	public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}

	public function show()
	{
		return view('auth.admin-login');
	}

	public function login(Request $request)
	{
		$attributes = $request->only('email', 'password');

		if (Auth::guard('admin')->attempt($attributes)) {
			return redirect()->intended(route('admin.home'));
		}

		throw ValidationException::withMessages([
			$this->username() => [trans('auth.failed')],
		]);

		return redirect()->back()->withInput();
	}

	public function logout()
	{
		if (Auth::guard('admin')) {
			Auth::logout();
			return redirect(route('admin.login'));
		}
	}
}
