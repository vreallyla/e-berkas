<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class pengurusMiddleware
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

        $cek=Auth::user()->role->name;
        if ($cek=='Pengurus'||$cek=='Admin') {
            return $next($request);
        }

        return back();
    }
}
