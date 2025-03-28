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
Use App\Models\UserBlog;

use Modules\Venue\Models\VenueType;
use Illuminate\Http\Request;
use App\Http\Middleware\HandleInertiaRequests;

use App\Http\Controllers\UserWebPageController;
use App\Http\Controllers\VenueRatingController;
use App\Http\Controllers\CanvaController;
use App\Http\Controllers\InvitationCardDesignController;
Use App\Http\Controllers\CardEditorController;
use App\Http\Controllers\{CardImageAjaxLoadController, GuestController};
use App\Http\Controllers\CaretakerController;
Use App\Http\Controllers\PricingController;
Use App\Http\Controllers\UserBlogController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BlogCommentController;

use App\Http\Controllers\BlogLikeController;
use App\Http\Controllers\UserChecklistController;
use App\Http\Controllers\{UserBudgetController, UserEventGalleryController};
use App\Http\Controllers\InvitationCardController;



use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return 'Database connection is working!';
    } catch (\Exception $e) {
        return 'Error connecting to database: ' . $e->getMessage();
    }
});
Route::get('/run-migrations', function () {
	
	 try {
        DB::connection()->getPdo();
          Artisan::call('migrate');
    		return Artisan::output(); 
    } catch (\Exception $e) {
        return 'Migration Error : ' . $e->getMessage();
    }
	DB::connection()->getPdo();
  
});

Route::get('/routelist', function () {

     try { 
            Artisan::call('route:list');
            return Artisan::output(); 
     } catch (\Exception $e) {
        return 'routelist : ' . $e->getMessage();
    }

});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "Cache cleared!";
});




Route::get('/get-subtypes/{typeId}', function ($typeId) {

    $venuesubtypes = VenueType::where('delete_status', 0)
        ->where('roottype', $typeId)->get();
    Log::info('Rendering venuesubtypes', $venuesubtypes->toArray());
    return response()->json($venuesubtypes);
});


 /*$username = Session::get('username');
 $username = preg_replace('/\s+/', '_', $username);*/

Route::get('/',[HomeController::class, 'home'])->name('home');
/*Route::get('/home',[HomeController::class, 'home'])->name('home');*/
Route::get('/logout',[HomeController::class, 'home'])->name('logout');
Route::any('/ajaxcvenuesubtypelist',[HomeController::class, 'ajaxcvenuesubtypelist'])->name('home/ajaxcvenuesubtypelist');
Route::any('/venuesearchresults',[HomeController::class, 'venuesearchresults'])->name('home/venuesearchresults');
Route::any('/home/{id}/venuedetails',[HomeController::class, 'venuedetails'])->name('home/venuedetails');

Route::any('/home/ajaxstate',[HomeController::class, 'ajaxstate'])->name('home/ajaxstate');
Route::any('/home/chooselocation',[HomeController::class, 'chooselocation'])->name('home/chooselocation');
Route::post('/home/ajaxcitysearch', [HomeController::class, 'ajaxCitySearch'])->name('home/ajaxcitysearch');


Route::get('/home/venue-search', [VenueSearchController::class, 'index'])->name('venue.search');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::any('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



});

Route::any('/guestblog/show/{id}',[HomeController::class, 'show'])->name('guestblog.show');

