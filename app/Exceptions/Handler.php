<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
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

    public function render($request, Throwable $exception) : \Symfony\Component\HttpFoundation\Response
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

    if ($exception instanceof TokenMismatchException) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Your session expired or the page was open too long. Please try again.');
    }


    if ($exception instanceof TokenMismatchException) {
        Log::info('Custom CSRF handler triggered');
        if ($request->expectsJson() || $request->isJson() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'CSRF token mismatch or session expired.',
                'exception' => get_class($exception),
            ], 419);
        }

        return redirect()->back()
            ->withInput()
            ->withErrors([
                'csrf_error' => 'Your session has expired. Please refresh the page and try again.'
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
