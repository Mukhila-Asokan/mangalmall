<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
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
use Modules\VenueAdmin\Models\VenueBookingDetails;
use Carbon\Carbon;

use Session;

class VenueController extends Controller
{
    public function search(Request $request)
    {
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::where('delete_status',0)->get();

        return view('venuesearch',compact('venuetypes','venueamenities','venuedatafield','arealocation'));
    }

    public function searchtest(Request $request)
    {
         $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::where('delete_status',0)->get();

        return view('venuetest1',compact('venuetypes','venueamenities','venuedatafield','arealocation'));
    }

    public function index()
    {
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::where('delete_status',0)->get();

        return view('venuesearch',compact('venuetypes','venueamenities','venuedatafield','arealocation'));
    }

    public function getBookingsOnMonth($id, $month, $year) {
        $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth();
    
        $bookings = VenueBookingDetails::where('venue_id', $id)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get();
    
        $result = [];
        $bookedDates = [];
    
        for ($date = clone $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $formattedDate = $date->toDateString();
            $dayBookings = $bookings->where('date', $formattedDate)->pluck('daytype')->toArray();
    
            if(in_array('full', $dayBookings)){
                $dayType = 'full';
            }
            else if (in_array('morning', $dayBookings) && in_array('evening', $dayBookings)) {
                $dayType = 'full';
            } elseif (in_array('morning', $dayBookings)) {
                $dayType = 'morning';
            } elseif (in_array('evening', $dayBookings)) {
                $dayType = 'evening';
            } else {
                $dayType = 'available';
            }
    
            if ($dayType !== 'available') {
                $bookedDates[] = $formattedDate;
                $result[$formattedDate] = [
                    'type' => $dayType,
                    'details' => 'Booked - ' . ucfirst($dayType) . ' Slot'
                ];
            }
        }
    
        return response()->json([
            'bookings' => $result,
            'booked_dates' => $bookedDates
        ]);
    }    
}
