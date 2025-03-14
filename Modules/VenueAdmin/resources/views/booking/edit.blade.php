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
                <input type="hidden" name="venue_id" id="venue_id" value="{{ $venuebooking->venue_id }}" />
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
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label class="form-label">Enter Start Date</label>
                    <input id="event-start-date" type="date" class="form-control" name="eventstartdate" required value="{{ $venuebooking->start_date }}"/>
                </div>

                <div class="col-md-6 mt-2">
                    <label class="form-label">Enter End Date</label>
                    <input id="event-end-date" type="date" class="form-control" name="eventenddate" required value="{{ $venuebooking->end_date }}" />
                </div>
            </div>
            <div id="day-type-containers" class="row">
                @if (!empty($venuebooking->start_date) && !empty($venuebooking->end_date))
                    @php
                        $startDate = \Carbon\Carbon::parse($venuebooking->start_date);
                        $endDate = \Carbon\Carbon::parse($venuebooking->end_date);
                        $diffInDays = $startDate->diffInDays($endDate) + 1;
                    @endphp

                    @for ($i = 0; $i < $diffInDays; $i++)
                        @php
                            $currentDate = $startDate->copy()->addDays($i)->format('Y-m-d');
                        @endphp
                        <div class="col-md-6 mb-2 mt-3">
                            <label class="form-label">Day {{ $i + 1 }} ({{ $currentDate }})</label>
                            <div class="d-flex">
                                <div class="n-chk">
                                    <div class="form-check form-check-primary form-check-inline">
                                        <input class="form-check-input daytype" type="radio" name="daytype-{{ $currentDate }}" value="full" 
                                        {{ $venueDetails[$i] && $venueDetails[$i]->daytype === 'full' ? 'checked' : '' }} required />
                                        <label class="form-check-label mt-1">Full</label>
                                    </div>
                                </div>
                                <div class="n-chk">
                                    <div class="form-check form-check-warning form-check-inline">
                                        <input class="form-check-input daytype" type="radio" name="daytype-{{ $currentDate }}" value="morning" 
                                        {{ $venueDetails[$i] && $venueDetails[$i]->daytype === 'morning' ? 'checked' : '' }} />
                                        <label class="form-check-label mt-1">Morning</label>
                                    </div>
                                </div>
                                <div class="n-chk">
                                    <div class="form-check form-check-warning form-check-inline">
                                        <input class="form-check-input daytype" type="radio" name="daytype-{{ $currentDate }}" value="evening" 
                                        {{ $venueDetails[$i] && $venueDetails[$i]->daytype === 'evening' ? 'checked' : '' }} />
                                        <label class="form-check-label mt-1">Evening</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
            <div class="justify-content-center d-flex mb-2 mt-3">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Venue Booking </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('event-start-date').addEventListener('change', generateDayTypeInputs);
    document.getElementById('event-end-date').addEventListener('change', generateDayTypeInputs);

    function generateDayTypeInputs() {
        const startDate = document.getElementById('event-start-date').value;
        const endDate = document.getElementById('event-end-date').value;
        const dayTypeContainers = document.getElementById('day-type-containers');

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const diffInDays = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;

            dayTypeContainers.innerHTML = ''; // Clear previous

            for (let i = 0; i < diffInDays; i++) {
                const currentDate = new Date(start);
                currentDate.setDate(start.getDate() + i);
                const formattedDate = currentDate.toISOString().split('T')[0]; // YYYY-MM-DD

                dayTypeContainers.innerHTML += `
                    <div class="col-md-6 mb-2 mt-3">
                        <label class="form-label">Day ${i + 1} (${formattedDate})</label>
                        <div class="d-flex">
                            <div class="n-chk">
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="full" required />
                                    <label class="form-check-label mt-1">Full</label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-warning form-check-inline">
                                    <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="morning" />
                                    <label class="form-check-label mt-1">Morning</label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-warning form-check-inline">
                                    <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="evening" />
                                    <label class="form-check-label mt-1">Evening</label>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        } else {
            dayTypeContainers.innerHTML = '';
        }
    }
</script>
@endpush