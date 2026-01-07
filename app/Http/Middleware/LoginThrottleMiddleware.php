<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class LoginThrottleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'login-attempts:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return response()->json([
                'message' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.',
                'retry_after' => $seconds
            ], 429);
        }

        RateLimiter::hit($key, 300); // 5 minutes

        $response = $next($request);

        // Clear the rate limiter on successful login
        if (auth()->check()) {
            RateLimiter::clear($key);
        }

        return $response;
    }
}
