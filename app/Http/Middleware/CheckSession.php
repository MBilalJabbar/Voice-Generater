<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next)
    {
        // Allow login/register pages and AJAX requests
        // if (!Auth::check() && !$request->is('login', 'register', '/') && !$request->ajax()) {
        //     // Session expired → logout user
        //     Auth::logout();

        //     // Session cleanup
        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();

        //     // Redirect to login page with message
        //     return redirect('/login')->with('message', 'Your session has expired. Please login again.');
        // }

// Public routes (guest allowed)
        $allowedRoutes = [
            '/',
            'login',
            'register',
            'password-reset',
            'reset-password',
            'send-forgot-password-link',
            'reset-user-password',
            'auth/google',
            'auth/google/callback',
        ];

        if (!Auth::check() && !$request->is($allowedRoutes) && !$request->ajax()) {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')
                ->with('message', 'Your session has expired. Please login again.');
        }

        return $next($request);
    }

}
