<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
{
    // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
    if (Auth::check() && Auth::user()->role === $role) {
        return $next($request);
    }
    
    // Jika tidak memiliki otorisasi, redirect ke halaman yang sesuai
    return redirect('login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini');
}
}
