<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {   
        if (Auth::guard('client'))
        {
            // dd(Auth::check());
            // dd(Auth::guard($guard)->check());
            // Auth::guard($guard)->check();
            // return redirect()->route('client.home');
            // return $next($request); 
        }

        if (Auth::guard($guard)->check())
        {
            dd('null');
            return redirect('/home');
        }


        return $next($request); 
    }
}   
