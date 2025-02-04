<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\VenueAdmin\Models\VenueBooking;
use Modules\VenueAdmin\Models\VenueBookingContact;
use App\Models\OccasionType;
use Session;

class VenueBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('venueadmin::index');
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
		$venuebooking->bookinguserid = Session::get('venueuserid');
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
        $venuebooking->bookinguserid = Session::get('venueuserid');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
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
			$astr[$i]['start'] = $ev->start_datetime;
            $astr[$i]['end'] = $ev->end_datetime;
			$astr[$i]['extendedProps'] = "{ calendar: 'Primary' }";
			$i++;
		}
		
        return response()->json($astr);
    }
}
