<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $userType)
    {  
        if($userType == "user"){
            if (auth()->user()->type == 0) {
                return $next($request);
            } else {
                return redirect()->guest('/');
                // return response()->json(['You do not have permission to access for this page.']);
            }
        }
        if($userType == "admin"){
            if (auth()->user()->type == 2) {
                return $next($request);
            } else {
                return redirect()->guest('/');
                // return response()->json(['You do not have permission to access for this page.']);
            }
        } 
        
    }
}
