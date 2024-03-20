<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Backend
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
        if (Auth::check() && Auth::user() !== null) {
        $userPosisi = Auth::user()->posisi;
        
        // Pemeriksaan posisi pengguna
        if ($userPosisi == 'Admin' || $userPosisi == 'marketing' || $userPosisi == 'qa') {
            return $next($request);
        }
    }

    // Jika pengguna tidak masuk atau posisinya bukan salah satu dari yang diizinkan, redirect ke halaman awal
    return redirect('/login');
    }
}