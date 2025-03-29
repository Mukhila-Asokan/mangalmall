<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingEnquiry;
use Modules\VenueAdmin\Models\VenueBooking;
use Session;
use DB;

class StaffController extends Controller
{
    public function index()
    {
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
         return view('admin.dashboard', compact('pagetitle','pageroot', 'bookings', 'topBookedVenues'));
    }
}
