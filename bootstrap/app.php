<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'IsAdminRoleCheck' => \App\Http\Middleware\IsAdminRoleCheck::class,
            'flashmessage' => \App\Http\Middleware\FlashMessageMiddleware::class,
            'JwtAuthMiddleware' => \App\Http\Middleware\JwtAuthMiddleware::class,
            'VenueAdminMiddleware' => \Modules\VenueAdmin\Http\Middleware\VenueAdminMiddleware::class,
            'HandleSessionExpiration' => \App\Http\Middleware\HandleSessionExpiration::class,
            'HandleInertiaRequests' => \App\Http\Middleware\HandleInertiaRequests::class,
            
            
        ]);
      
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
