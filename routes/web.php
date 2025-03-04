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
use App\Http\Controllers\CanvaController;
use App\Http\Controllers\InvitationCardDesignController;
Use App\Http\Controllers\CardEditorController;
use App\Http\Controllers\{CardImageAjaxLoadController, GuestController};

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
Route::get('/logout',[HomeController::class, 'home'])->name('home');
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
    Route::post('/venue-ratings', [VenueRatingController::class, 'store'])->name('venue-ratings.store');
    Route::get('/venue-ratings/{id}', [VenueRatingController::class, 'getVenueRatings']);
    Route::post('/venue-post-comments', [VenueRatingController::class, 'storeComments'])->name('venue.post.comments');
    Route::get('/venur/get-comments', [VenueRatingController::class, 'getComments'])->name('venue.get.comments');


    Route::any('/webpage',[UserWebPageController::class, 'index'])->name('user.webpage');
    
    Route::get('/webpage/occasion/{id}',[UserWebPageController::class, 'getoccasionfields'])->name('user.webpage.occasion');
    Route::post('/webpage/submit', [UserWebPageController::class, 'store'])->name('user.webpage.store');
    Route::any('/webpage/template',[UserWebPageController::class, 'template'])->name('user.webpage.template');
    Route::any('/webpage/showtemplate',[UserWebPageController::class, 'showtemplate'])->name('user.showtemplate');
    Route::any('/webpage/{id}/preview',[UserWebPageController::class, 'preview']);
    Route::any('/webpage/{userid}/{id}/editor', [UserWebPageController::class,'themeeditor'])->name('webpage/themelistview/editor');


    /* Invitation Card Design*/

    Route::any('/carddesign/list',[InvitationCardDesignController::class, 'index'])->name('user.carddesign');

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




Route::middleware(['auth', FlashMessageMiddleware::class, HandleInertiaRequests::class])->group(function () { 

    Route::get('/api/home/invitationcard-search', [InvitationCardDesignController::class, 'index'])->name('invitationcard.search');
    Route::get('/api/home/invitationcard-occasiontype', [InvitationCardDesignController::class, 'getCardTemplates'])->name('invitationcardsearch.occasiontype');

    Route::get('/home/invitationcard/{template_id}/edit', [CardEditorController::class, 'edit'])->name('invitationcard.edit');
    Route::any('/home/invitationcard/getObject', [CardEditorController::class, 'getObject'])->name('invitationcard.getObject');
    
    Route::post('/api/home/invitationcard-search/{id}/update', [InvitationCardDesignController::class, 'update'])->name('invitationcard.update');
    Route::post('/api/home/invitationcard-search/{id}/delete', [InvitationCardDesignController::class, 'destroy'])->name('invitationcard.delete');
    Route::post('/api/home/invitationcard-search', [InvitationCardDesignController::class, 'store'])->name('invitationcard.store');
    Route::get('/api/home/invitationcard-search/{id}/preview', [InvitationCardDesignController::class, 'preview'])->name('invitationcard.preview');
    Route::get('/api/home/invitationcard-search/{id}/download', [InvitationCardDesignController::class, 'download'])->name('invitationcard.download');
    Route::get('/api/home/invitationcard-search/{id}/design', [InvitationCardDesignController::class, 'design'])->name('invitationcard.design');
    Route::get('/api/home/invitationcard-search/{id}/design/{designId}', [InvitationCardDesignController::class, 'design'])->name('invitationcard.design');
    Route::post('/api/home/invitationcard-search/{id}/design', [InvitationCardDesignController::class, 'saveDesign'])->name('invitationcard.saveDesign');
    Route::post('/api/home/invitationcard-search/{id}/design/{designId}', [InvitationCardDesignController::class, 'saveDesign'])->name('invitationcard.saveDesign');    

});


Route::any('/cardinvitation/loadajax/shape', [CardImageAjaxLoadController::class, 'shape']);
Route::any('/cardinvitation/loadajax/library', [CardImageAjaxLoadController::class, 'library']);
Route::any('/cardinvitation/loadajax/library_bg', [CardImageAjaxLoadController::class, 'library_bg']);
Route::any('/cardinvitation/loadajax/ai_image_generator', [CardImageAjaxLoadController::class, 'ai_image_generator']);
Route::any('/cardinvitation/loadajax/ai_image_generator_bg', [CardImageAjaxLoadController::class, 'ai_image_generator_bg']);
Route::any('/cardinvitation/loadajax/ai_text_generator', [CardImageAjaxLoadController::class, 'ai_text_generator']);


//uploadMedia

Route::any('/cardinvitation/uploadMedia', [CardEditorController::class, 'uploadMedia']);
Route::any('/cardinvitation/moreImages', [CardEditorController::class, 'moreImages']);
Route::any('/cardinvitation/save_template', [CardEditorController::class, 'saveTemplate']);

// Guest
Route::get('/guest/contacts/{user_id}', [GuestController::class, 'getGuestContacts'])->name('guest.index');
Route::post('store/guest/contacts', [GuestController::class, 'storeGuest'])->name('guest.store');
Route::get('guest/{id}/edit', [GuestController::class, 'editGuest'])->name('guest.edit');
Route::post('update/guest/contacts', [GuestController::class, 'updateGuest'])->name('guest.update');


require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';