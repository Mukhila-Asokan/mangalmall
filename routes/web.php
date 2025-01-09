<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';