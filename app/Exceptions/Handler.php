<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Handler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        // Handle session expiration
        if ($exception instanceof TokenMismatchException) {
            Auth::logout();     // Log out the user
            Session::flush();   // Clear all session data

            // Handle AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your session expired. Please login again.'
                ], 419);
            }

            // Normal page request
            return redirect('/')
                ->with('error', 'Your session expired. Please login again.');
        }

        return parent::render($request, $exception);
    }
}
