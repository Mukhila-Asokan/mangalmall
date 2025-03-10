<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\VenueAdmin\Models\VenueUser;
use Modules\VenueAdmin\Models\UserVenue;
use Modules\VenueAdmin\Models\VenueBookingContact;
Use Modules\Venue\Models\VenueImage;
use Modules\Venue\Models\VenueContent;
use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
Use Modules\Venue\Models\VenueDataField;
Use Modules\Venue\Models\VenueDataFieldDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueGalleryImage;
use Modules\Venue\Models\VenueThemeBuilder;
use Modules\Venue\Models\VenueDetails;
use Modules\Venue\Models\VenueCampaigns;
use Modules\Venue\Models\Imagelibrary;
use Modules\Venue\Models\Area;
use Modules\VenueAdmin\Models\VenueBooking;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\BookingEnquiry;
use Session;
use Carbon\Carbon;
use App\Notifications\ChangeMobileNo;
use DataTables;
use Svg\Tag\Rect;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Log;

class VenueAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('venueadmin::auth.login');
    }

    public function mobileotp(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'mobileno' => 'required', 'string', 'regex:/^[0-9]{10}$/'
        ]);

      

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }

        $mobilenocheck = VenueUser::where('mobileno',$request->mobileno)->first();

        if(!empty($mobilenocheck))
        {
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'OTP Send your mobile, Please check';
        }
        else
        {
            $browserResponse['status']   = 'failed';
            $browserResponse['message']  = 'Please check your mobile no';
        }

       
        return response()->json($browserResponse, 200);
    }


    public function sendotp(Request $request)
    {
         $request->validate([
            'mobileno' => 'required|string|regex:/^[0-9]{10}$/|unique:venueuser',
            'yourname' => 'required',
            'venuecity' => 'required'
        ],[
        'yourname.required' => 'Your name is required, Please enter.',
        ]);

       /* if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }*/

        $browserResponse['status']   = 'success';
        $browserResponse['message']  = 'OTP Send your mobile, Please check';

        return response()->json($browserResponse, 200);
    }

    public function newaccountadd(Request $request)
    {
        $newvenue = new VenueUser();
        $newvenue->name = $request->yourname;
        $newvenue->mobileno = $request->mobileno ;
        $newvenue->city = $request->venuecity ;
        $newvenue->email = 'admin@gmail.com' ;
        $newvenue->role = 'Venue Admin' ;
        $newvenue->status = 'Inactive';
        $newvenue->save();

        return redirect('venue/login')->with('success', 'Registered Successfully, Please login in');
    }

    public function logincheck(Request $request)
    {
        $request->validate([
            'mobileno' => 'required', 'string', 'regex:/^[0-9]{10}$/',
            'mobileotp' => 'required'
        ]);

        $mobilenocheck = VenueUser::where('mobileno',$request->mobileno)->first();



        if(!empty($mobilenocheck))
        {
             $request->session()->put('mobile_verified', true);
             $request->session()->put('username', $mobilenocheck->name);
             $request->session()->put('mobileno', $mobilenocheck->mobileno);
             $request->session()->put('city', $mobilenocheck->city);
             $request->session()->put('email', $mobilenocheck->email);
             $request->session()->put('venueuserid', $mobilenocheck->id);
             
            if($mobilenocheck->status == "Inactive")
            {
                return redirect('venueadmin/inactiveuser')->with('success', 'Please contact Mangal Mall team to activate your account');
            }
            else
            {
                return redirect('venueadmin/dashboard')->with('success', 'Welcome to the dashboard');
            }
        }



        return redirect('venue/login')->with('error', 'Please check your mobile no');
    }

    public function inactiveuser()
    {
        return view('venueadmin::auth.inactiveuser');
    }

    public function createvenue()
    {
        $pagetitle = "Add New Venue";
        $pageroot = "Home"; 
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::orderBy('City')->get();
        return view('venueadmin::venueuser.create',compact('pagetitle','pageroot','venuetypes','venueamenities','venuedatafield','arealocation'));
    }

    public function editvenue($id){
        $pagetitle = "Edit Venue";
        $pageroot = "Home";
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = Area::orderBy('cityid')->get();
        $venue = VenueDetails::where('id',$id)->first();
        return view('venueadmin::venueuser.edit', compact('pagetitle','pageroot','venuetypes','venueamenities','venuedatafield','arealocation','venue'));
    }


    public function storevenue(Request $request)
    {
        $contactMobile = ltrim($request->input('contactmobile'), '0'); 
        $request->merge(['contactmobile' => $contactMobile]);
        $validator = Validator::make($request->all(),[
            'venuename' => 'required',
            'venueaddress' => 'required',
            'locationid' => 'required',
            'description' => 'required',
            'contactperson' => 'required',
            'contactmobile' => 'required|unique:venuedetails|digits:10', 
            'venuetypeid' => 'required',         
           
         ]);

         if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $venuedetails = new VenueDetails;
        $venuedetails->venuename = $request->venuename;
        $venuedetails->venueaddress = $request->venueaddress;
        $venuedetails->locationid = $request->locationid;
        $venuedetails->description = $request->description;
        $venuedetails->contactperson = $request->contactperson;
        $venuedetails->contactmobile = $request->contactmobile;
        $venuedetails->contacttelephone = $request->contacttelephone  ?? '';
        $venuedetails->contactemail = $request->contactemail ?? '';
        $venuedetails->websitename = $request->websitename ?? '';
        $venuedetails->venuetypeid = $request->venuetypeid;
        $venuedetails->venuesubtypeid = 0;
        $venuedetails->bookingprice = $request->bookingprice;
        $venuedetails->budgetperplate = $request->budgetperplate ?? '';
        $venuedetails->capacity = $request->capacity;
        $venuedetails->food_type = $request->food_type;
        $venuedetails->is_worth = 'none';
        $venuedetails->googlemap = $request->googlemap ?? '-';

       /* $venuedetails->venueamenities = json_encode(array_map('intval', $request->venueamenities)); 
        $venuedetails->venuedata = json_encode(array_map('intval', $request->datafieldvalue));*/

        $venueamenities = $request->venueamenities ?? [];
        $venuedata = $request->datafieldvalue ?? [];

        if (!empty($venueamenities) && is_array($venueamenities)) {
            $venuedetails->venueamenities = json_encode(array_map('intval', $venueamenities));
        } else {
            $venuedetails->venueamenities = json_encode([]);
        }

        if (!empty($venuedata) && is_array($venuedata)) {
            $venuedetails->venuedata = json_encode(array_map('intval', $venuedata));
        } else {
            $venuedetails->venuedata = json_encode([]);
        }

        $filename = '';
        if ($request->hasFile('bannerimage')) {
            $filename = $request->file('bannerimage')->store('venuebannerimage', 'public_uploads');
            /*$filename = $request->file('bannerimage')->storeAs('venuebannerimage', time().'_'.$request->file('bannerimage')->getClientOriginalName(), 'public');*/
        }
    
        $venuedetails->bannerimage = $filename;
        $venuedetails->featured = 1;
        $venuedetails->status = 'Active'; 
        $venuedetails->delete_status = 0;

        try{
            $venuedetails->save();
        }
        catch (Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        $uservenue = new UserVenue;
        $uservenue->venueid = $venuedetails->id;
        $uservenue->venueuserid = Session::get('venueuserid');
        $uservenue->save();

        return redirect('venueadmin/venuelist')->with('success', 'Venue Details Successfully created');
    }

    public function updateVenue(Request $request,$id)
    {
        $contactMobile = ltrim($request->input('contactmobile'), '0'); 
        $request->merge(['contactmobile' => $contactMobile]);
        $validator = Validator::make($request->all(),[
            'venuename' => 'required',
            'venueaddress' => 'required',        
            'description' => 'required',
            'contactperson' => 'required',
            'contactmobile' => 'required|digits:10|unique:venuedetails,contactmobile,' . $id, 
            'venuetypeid' => 'required',      
            'capacity' => 'required',  
            'food_type' => 'required',
            'bookingprice' => 'required',
            'venuearea' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $venuedetails = VenueDetails::findOrFail($id);
        $venuedetails->venuename = $request->venuename;
        $venuedetails->venueaddress = $request->venueaddress;
        $venuedetails->locationid = $request->locationid;
        $venuedetails->description = $request->description;
        $venuedetails->contactperson = $request->contactperson;
        $venuedetails->contactmobile = $request->contactmobile;
        $venuedetails->contacttelephone = $request->contacttelephone ?? '';
        $venuedetails->contactemail = $request->contactemail ?? '';
        $venuedetails->websitename = $request->websitename ?? '';
        $venuedetails->venuetypeid = $request->venuetypeid;
        $venuedetails->venuesubtypeid = 0;
        $venuedetails->bookingprice = $request->bookingprice;
        $venuedetails->budgetperplate = $request->budgetperplate ?? '';
        $venuedetails->capacity = $request->capacity;
        $venuedetails->food_type = $request->food_type;
        $venuedetails->is_worth = 'none';
        $venuedetails->googlemap = $request->googlemap ?? '-';

        $venueamenities = $request->venueamenities ?? [];
        $venuedata = array_values($request->datafieldvalue) ?? [];

        if (!empty($venueamenities) && is_array($venueamenities)) {
            $venuedetails->venueamenities = json_encode(array_map('intval', $venueamenities));
        } else {
            $venuedetails->venueamenities = json_encode([]);
        }

        if (!empty($venuedata) && is_array($venuedata)) {
            $venuedetails->venuedata = json_encode(array_map('intval', $venuedata));
        } else {
            $venuedetails->venuedata = json_encode([]);
        }

        if ($request->hasFile('bannerimage')) {
            $filename = $request->file('bannerimage')->store('venuebannerimage', 'public_uploads');
            $venuedetails->bannerimage = $filename;
        }

        $venuedetails->featured = 1;
        $venuedetails->status = 'Active'; 
        $venuedetails->delete_status = 0;

        try {
            $venuedetails->save();
        } catch (Exception $e) {          
            Log::error($e); // Log the entire exception object
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect('venueadmin/venuelist')->with('success', 'Venue Details Successfully updated');
    }

    public function viewvenue($id){
        $pagetitle = "Venue Details";
        $pageroot = "Home";
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = Area::orderBy('cityid')->get();
        $venuedetails = VenueDetails::where('id',$id)->first();
        $venuedatafielddetails = VenueDataFieldDetails::where('delete_status',0)->get();
        return view('venueadmin::venueuser.view', compact('pagetitle','pageroot','venuetypes','venueamenities','venuedatafield','arealocation','venuedetails', 'venuedatafielddetails'));
    }

    public function venueGallery($id){
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Image";
        $pageroot = "Venue"; 
        $venue = VenueDetails::where('id',$id)->first();
        $venueimage = VenueImage::where('venue_id',$id)->get(); 
        return view('venueadmin::venueuser.venueimage',compact('pagetitle','pageroot','username','venue','venueimage'));
    }

    public function venueimageAdd(Request $request){
        $id = $request->venue_id;

        $validator = Validator::make($request->all(), [
            'sliderimage' => 'required_without:galleryimage',
            'sliderimage.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'galleryimage' => 'required_without:sliderimage',
            'galleryimage.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'venue_id' => 'required|exists:venuedetails,id',
        ], [
            'galleryimage.required_without' => 'Either slider image or gallery image is required.',
            'sliderimage.required_without' => 'Either slider image or gallery image is required.',
        ]);

         if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $venue = VenueDetails::find($request->venue_id);

        // Handle slider images
        if ($request->hasFile('sliderimage')) {
         
            foreach ($request->file('sliderimage') as $image) {
                $filename = time() . '-' . $image->getClientOriginalName();
                $path = $image->storeAs('venue_images', $filename, 'public');

                $image_type = 'slider';

              $result =   VenueImage::create([
                    'venue_id' => $id,
                    'image_path' => $path,
                    'image_type' => $image_type,
                ]);
            }
        }

        // Handle gallery images
        if ($request->hasFile('galleryimage')) {
            foreach ($request->file('galleryimage') as $image) {
                $filename = time() . '-' . $image->getClientOriginalName();
                $path = $image->storeAs('venue_images', $filename, 'public');

                VenueImage::create([
                    'venue_id' => $id,
                    'image_path' => $path,
                    'image_type' => 'gallery',
                ]);
            }
        }
       
        return redirect()->back()->with('success', 'Venue Image successfully created');
    }

    public function imageDelete(Request $request)
    {
        $image = VenueImage::find($request->id);
        if ($image) {
            Storage::delete('public/venue_images/' . $image->image_path);
            $image->delete();
            return response()->json(['success' => true, 'message' => 'Image deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Image not found!']);
    }

    public function venuecontent($id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Content";
        $pageroot = "Venue"; 
        $venue = VenueDetails::where('id',$id)->first();
        $venuecontent = VenueContent::where('venue_id',$id)->first();       
        return view('venueadmin::venueuser.venuecontent',compact('pagetitle','pageroot','username','venue','venuecontent'));
    }

    public function contentAdd(Request $request)
    {
        $id = $request->venue_id;
        $venue_content = VenueContent::where('venue_id',$id)->first(); 
        if ($venue_content !== null && count((array)$venue_content) > 0) { // Check for null first, then cast to array
            $venuecontent = VenueContent::find($venue_content->id);
        } else {
            $venuecontent = new VenueContent;
        }
        
        $venuecontent->venue_id = $id;
        $venuecontent->description = $request->description;
        $venuecontent->key_features = $request->key_features;
        $venuecontent->ambience = $request->ambience;
        $venuecontent->event_sustability = $request->event_sustability;
        $venuecontent->amenities = $request->amenities;
        $venuecontent->policy = $request->policy;       
        $venuecontent->save();
        return redirect()->back()->with('success', 'Venue Content successfully updated');
    }

    public function dashboard()
    {
        try{
            $pagetitle = "Dashboard";
            $pageroot = "Home"; 
            $bookings =  BookingEnquiry::where('venue_user_id', Session::get('venueuserid'))->where('status', 'open')->orderBy('id', 'desc')->limit(2)->get();
            $topBookedVenues = VenueBooking::join('venuedetails', 'venuebooking.venue_id', '=', 'venuedetails.id')
                        ->select('venuedetails.venuename', 'venuedetails.description', DB::raw('COUNT(venuebooking.id) as total_bookings'))
                        ->where('venuebooking.bookinguserid', Session::get('venueuserid'))
                        ->groupBy('venuedetails.id', 'venuedetails.venuename', 'venuedetails.description')
                        ->orderByDesc('total_bookings')
                        ->limit(7)
                        ->get();
            $user = VenueUser::where('id', \Session::get('venueuserid'))->first();
        }
        catch(\Exception $e){
            dd($e);
        }
        return view('venueadmin::auth.dashboard',compact('pagetitle','pageroot', 'bookings', 'topBookedVenues', 'user'));
    }

    public function dashboardChart(){
        try{
            $startDate = Carbon::now()->subMonths(4)->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();

            $bookings = VenueBooking::selectRaw("DATE_FORMAT(start_date, '%Y-%m') as month, COUNT(*) as booking_count")
                ->where('bookinguserid', Session::get('venueuserid'))
                ->where(function($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function($q) use ($startDate, $endDate) {
                                $q->where('start_date', '<=', $startDate)
                                    ->where('end_date', '>=', $endDate);
                            });
                })
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('booking_count', 'month')
                ->toArray();

            $today = Carbon::now()->toDateString();

            $bookingCount = VenueBooking::whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)
                ->where('bookinguserid', Session::get('venueuserid'))
                ->count();

            $monthStartDate = Carbon::now()->subMonths(4)->startOfMonth();
            $monthEndDate = Carbon::now()->endOfMonth();

            $monthBookingCount = VenueBooking::whereDate('start_date', '<=', $monthStartDate)
                ->whereDate('end_date', '>=', $monthEndDate)
                ->where('bookinguserid', Session::get('venueuserid'))
                ->count();

            $allMonths = [];
            for ($i = 4; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i)->format('Y-m');
                $allMonths[$month] = $bookings[$month] ?? 0;
            }

            $formattedBookings = [];
            foreach ($allMonths as $month => $count) {
                $monthName = Carbon::createFromFormat('Y-m', $month)->format('M'); 
                $formattedBookings[] = ['month' => $monthName, 'booking_count' => $count];
            }

            $allFormattedMonths = array_column($formattedBookings, 'month');
            $bookingCounts = array_column($formattedBookings, 'booking_count');

            return response()->json([
                'status' => 'success',
                'allFormattedMonths' => $allFormattedMonths,
                'formattedBookings' => $formattedBookings,
                'bookingCounts' => $bookingCounts,
                'todayCounts' => $bookingCount,
                'monthBookingCount' => $monthBookingCount
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getNotifications(){
        $user = VenueUser::where('id', \Session::get('venueuserid'))->first();
        return response()->json($user->unreadNotifications);
    }

    public function markAsRead(){
        $user = VenueUser::where('id', \Session::get('venueuserid'))->first();
        $user->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function allNotifications(){
        $user = VenueUser::where('id', \Session::get('venueuserid'))->first();
        $pagetitle = "Booking Enquiries";
        $pageroot = "Venue"; 
        return view('venueadmin::booking.all_notifications', compact('user', 'pagetitle', 'pageroot'));
    }

    public function allEnquiries(){
        $userId = \Session::get('venueuserid');
        $pagetitle = "Booking Enquiries";
        $pageroot = "Venue"; 
        $getAllEnquiries = BookingEnquiry::where('venue_user_id', $userId)->get();
        return view ('venueadmin::booking.enquiries', compact('getAllEnquiries', 'pagetitle', 'pageroot'));
    }

    public function updateEnquiryStatus($id){
        try{
            $updateEnquiryStatus = BookingEnquiry::where('id', $id)->first();
            $updateEnquiryStatus->status = 'ENQUIRED';
            $updateEnquiryStatus->save();
            return redirect()->back()->with('success', 'Booking Enquiry status successfully updated');
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function register()
    {
      
         return view('venueadmin::auth.register');
    }    
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venueadmin::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request)
    {
        $venueuserid =  Session::get('venueuserid'); 
        $pagetitle = "Venue List";
        $pageroot = "Home"; 

       /* $venues = UserVenue::where('venueuserid',venueuserid)->get();*/

        /* SELECT * FROM `venuedetails` WHERE id = (select venueid from `uservenue` where venueuserid = 1); */


        $venues = VenueDetails::whereIn('id', function($query) {
                                     $query->select('venueid')
                                        ->from('uservenue')
                                        ->where('venueuserid','=',Session::get('venueuserid'));
                                     })->get();


         
        return view('venueadmin::venueuser.list',compact('pagetitle','pageroot','venues'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('venueadmin::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/venue/login'); 
    }

    public function storeRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_mobile' => 'required|regex:/^[0-9]{10}$/|unique:venueuser,mobileno'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
     
        $venueuserid =  Session::get('venueuserid');
        $admincheck = VenueUser::where('id',$venueuserid)->first();
        
        /* Send Confirmation Notification to Admin */      
      /*  $admin = Auth::guard('admin')->user(); */

        $admins = AdminUser::where('delete_status', '0')
                   ->whereIn('role', ['Super Admin', 'Admin'])
                   ->get(); // Fetch all admin users

         
          if (!$admins) {
                    return redirect()->back()->with('error', 'Admin not found or not authenticated.');
                }

        foreach ($admins as $admin) {
            $admin->notify(new ChangeMobileNo($request->new_mobile, 'User requested to change their mobile number.'));
        }

     
       
       
       // $admin->notify(new ChangeMobileNo($request->new_mobile, 'User requested to change their mobile number.'));

        return redirect()->back()->with('success', 'Your request has been sent to the admin for approval.');
    }   

}
