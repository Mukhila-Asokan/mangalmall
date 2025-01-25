<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserOccasionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\FlashMessageMiddleware;
use App\Http\Controllers\VenueController;

 /*$username = Session::get('username');
 $username = preg_replace('/\s+/', '_', $username);*/

Route::get('/',[HomeController::class, 'home'])->name('home');
Route::any('/ajaxcvenuesubtypelist',[HomeController::class, 'ajaxcvenuesubtypelist'])->name('home/ajaxcvenuesubtypelist');
Route::any('/venuesearchresults',[HomeController::class, 'venuesearchresults'])->name('home/venuesearchresults');
Route::any('/home/{id}/venuedetails',[HomeController::class, 'venuedetails'])->name('home/venuedetails');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});


Route::prefix('home')->middleware(['auth', FlashMessageMiddleware::class])->group(function () { 

    Route::any(session('userpath').'/occasion', [UserOccasionController::class, 'index'])->name('home/occasion');
    Route::any(session('userpath').'/occasion/add', [UserOccasionController::class, 'store'])->name('home/occasion/add');

    Route::any(session('userpath').'/venue/search', [VenueController::class, 'index'])->name('home/venue/search');

     Route::any(session('userpath').'/occasion/edit', [UserOccasionController::class, 'edit'])->name('home/occasion/edit');

});

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';