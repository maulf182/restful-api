<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Handle an unauthenticated user.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika request mengharapkan JSON, return null supaya tidak redirect
        if ($request->expectsJson()) {
            return null;
        }

        // Untuk web biasa, boleh redirect ke login
        return route('login');
    }

    /**
     * Override response jika tidak authenticated (khusus API)
     */
    protected function unauthenticated($request, array $guards)
    {
        // Return response JSON Unauthorized
        abort(response()->json([
            'message' => 'Unauthorized.'
        ], 401));
    }
}