Route::prefix('home')->middleware(['auth', FlashMessageMiddleware::class, HandleInertiaRequests::class])->group(function () { 

    Route::any(session('userpath').'/occasion', [UserOccasionController::class, 'index'])->name('home.occasion');
    Route::any(session('userpath').'/occasion/add', [UserOccasionController::class, 'store'])->name('home/occasion/add');
    Route::any(session('userpath').'/occasion/update', [UserOccasionController::class, 'update'])->name('home/occasion/update');

    Route::any(session('userpath').'/venue/search', [VenueController::class, 'index'])->name('home/venue/search');


     Route::any(session('userpath').'/venue/searchtest1', [VenueController::class, 'searchtest'])->name('home/venue/test');

     Route::any(session('userpath').'/occasion/edit', [UserOccasionController::class, 'edit'])->name('home/occasion/edit');

    /*To do */
    Route::any('/eventplan',[HomeController::class, 'eventplan'])->name('home.eventplan');
    
    Route::any('/checklist',[HomeController::class, 'checklist'])->name('home.checklist');
    Route::any('/checklist/create/{occasion_id}',[UserChecklistController::class, 'create'])->name('checklist.create');
    Route::any('/checklist/list',[UserChecklistController::class, 'index'])->name('checklist.index');
    Route::post('/checklist/store', [UserChecklistController::class, 'store'])->name('checklist.store');
    Route::post('/checklist/update-status', [UserChecklistController::class, 'updateStatus'])->name('checklist.updateStatus');
    Route::put('/checklist/update/{id}', [UserChecklistController::class, 'update'])->name('checklist.update');
    Route::delete('/checklist/destroy/{id}', [UserChecklistController::class, 'destroy'])->name('checklist.destroy');

    /*Budget*/
    Route::any('/budget',[UserBudgetController::class, 'index'])->name('home.budget');
    Route::any('/budget/create/{budget_id}',[UserBudgetController::class, 'create'])->name('homebudget.create');
    Route::any('/budget/list',[UserBudgetController::class, 'index'])->name('budget.index');
    Route::post('/budget/store', [UserBudgetController::class, 'store'])->name('userbudget.store');
    Route::post('/budget/update-status', [UserBudgetController::class, 'updateStatus'])->name('budget.updateStatus');
    Route::post('/budget/update', [UserBudgetController::class, 'update'])->name('userbudget.update');
    Route::delete('/budget/destroy/{id}', [UserBudgetController::class, 'destroy'])->name('userbudget.destroy');

    // Event Gallery
    Route::any('/event/gallery',[UserEventGalleryController::class, 'index'])->name('home.event.gallery');
    Route::get('/event/gallery/add/{event_id}',[UserEventGalleryController::class, 'add'])->name('home.gallery.add');
    Route::post('/event/gallery/create',[UserEventGalleryController::class, 'create'])->name('home.gallery.create');
    Route::post('/event/gallery/delete',[UserEventGalleryController::class, 'delete'])->name('home.gallery.delete');

    // Event Itinerary
    Route::any('/event/itinerary',[UserEventGalleryController::class, 'itineraryList'])->name('home.event.itinerary');
    Route::any('/event/itinerary/add/{id}',[UserEventGalleryController::class, 'itineraryAdd'])->name('home.itinerary.add');
    Route::any('/event/itinerary/store',[UserEventGalleryController::class, 'itineraryStore'])->name('home.itinerary.store');
    Route::any('/event/itinerary/delete/{id}',[UserEventGalleryController::class, 'itineraryDelete'])->name('home.itinerary.delete');
    Route::get('/event/{id}',[UserOccasionController::class, 'view'])->name('view.event.page');

    // Event Collaborate
    Route::post('/event/collaborate',[UserEventGalleryController::class, 'collaborate'])->name('collaborate.event');
    Route::post('/event/share',[UserEventGalleryController::class, 'share'])->name('share.event');
    
    Route::any('/blog/list',[UserBlogController::class, 'index'])->name('blog.index');
    Route::any('/blog/create',[UserBlogController::class, 'create'])->name('blog.create');
    /*check-slug*/
    
    Route::any('/blog/check-slug',function (Illuminate\Http\Request $request) {
        $slugExists = UserBlog::where('slug', $request->slug)->exists();
        return response()->json(['exists' => $slugExists]);
    })->name('blog.check-slug');

    Route::any('/bloglike/{id}', [BlogLikeController::class, 'toggleLike'])->name('blog.like');
    Route::any('/bloggetlikes/{id}', [BlogLikeController::class, 'getLikes'])->name('blog.likes');

    Route::any('/blog/store',[UserBlogController::class, 'store'])->name('blog.store');
    Route::any('/blog/{id}/edit',[UserBlogController::class, 'edit'])->name('blog.edit');
    Route::any('/blog/update/{id}',[UserBlogController::class, 'update'])->name('blog.update');
    Route::any('/blog/delete/{id}',[UserBlogController::class, 'destroy'])->name('blog.destroy');
    Route::any('/blog/show/{id}',[UserBlogController::class, 'show'])->name('blog.show');
    Route::any('/blog/{id}/preview',[UserBlogController::class, 'preview'])->name('blog.preview');
    Route::post('/comments/store', [BlogCommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{blogId}', [BlogCommentController::class, 'getComments'])->name('comments.get');
    Route::get('/comments/get/{blogId}', [BlogCommentController::class, 'getComments'])->name('comments.get');

  

    Route::any('/venuereact-search', [VenueSearchController::class, 'index'])->name('venuereact.search');
    Route::any('/venuesearch', [VenueSearchController::class, 'index'])->name('venuereact.search');

    Route::any('/venuesyn-search', [VenueSearchController::class, 'syncfushindex'])->name('venuesyn.search');
    Route::any('/venuesearch/{id}/venuedetails',[VenueSearchController::class, 'venuedetails'])->name('venuesearch/venuedetails');
    Route::post('/submit-enquiry',[VenueSearchController::class, 'submitBookingEnquiry'])->name('submit/venue/booking');
    Route::get('/submit-enquiry',[VenueSearchController::class, 'submitBookingEnquiry'])->name('submit/venue/booking');
    Route::get('getBookings/{id}/{month}/{year}',[VenueController::class, 'getBookingsOnMonth'])->name('get.bookings.on.date');

     
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
    Route::any('/webpage/{userid}/{id}/editor/', [UserWebPageController::class,'themeeditor'])->name('webpage/themelistview/editor');

    Route::any('/theme/load_media_library_img', [UserWebPageController::class,'load_media_library_img'])->name('home.load_media_library_img');
    Route::any('/theme/load_api_img', [UserWebPageController::class,'load_api_img'])->name('home.load_api_img');
    Route::any('/theme/saveMyTemplate', [UserWebPageController::class,'saveMyTemplate'])->name('home.saveMyTemplate');
    Route::any('/fileupload', [UserWebPageController::class,'fileupload'])->name('home.fileupload');


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

    Route::get('/user/profile', [ProfileController::class, 'profile'])->name('user.profile');   
    Route::any('/home/pricing', [PricingController::class, 'index'])->name('home.pricing');  

    /* Video Making */
    Route::get('/video/index', [VideoController::class, 'index'])->name('video.index');
    Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');

    Route::any('/api/create-video', [VideoController::class, 'usercreateVideo']);

    Route::post('/video/store', [VideoController::class, 'store'])->name('video.store');
    Route::get('/video/download/{id}', [VideoController::class, 'download'])->name('video.download');
    Route::get('/video/show/{id}', [VideoController::class, 'show'])->name('video.show');
    Route::get('/video/edit/{id}', [VideoController::class, 'edit'])->name('video.edit');
    Route::post('/video/update/{id}', [VideoController::class, 'update'])->name('video.update');
    Route::get('/video/destroy/{id}', [VideoController::class, 'destroy'])->name('video.destroy');   
    Route::get('/video/get-videos', [VideoController::class, 'getVideos'])->name('video.get-videos');
    Route::get('/video/get-video/{id}', [VideoController::class, 'getVideo'])->name('video.get-video');

    Route::post('/images-upload', [VideoController::class, 'uploadImages'])->name('images.upload');

    Route::get('/media/upload', [VideoController::class, 'uploadImagesView'])->name('media.upload');
    Route::post('/media/images/upload', [VideoController::class, 'uploadImages'])->name('images.upload');
    Route::post('/media/audio/upload', [VideoController::class, 'uploadAudio'])->name('audio.upload');
    
    Route::post('/media/video/create', [VideoController::class, 'createVideo'])->name('video.create');


    Route::any('/inviationcard', [InvitationCardController::class, 'index'])->name('inviationcard');
    Route::any('/inviationcard/create', [InvitationCardController::class, 'create'])->name('invitationcard.create');
    Route::any('/inviationcard/store', [InvitationCardController::class, 'store'])->name('invitationcard.store');
    Route::any('/inviationcard/edit/{id}', [InvitationCardController::class, 'edit'])->name('invitationcard.edit');
    Route::any('/invitationcard/delete/{id}', [InvitationCardController::class, 'destroy'])->name('invitationcard.delete');

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
Route::any('/cardinvitation/save_template', [CardEditorController::class, 'saveTemplate'])->name('cardinvitation.save_template');

/*
Route::any('/cardinvitation/openBgClippingEditor', [CardEditorController::class, 'openBgClippingEditor'])->name('cardinvitation.openBgClippingEditor');
Route::any('/cardinvitation/downloadBgClippingImage', [CardEditorController::class, 'downloadBgClippingImage'])->name('cardinvitation.downloadBgClippingImage');*/

// Guest
Route::get('/guest/contacts/ajax', [GuestController::class, 'getGuestContactsAjax'])->name('guest.contacts');
Route::get('/guest/contacts/{user_id}', [GuestController::class, 'getGuestContacts'])->name('guest.index');
Route::post('store/guest/contacts', [GuestController::class, 'storeGuest'])->name('guest.store');
Route::get('guest/{id}/edit', [GuestController::class, 'editGuest'])->name('guest.edit');
Route::post('update/guest/contacts', [GuestController::class, 'updateGuest'])->name('guest.update');
Route::get('guest/{id}/delete', [GuestController::class, 'deleteGuest'])->name('guest.delete');
Route::get('guest/search', [GuestController::class, 'searchGuest'])->name('guest.search');
Route::get('get/guest/new-group', [GuestController::class, 'getNewGroupGuest'])->name('guest.new-group');
Route::get('download/guest/contact/format', [GuestController::class, 'downloadGuestFormat'])->name('download.guest.format');
Route::post('upload/guest/contacts', [GuestController::class, 'uploadGuestContacts'])->name('upload.guest.contacts');
Route::post('check/unique/validation/guests', [GuestController::class, 'checkUniqueGuests'])->name('guest.checkUnique');

//Guest group
Route::get('/guest/group/ajax', [GuestController::class, 'getGuestGroupAjax'])->name('guest.group');
Route::get('/guest/group/contacts', [GuestController::class, 'getGuestGroupContacts'])->name('guest.group.index');
Route::post('create/guest/group', [GuestController::class, 'createGuestGroup'])->name('guest.create.group');
Route::get('guest/group/{id}/edit', [GuestController::class, 'editGuestGroup'])->name('guest.edit.group');
Route::post('update/guest/group', [GuestController::class, 'updateGuestGroup'])->name('guest.update.group');
Route::post('update/group/text', [GuestController::class, 'updateGuestGroupText'])->name('guest.update.group.text');
Route::get('guest/group/search', [GuestController::class, 'searchGuestGroup'])->name('guest.group.search');
Route::post('add/guest/group/', [GuestController::class, 'addGuestInGroup'])->name('add.guest.group');
Route::post('delete/guest/group', [GuestController::class, 'deleteGuestGroup'])->name('guest.group.delete');
Route::post('check/unique/validation/group', [GuestController::class, 'checkUniqueGroup'])->name('group.checkUnique');

//caretaker
Route::post('create/caretaker', [CaretakerController::class, 'createCaretaker'])->name('create.caretaker');
Route::get('caretaker/list', [CaretakerController::class, 'listCaretaker'])->name('list.caretaker');
Route::get('caretaker/list/ajax', [CaretakerController::class, 'listCaretakerAjax'])->name('list.caretaker.ajax');
Route::get('guest/list/caretaker/add', [CaretakerController::class, 'listGuestCaretaker'])->name('list.guest.caretaker');
Route::post('create/caretaker/more', [CaretakerController::class, 'createCaretakerGuests'])->name('create.caretaker.more');
Route::get('caretaker/search', [CaretakerController::class, 'searchCaretaker'])->name('caretaker.search');
Route::get('edit/caretaker/{id}', [CaretakerController::class, 'editCaretaker'])->name('caretaker.edit');
Route::post('update/caretaker', [CaretakerController::class, 'updateCaretaker'])->name('caretaker.update');
Route::post('delete/caretaker', [CaretakerController::class, 'deleteCaretaker'])->name('caretaker.delete');
Route::post('check/unique/validation/caretaker', [CaretakerController::class, 'checkUnique'])->name('caretaker.checkUnique');

Route::get('/get/group/carteaker/details', [CaretakerController::class, 'viewDetails'])->name('guest.group.caretaker.view');

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';