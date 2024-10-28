<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekLoginKaryawanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('karyawan')->check()) return redirect()->route('karyawan.form-login')->withErrors('Silahkan Login Dahulu... #1');
        if(Auth::guard('karyawan')->user()->status_user != 'aktif') return redirect()->route('karyawan.form-login')->withErrors('Silahkan Login Dahulu... #2');
        return $next($request);
    }
}
