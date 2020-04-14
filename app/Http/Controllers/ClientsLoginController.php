<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Auth;

class ClientsLoginController extends Controller
{

    use AuthenticatesUsers;
    // protected $guard = 'client';
	public function __construct()
	{
		$this->middleware('guest:client')->except('logout');
	}


	public function showClientLoginForm()
    {
    	// ddd(Auth::guard());
        return view('auth.clientLogin', ['url' => 'client/login']);
    }

    public function clientLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
// 
        // ddd($credentials);

        if(Auth::guard('client')->attempt($credentials))
        {
            // dd(Auth::guard('client')->check());
        	// dd('Reached Here');
        	return redirect()->intended(route('client.home'));
        }

        // return dd('Not there yet', $credentials);
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
