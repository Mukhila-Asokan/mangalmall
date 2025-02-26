<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\FlashMessageMiddleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Controllers\InvitationCardDesignController;

Route::middleware(['auth', FlashMessageMiddleware::class, HandleInertiaRequests::class])->group(function () { 

    Route::get('/home/invitationcard-search', [InvitationCardDesignController::class, 'index']);

});