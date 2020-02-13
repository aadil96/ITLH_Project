<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class ClientsLoginController extends Controller
{
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
        	return redirect()->intended('client.home');
        }

        return dd('Not there yet');
        // return redirect()->back()->withInputs($validatedRequest);
    }
}
