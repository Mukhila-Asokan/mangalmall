<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserOccasionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\FlashMessageMiddleware;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\VenueSearchController;
use Illuminate\Support\Facades\Log;

use Modules\Venue\Models\VenueType;
use Illuminate\Http\Request;

Route::get('/get-subtypes/{typeId}', function ($typeId) {

    $venuesubtypes = VenueType::where('delete_status', 0)
        ->where('roottype', $typeId)->get();
    Log::info('Rendering venuesubtypes', $venuesubtypes->toArray());
    return response()->json($venuesubtypes);
});


 /*$username = Session::get('username');
 $username = preg_replace('/\s+/', '_', $username);*/

Route::get('/',[HomeController::class, 'home'])->name('home');
Route::get('/home',[HomeController::class, 'home'])->name('home');
Route::any('/ajaxcvenuesubtypelist',[HomeController::class, 'ajaxcvenuesubtypelist'])->name('home/ajaxcvenuesubtypelist');
Route::any('/venuesearchresults',[HomeController::class, 'venuesearchresults'])->name('home/venuesearchresults');
Route::any('/home/{id}/venuedetails',[HomeController::class, 'venuedetails'])->name('home/venuedetails');

Route::get('/home/venue-search', [VenueSearchController::class, 'index'])->name('venue.search');

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


     Route::any(session('userpath').'/venue/searchtest1', [VenueController::class, 'searchtest'])->name('home/venue/test');

     Route::any(session('userpath').'/occasion/edit', [UserOccasionController::class, 'edit'])->name('home/occasion/edit');

      Route::any('/venuereact-search', [VenueSearchController::class, 'index'])->name('venuereact.search');

});


Route::middleware(['auth'])->group(function () {
   
});

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';