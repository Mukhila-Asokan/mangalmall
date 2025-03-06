<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\VenueAdmin\Models\VenueBooking;
use Modules\VenueAdmin\Models\VenueBookingContact;
use Modules\VenueAdmin\Models\VenueBookingDetails;
use Illuminate\Support\Facades\Log;
use App\Models\OccasionType;
use Session;
use Carbon\Carbon;
use Modules\VenueAdmin\Models\MuhurthamDates;

class VenueBookingController extends Controller
{
    
    public function index()
    {
        $pagetitle = "Venue Booking";
        $pageroot = "Home"; 
        $venueid = 4;
      
        $occasion_types = OccasionType::where('delete_status','0')->get();
        return view('venueadmin::booking.index',compact('pagetitle','pageroot','occasion_types','venueid'));
    }

    public function getMuhurthamDates(){
        $muhurtamDates = MuhurthamDates::get();
        return response()->json($muhurtamDates);
    }


    public function getEventlist($id)
    {
        $pagetitle = "Venue Booking";
        $pageroot = "Home"; 
        $venueid = $id;
        $formattedEvents = [];
        $events = VenueBooking::where('venue_id',$venueid)->get(); // Fetch all bookings

       
        foreach ($events as $event) {
            $color = '#40161C'; // Default color for full-day bookings

            /*if ($event->daytype == 'morning') {
                $color = '#40161C'; // Yellow for morning
            } elseif ($event->daytype == 'evening') {
                $color = '#D39D55'; // Red for evening
            }*/

            $formattedEvents[] = [
                'id' => $event->id, 
                'title' => $event->event_title,
                'start' => Carbon::parse($event->start_date)->format('Y-m-d'),
                'end' => date('Y-m-d', strtotime($event->end_date . ' +1 day')),      /*Carbon::parse($event->end_date)->format('Y-m-d'),*/
                'color' => $color, 
            ];
        }

      
        return response()->json($formattedEvents, 200);

         
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {

        $pagetitle = "Venue Booking";
        $pageroot = "Home"; 
        $venueid = $id;
        $occasion_types = OccasionType::where('delete_status','0')->get();
        return view('venueadmin::booking.create',compact('pagetitle','pageroot','occasion_types','venueid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addnewevents(Request $request)
    {
        $startdate = $request->startdate;
        $starttime = $request->starttime;
        $enddate = $request->enddate;
        $endtime = $request->endtime;

        $start_datetime = date('Y-m-d H:i:s', strtotime("$startdate $starttime"));
        $end_datetime = date('Y-m-d H:i:s', strtotime("$enddate $endtime"));

        $venuebooking = new VenueBooking;
		$venuebooking->venue_id = $request->venue_id;
		$venuebooking->booked_by = 'VenueUser';
		$venuebooking->bookinguserid = $request->bookinguserid;
		$venuebooking->event_id = $request->event_id;
        $venuebooking->event_title = $request->title;
		$venuebooking->event_name = $request->title;
		$venuebooking->start_datetime = $start_datetime;
		$venuebooking->end_datetime = $end_datetime;
		$venuebooking->total_guests = '0';
		$venuebooking->booking_status = $request->bookingstatus;
		$venuebooking->total_price = '1000';
		$venuebooking->payment_status = 'Unpaid';		
		$venuebooking->special_requirements = $request->special_requirements;
		$venuebooking->status = "Active";
		$venuebooking->delete_status = "0";
		$venuebooking->save();

        $bookingcontact = new VenueBookingContact;
        $bookingcontact->venue_id = $request->venue_id;
        $bookingcontact->venuebooking_id = $venuebooking->id;
        $bookingcontact->person_name = $request->person_name;
        $bookingcontact->mobileno = $request->mobileno;
        $bookingcontact->contact_address = $request->contact_address;
        $bookingcontact->status = "Active";
        $bookingcontact->delete_status = "0";
        $bookingcontact->save();


        return response()->json($venuebooking, 200);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('venueadmin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $venuebooking = VenueBooking::where('id',$id)->first();
        $booking = VenueBookingContact::where('venuebooking_id',$id)->first();

        $bookingdetails['venuebooking'] = $venuebooking;        
        $bookingdetails['booking'] =  $booking;

        return response()->json($bookingdetails, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatenewevents(Request $request)
    {
        $startdate = $request->startdate;
        $starttime = $request->starttime;
        $enddate = $request->enddate;
        $endtime = $request->endtime;

        $start_datetime = date('Y-m-d H:i:s', strtotime("$startdate $starttime"));
        $end_datetime = date('Y-m-d H:i:s', strtotime("$enddate $endtime"));
        $id = $request->booking_id;
        $venuebooking = VenueBooking::find($id);
        $venuebooking->venue_id = $request->venue_id;
        $venuebooking->booked_by = 'VenueUser';
        $venuebooking->bookinguserid = $request->bookinguserid;
        $venuebooking->event_id = $request->event_id;
        $venuebooking->event_title = $request->title;
        $venuebooking->event_name = $request->title;
        $venuebooking->start_datetime = $start_datetime;
        $venuebooking->end_datetime = $end_datetime;
        $venuebooking->total_guests = '0';
        $venuebooking->booking_status = $request->bookingstatus;
        $venuebooking->total_price = '1000';
        $venuebooking->payment_status = 'Unpaid';       
        $venuebooking->special_requirements = $request->special_requirements;
        $venuebooking->status = "Active";
        $venuebooking->delete_status = "0";
        $venuebooking->save();

        
        $bookingcontact = array(
            'venue_id' => $request->venue_id,
            'person_name' => $request->person_name,
            'mobileno' => $request->mobileno,
            'contact_address' => $request->contact_address,
            'status' => "Active",
            'delete_status' => "0");

       $updatebook = VenueBookingContact::where('venuebooking_id',$id)->update($bookingcontact);


        return response()->json($venuebooking, 200);
    }

   
    public function getevents(Request $request)
    {
        $events = VenueBooking::whereBetween('start_datetime', [$request->start, $request->end])->where('venue_id',$request->venueid)->get();
		$i = 1;
		$astr = [];
		foreach($events as $ev)
		{
			$astr[$i]['id'] = $ev->id;
			$astr[$i]['title'] = $ev->event_title;
			$astr[$i]['start'] = $ev->start_date;
            $astr[$i]['end'] = $ev->end_date;
			$astr[$i]['extendedProps'] = "{ calendar: 'Primary' }";
			$i++;
		}
		
        return response()->json($astr);
    }


    public function savebooking(Request $request)
    {
         $start_date = $request->startdate;
    $end_date = $request->enddate;

   
    $noofdays = Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date)) + 1;

   
    $venuebooking = new VenueBooking();
    $venuebooking->venue_id = $request->venue_id;
    $venuebooking->booked_by = 'VenueUser';
    $venuebooking->bookinguserid = $request->bookinguserid; 
    $venuebooking->event_id = $request->event_id;
    $venuebooking->event_title = $request->title;
    $venuebooking->event_name = $request->title;
    $venuebooking->start_date = $start_date;
    $venuebooking->end_date = $end_date;
    $venuebooking->noofdays = $noofdays;
    $venuebooking->total_guests = '0';
    $venuebooking->booking_status = $request->bookingstatus;
    $venuebooking->total_price = '1000';
    $venuebooking->payment_status = 'Unpaid';
    $venuebooking->special_requirements = $request->special_requirements;
    $venuebooking->status = "Active";
    $venuebooking->delete_status = "0";    
    

    $venuebooking->save();
 
    
    $bookingcontact = new VenueBookingContact();
    $bookingcontact->venue_id = $request->venue_id;
    $bookingcontact->venuebooking_id = $venuebooking->id;
    $bookingcontact->person_name = $request->person_name;
    $bookingcontact->mobileno = $request->mobileno;
    $bookingcontact->contact_address = $request->contact_address;
    $bookingcontact->status = "Active";
    $bookingcontact->delete_status = "0";
    $bookingcontact->save();

    
    \Log::info('Daytypes received:', $request->input('daytypes', []));
    foreach ($request->input('daytypes', []) as $date => $dayType) {
        $actualDate = str_replace("daytype-", "", $date);
          \Log::info('Processing date: ' . $date . ', dayType: ' . $dayType);
        $bookingdetails = new VenueBookingDetails();
        $bookingdetails->venue_id = $request->venue_id;
        $bookingdetails->venuebooking_id = $venuebooking->id;
        $bookingdetails->date = $actualDate;
        $bookingdetails->daytype = $dayType;

       
        switch ($dayType) {
            case 'full':
                $bookingdetails->starttime = '05:00:00';
                $bookingdetails->endtime = '23:00:00';
                break;
            case 'morning':
                $bookingdetails->starttime = '05:00:00';
                $bookingdetails->endtime = '14:00:00';
                break;
            case 'evening':
                $bookingdetails->starttime = '14:00:00';
                $bookingdetails->endtime = '23:00:00';
                break;
        }

        $bookingdetails->save();
    }

    return response()->json([
        'success' => true,
        'message' => 'Booking saved successfully!',
        'data' => $venuebooking
    ], 200);

    }


public function updatebooking(Request $request, $id)
{
    $venuebooking = VenueBooking::find($id);
    if (!$venuebooking) {
        return response()->json(['success' => false, 'message' => 'Booking not found'], 404);
    }

    $start_date = $request->startdate;
    $end_date = $request->enddate;

   
    $noofdays = Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date)) + 1;

    $venuebooking->event_title = $request->title; // Update other fields as needed
    $venuebooking->event_name = $request->title;   


    $venuebooking->venue_id = $request->venue_id;
    $venuebooking->booked_by = 'VenueUser';
    $venuebooking->bookinguserid = $request->bookinguserid; 
    $venuebooking->event_id = $request->event_id;
    $venuebooking->event_title = $request->title;
    $venuebooking->event_name = $request->title;
    $venuebooking->start_date = $start_date;
    $venuebooking->end_date = $end_date;
    $venuebooking->noofdays = $noofdays;
    $venuebooking->total_guests = '0';
    $venuebooking->booking_status = $request->bookingstatus;
    $venuebooking->total_price = '1000';
    $venuebooking->payment_status = 'Unpaid';
    $venuebooking->special_requirements = $request->special_requirements;
    $venuebooking->status = "Active";
    $venuebooking->delete_status = "0";  
    $venuebooking->save();

    VenueBookingContact::where('venuebooking_id', $id)->update([
        'person_name' => $request->person_name,
        'mobileno' => $request->mobileno,
        'contact_address' => $request->contact_address,
    ]);

    // Update VenueBookingDetails (daytypes)
    VenueBookingDetails::where('venuebooking_id', $id)->delete(); // Clear existing details

    foreach ($request->input('daytypes', []) as $date => $dayType) {
        $actualDate = str_replace("daytype-", "", $date);
        $bookingdetails = new VenueBookingDetails();
        $bookingdetails->venue_id = $request->venue_id;
        $bookingdetails->venuebooking_id = $venuebooking->id;
        $bookingdetails->date = $actualDate;
        $bookingdetails->daytype = $dayType;
        // ... (rest of your logic for start/end times)
        $bookingdetails->save();
    }

    return response()->json([
        'success' => true,
        'message' => 'Booking updated successfully!',
        'data' => $venuebooking // Return the updated VenueBooking data
    ], 200);
}


 

function getDatesBetween($startDate, $endDate) {
    $start = DateTime::createFromFormat('Y-m-d', $startDate);
    $end = DateTime::createFromFormat('Y-m-d', $endDate);

    if (!$start || !$end) {
        return []; // Return an empty array for invalid dates
    }

    if ($start > $end) {
        return []; // Return an empty array if start date is after end date
    }

    $dates = [];

    if ($start == $end) { // Check if start and end dates are the same
        $dates[] = $start->format('Y-m-d');
        return $dates;
    }

    while ($start <= $end) {
        $dates[] = $start->format('Y-m-d');
        $start->modify('+1 day'); // More efficient than setDate
    }

    return $dates;
}

public function deletebooking($id)
{
    $venuebooking = VenueBooking::find($id);
    if (!$venuebooking) {
        return response()->json(['success' => false, 'message' => 'Booking not found'], 404);
    }
     
     VenueBooking::where('id', '=', $id)->update(['delete_status' => 1]);       
  

    return response()->json([
        'success' => true,
        'message' => 'Booking deleted successfully!'
    ], 200);
}

public function getEventsbyid($id)
{
    $venueid = $id;
    $formattedEvents = [];

        $venuebooking = VenueBooking::where('id',$id)->first();
        $booking = VenueBookingContact::where('venuebooking_id',$id)->first();
        $venuebookingdetails = VenueBookingDetails::where('venuebooking_id',$id)->get();

        
        $daytypes = [];
        foreach ($venuebookingdetails as $detail) {
            $daytypes[] = [
                'date' => Carbon::parse($detail->date)->format('Y-m-d'),
                'daytype' => $detail->daytype,
                'starttime' => $detail->starttime,
                'endtime' => $detail->endtime,
            ];
        }

        // Format event details
        $formattedEvents[] = [
            'id' => $venuebooking->id,
            'title' => $venuebooking->event_title,
            'event_type' => $venuebooking->event_id,
            'contact_person' => $booking->person_name,
            'contact_address' => $booking->contact_address,
            'mobileno' => $booking->mobileno,
            'booking_status' => $venuebooking->booking_status,
            'special_requirements' => $venuebooking->special_requirements,
            'start' => Carbon::parse($venuebooking->start_date)->format('Y-m-d'),
            'end' => date('Y-m-d', strtotime($venuebooking->end_date . ' +1 day')),          
            'daytypes' => $daytypes,
        ];
  

    return response()->json($formattedEvents, 200);
}






}
