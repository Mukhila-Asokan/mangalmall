<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

  
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->route('login')->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Authentication failed. Please log in again.',
            ], 401);
        }

        return redirect()->guest(route('login'))->with('error', 'Your session has expired. Please log in again.');
    }
}
