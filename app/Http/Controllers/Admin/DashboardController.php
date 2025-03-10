<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; 
use App\Models\BookingEnquiry;
use Session;
use Carbon\Carbon;
use App\Notifications\ChangeMobileNo;
use DataTables;
use Svg\Tag\Rect;
use Exception;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Log;
use Modules\VenueAdmin\Models\VenueBooking;
use DB; 
use App\NotificationFilterTrait;

class DashboardController extends Controller
{
    use AuthorizesRequests; 
    use NotificationFilterTrait;

    public function dashboard()
    {
        try{
            $pagetitle = "Dashboard";
            $pageroot = "Home"; 
            $bookings =  BookingEnquiry::whereNull('venue_user_id')->where('status', 'open')->orderBy('id', 'desc')->limit(2)->get();
            $topBookedVenues = VenueBooking::join('venuedetails', 'venuebooking.venue_id', '=', 'venuedetails.id')
                        ->select('venuedetails.venuename', 'venuedetails.description', DB::raw('COUNT(venuebooking.id) as total_bookings'))
                        // ->where('venuebooking.bookinguserid')
                        ->groupBy('venuedetails.id', 'venuedetails.venuename', 'venuedetails.description')
                        ->orderByDesc('total_bookings')
                        ->limit(7)
                        ->get();
        }
        catch(\Exception $e){
            dd($e);
        }
        return view('admin.dashboard',compact('pagetitle','pageroot', 'bookings', 'topBookedVenues'));
    }

    public function dashboardChart(){
        try{
            $startDate = Carbon::now()->subMonths(4)->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();

            $bookings = VenueBooking::selectRaw("DATE_FORMAT(start_date, '%Y-%m') as month, COUNT(*) as booking_count")
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
                ->count();

            $monthStartDate = Carbon::now()->startOfMonth();
            $monthEndDate = Carbon::now()->endOfMonth();

            $monthBookingCount = VenueBooking::whereDate('start_date', '<=', $monthEndDate)
                ->whereDate('end_date', '>=', $monthStartDate)
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

    public function allEnquiries(){
        $pagetitle = "Booking Enquiries";
        $pageroot = "Venue"; 
        $getAllEnquiries = BookingEnquiry::whereNull('venue_user_id')->get();
        return view ('admin.enquiries', compact('getAllEnquiries', 'pagetitle', 'pageroot'));
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

    public function index()
    {  
         $username = Session::get('username');
         $userid = Session::get('userid');
         $user = auth()->guard('admin')->user();
         $notifications = $user->unreadNotifications;
 
         $filteredNotifications = $this->filterNotificationsByDate($notifications); 
       
        $todayNotifications = $filteredNotifications['today'];
        $yesterdayNotifications  = $filteredNotifications['yesterday'];
        $olderNotifications  = $filteredNotifications['older'];
     
         $pagetitle = "Dashboard";
         $pageroot = "Home";
         return view('admin.dashboard', compact('pagetitle','pageroot','username','todayNotifications','yesterdayNotifications','olderNotifications'));
    }
    public function changepassword()
    {
         $username = Session::get('username');
         $userid = Session::get('userid');
         $pagetitle = "Change Password";
         return view('admin.password', compact('pagetitle','username'));
    }

    public function passwordupdate(Request $request)
    {
        $pagetitle = "Change Password";

        $validator =  Validator::make($request->all(), [
        'oldpassword' => 'required',
        'newpassword' => 'required|min:8',
        'confirmpassword' => 'required|min:8']);

         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

         $username = Session::get('username');
         $userid = Session::get('userid');

        

         $user = AdminUser::find($userid);

       

         if (!Hash::check($request->oldpassword, $user->password)) {
            return back()->withErrors(['oldpassword' => __('The provided current password is incorrect.')]);
        }

        $user->forceFill([
            'password' => Hash::make($request->newpassword),
        ])->save();

         
        Auth::logout();

        return redirect()->route('admin.login')->with('success', __('Your password has been updated successfully.'));
       
    }
   public function notifications()
    {
        $user = auth()->guard('admin')->user();
        $notifications = $user->unreadNotifications;

        $filteredNotifications = $this->filterNotificationsByDate($notifications);

        $html = view('admin.layouts.notification-list', [
        'todayNotifications' => $filteredNotifications['today'],
        'yesterdayNotifications' => $filteredNotifications['yesterday'],
        'olderNotifications' => $filteredNotifications['older'],
    ])->render();

    return response()->json([
        'count' => $user->unreadNotifications->count(),
        'html' => $html
    ]);
}
public function getNotifications()
    {
        $user = auth()->guard('admin')->user();
        $notifications = $user->unreadNotifications;

        $filteredNotifications = $this->filterNotificationsByDate($notifications);

        return view('admin.notifications', [
            'todayNotifications' => $filteredNotifications['today'],
            'yesterdayNotifications' => $filteredNotifications['yesterday'],
            'olderNotifications' => $filteredNotifications['older'],
        ]);
    }

}
