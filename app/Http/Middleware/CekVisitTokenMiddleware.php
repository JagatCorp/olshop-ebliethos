<?php

namespace App\Http\Middleware;

use App\Models\VisitorUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class CekVisitTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah cookie 'token' sudah ada
        if (!$request->cookie('token')) {
            // Simpan token ke database
            VisitorUser::create();

            $response = $next($request);
            // Set cookie 'token', dan expired dalam 1 hari
            return $response->withCookie(cookie('token', 'ebliethos', 60 * 24));
        }

        return $next($request);
    }
}
