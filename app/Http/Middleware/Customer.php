<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next, ...$role)
    // {
    //    $user = Auth::user();
    //     if (($role == 'Admin' && !$user->posisi) || ($role == 'marketing' && !$user->posisi)  || ($role == 'qa' && !$user->posisi) || ($role == 'user' && $user->posisi)) {
    //         abort(403);
    //     }
    //     return $next($request);
    // }

     public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->posisi == 'user' || Auth::user()->posisi == 'qa' ) {
      return $next($request);
    }   return redirect('/');
    }
}