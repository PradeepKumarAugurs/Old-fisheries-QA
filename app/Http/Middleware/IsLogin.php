<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(empty(auth()->user()))
        {
            return redirect('auth/login')->with('msg','<div class="alert alert-danger"> You are <strong>logged Out</strong>!</div>'); 
        }
        //$request->merge(['role_type' =>'admin']);
        return $next($request);
    }
}
