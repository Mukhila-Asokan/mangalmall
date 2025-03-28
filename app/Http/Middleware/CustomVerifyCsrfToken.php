<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;

class CustomVerifyCsrfToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   /* public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }*/

    protected function handleInvalidToken($request, TokenMismatchException $exception)
    {
        Log::info('Custom CSRF handler triggered');

        
        if ($request->expectsJson() || $request->isJson() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Invalid or missing CSRF token.',
            ], 419);
        }

        return redirect()->back()
            ->withInput()
            ->withErrors(['csrf_error' => 'Session expired. Please try again.']);
    }

}
