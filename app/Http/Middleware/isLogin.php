<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Islogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Redirect berdasarkan peran pengguna
        if (Auth::user()->role === 'warga') {
            return redirect()->route('warga.dashboard');
        } elseif (Auth::user()->role === 'tim_operasional') {
            return redirect()->route('tim-operasional.dashboard');
        } elseif (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        }

        return redirect('sesi')->with('error', 'Silakan login terlebih dahulu.');
    }
}
