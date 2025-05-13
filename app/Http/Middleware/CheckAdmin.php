<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and has admin role
        if (Auth::check() && Auth::user()->admin) {
            return $next($request);
        }

        // Redirect to login page if not authenticated or not an admin
        return redirect()->route('admin.login')->with('error', 'You must be an admin to access this page.');
    }
}
