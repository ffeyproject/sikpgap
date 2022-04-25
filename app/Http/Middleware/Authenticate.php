<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }

    }

    // public function handle(Request $request, Closure $next)
    // {
    //     if (Auth::check() && Auth::user()->posisi == 'Admin' || Auth::user()->posisi == 'marketing' || Auth::user()->posisi == 'qa' ) {
    //   return $next($request);
    // }   return redirect('/');
    // }
}