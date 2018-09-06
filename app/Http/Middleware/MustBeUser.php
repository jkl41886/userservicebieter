<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MustBeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard=null)
    {
        if (Auth::guard($guard)->user()->type != "user") {
            auth()->logout();
            return redirect('login');
        }else if(!session()->has('api-token')){
            auth()->logout();
            return redirect('login');
        }

        return $next($request);
    }
}
