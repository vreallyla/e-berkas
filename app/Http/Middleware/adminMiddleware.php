<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       if (!Auth::guest()) {
           if (Auth::user()->role->name == 'Admin')
               return $next($request);
           else
               return redirect('home');
       }
       else{
           return redirect('login');

       }
    }
}
