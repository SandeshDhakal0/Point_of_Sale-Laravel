<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //Admin role = 1
        //User role = 0  // Default Role (and other roles can be added)
        
        if (Auth::check()) {
           
            if (Auth::user()->role == 0) {
                return $next($request);
            } else {
                return redirect('./home')->with('message', 'Access denied as User');
            }
        } else {
            return redirect('./login')->with('message', 'Login required.');
        }
        return $next($request);
    }
}
