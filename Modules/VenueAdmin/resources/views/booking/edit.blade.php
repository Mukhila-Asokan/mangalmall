@extends('venueadmin::layouts.admin-layout')
@section('content')
<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header text-bg-primary">
            <h4 class="mb-0 text-white">update the Venue Booking details</h4>
        </div>
        <form id="contactForm" method="post" action="{{ route('venue.venue.update') }}" class="form-horizontal p-3">
            @csrf
            <div class="row">
                <input type="hidden" value="{{ $venuebooking->id }}" name="id" id="id">
                <div class="col-md-6 mt-2">
                    <label class="form-label">Event Name</label>
                    <input id="event_name" type="text" name="event_name" class="form-control" value="{{ $venuebooking->event_name }}" required />
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Event Type</label>
                    <select name="event_id" id="event_id" class="form-select" disabled required>
                        <option value="">Select Events</option>
                        @foreach($occasion_types as $type)
                            @if($type->id == $venuebooking->event_id)
                                <option value="{{ $type->id }}" selected>{{ $type->eventtypename }}</option>
                            @else
                                <option value="{{ $type->id }}">{{ $type->eventtypename }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <input type="hidden" name="bookinguserid" id="bookinguserid" value="{{ Session::get('venueuserid') }}" />
                <input type="hidden" name="booking_id" id="booking_id" value="0" />
                <div class="col-md-6 mt-2">
                    <label class="form-label">Contact Person Name</label>
                    <input id="person_name" name="person_name" type="text" value="{{ $booking->person_name }}" class="form-control" required />
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Phone No</label>
                    <input id="mobileno" type="text" name="mobileno" class="form-control" value="{{ $booking->mobileno }}" required />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label class="form-label">Special Requirements</label>
                    <textarea id="special_requirements" class="form-control" name="special_requirements" value="{{ $venuebooking->special_requirements}}">{{ $venuebooking->special_requirements}}</textarea>
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Address</label>
                    <textarea id="contact_address" name="contact_address" class="form-control" required value="{{ $booking->contact_address }}">{{ $booking->contact_address }}</textarea>
                </div>
            </div>
            <div class="justify-content-center d-flex mb-2 mt-3">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Venue Booking </button>
            </div>
        </form>
    </div>
</div>
@endsection