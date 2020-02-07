<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $role)
    {
       // $roles = array_except(func_get_args(), [0,1]); // get array of your roles.

        // // $request->user()->role IS AN EXAMPlE
        // if (! in_array($request->user()->role, $roles)) {
        //     return redirect()->back();
        // }

        return $next($request);
    }
}
