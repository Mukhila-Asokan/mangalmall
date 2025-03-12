<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Exceptions\InvalidOrderException;
Use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\HandleInertiaRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        

        $middleware->alias([
            'admin.role' => \App\Http\Middleware\IsAdminRoleCheck::class,
            'flashmessage' => \App\Http\Middleware\FlashMessageMiddleware::class,
            'JwtAuthMiddleware' => \App\Http\Middleware\JwtAuthMiddleware::class,
            'VenueAdminMiddleware' => \Modules\VenueAdmin\Http\Middleware\VenueAdminMiddleware::class,
            'HandleSessionExpiration' => \App\Http\Middleware\HandleSessionExpiration::class,
            'HandleInertiaRequests' => HandleInertiaRequests::class,
            'RedirectIfNotFound' => \App\Http\Middleware\RedirectIfNotFound::class,
            
            
        ]);
      
    })
    ->withExceptions(function (Exceptions $exceptions) {
         //echo "hai";exit();
 
    /* \Log::info('withExceptions() is running',[$exceptions]); // Debugging log */

     
       $exceptions->render(function (\Throwable $exception) {
             \Log::info('Inside Throws Exception',[$exceptions]); // Debugging log
       });
    
    })->create();
