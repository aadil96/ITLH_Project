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

        if ($guard == "client" && Auth::guard($guard)->check())
        {
            dd('yes');
            return redirect()->route('client.home');
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
