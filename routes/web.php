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
use App\Http\Middleware\HandleInertiaRequests;

use App\Http\Controllers\UserWebPageController;
use App\Http\Controllers\VenueRatingController;

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

Route::any('/home/ajaxstate',[HomeController::class, 'ajaxstate'])->name('home/ajaxstate');
Route::any('/home/chooselocation',[HomeController::class, 'chooselocation'])->name('home/chooselocation');
Route::post('/home/ajaxcitysearch', [HomeController::class, 'ajaxCitySearch'])->name('home/ajaxcitysearch');


Route::get('/home/venue-search', [VenueSearchController::class, 'index'])->name('venue.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



});


Route::prefix('home')->middleware(['auth', FlashMessageMiddleware::class, HandleInertiaRequests::class])->group(function () { 

    Route::any(session('userpath').'/occasion', [UserOccasionController::class, 'index'])->name('home/occasion');
    Route::any(session('userpath').'/occasion/add', [UserOccasionController::class, 'store'])->name('home/occasion/add');

    Route::any(session('userpath').'/venue/search', [VenueController::class, 'index'])->name('home/venue/search');


     Route::any(session('userpath').'/venue/searchtest1', [VenueController::class, 'searchtest'])->name('home/venue/test');

     Route::any(session('userpath').'/occasion/edit', [UserOccasionController::class, 'edit'])->name('home/occasion/edit');

    Route::any('/venuereact-search', [VenueSearchController::class, 'index'])->name('venuereact.search');
    Route::any('/venuesearch', [VenueSearchController::class, 'index'])->name('venuereact.search');

    Route::any('/venuesyn-search', [VenueSearchController::class, 'syncfushindex'])->name('venuesyn.search');
    Route::any('/venuesearch/{id}/venuedetails',[VenueSearchController::class, 'venuedetails'])->name('venuesearch/venuedetails');

     
    Route::any('/ads/random', [VenueSearchController::class, 'adsrandom'])->name('venue/adsrandom');
    Route::post('/venue-ratings', [VenueRatingController::class, 'store']);
    Route::get('/venue-ratings/{id}', [VenueRatingController::class, 'getVenueRatings']);


    Route::any('/webpage',[UserWebPageController::class, 'index'])->name('user.webpage');
    
    Route::get('/webpage/occasion/{id}',[UserWebPageController::class, 'getoccasionfields'])->name('user.webpage.occasion');
    Route::post('/webpage/submit', [UserWebPageController::class, 'store'])->name('user.webpage.store');
    Route::any('/webpage/template',[UserWebPageController::class, 'index'])->name('user.webpage.template');


});


Route::middleware(['auth'])->group(function () {
   
});

Route::get('/test-purifier', function () {
    $html = "<p>This is a <strong>test</strong>.</p>"; // Simple HTML
    return view('test-purifier', ['html' => $html]);
});


Route::any('/errorpage',function () {
    return view('errorpage');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';