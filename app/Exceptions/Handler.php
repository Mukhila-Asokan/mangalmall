<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    // 404 Error Handling
    if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
        return response()->view('errors.404', [], 404);
    }

    // 500 Error Handling
    if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface 
        && $exception->getStatusCode() === 500) {
        return response()->view('errors.500', [], 500);
    }

    // Authentication Error Handling
    if ($exception instanceof AuthenticationException) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Authentication failed. Please check your credentials.',
            ], 401);
        }

        return redirect()->guest(route('login'))->withErrors([
            'login_error' => 'Authentication failed. Please check your credentials.'
        ]);
    }

    // CSRF Token Error Handling (Common in Laravel)
    if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
        return redirect()->back()->withErrors([
            'csrf_error' => 'Your session has expired. Please try again.'
        ]);
    }

    // Handle Database or Query Exceptions (Helpful for debugging)
    if ($exception instanceof \Illuminate\Database\QueryException) {
        return response()->view('errors.db-error', [
            'errorMessage' => $exception->getMessage()
        ], 500);
    }

    return parent::render($request, $exception);
}


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return redirect()->route('login')->with([
                'success' => false,
                'status' => 'error',
                'message' => 'Authentication failed. Please log in again.',
            ], 401);
        }

        return redirect()->guest(route('login'))->with('error', 'Your session has expired. Please log in again.');
    }
}
