@extends('venueadmin::layouts.admin-layout')
<style>
    .venue-radio {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        cursor: pointer;
        accent-color: #58111A; /* Bootstrap Primary Blue */
    }
    .custom-radio {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 24px;
        height: 24px;
        border: 2px solid #ccc;
        border-radius: 50%;
        background: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease-in-out;
    }

    /* Tick mark (hidden by default) */
    .custom-radio::after {
        content: "✔";
        font-size: 16px;
        color: white;
        display: none;
    }

    /* When radio is checked, change color and show tick */
    .venue-radio:checked + .custom-radio {
        background-color: #58111A;
        border-color: #58111A;
    }

    .venue-radio:checked + .custom-radio::after {
        display: block;
    }

    /* Change card border and background when selected */
    .venue-radio:checked ~ .venue-card {
        border: 2px solid #58111A;
        background-color: #eaf4ff;
        transition: 0.3s;
    }

    .disabled-card{
        background-color: #E5E4E2;
        opacity: .4;
    }
</style>
@section('content')
    <div class="wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Venue Booking</h4>
                                <div id="rootwizard">
                                <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                    <li class="nav-item" data-target-form="#bookingForm">
                                        <a href="#first" class="nav-link rounded-0 py-1 disabled-tab">
                                            <i class="bi bi-calendar-check font-14"></i>
                                            <span class="d-none d-sm-inline mleft-5">Booking Date</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-target-form="#venueForm">
                                        <a href="#second" class="nav-link rounded-0 py-1 disabled-tab">
                                            <i class="bi bi-buildings-fill font-14"></i>
                                            <span class="d-none d-sm-inline mleft-5">Venue</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-target-form="#contactForm">
                                        <a href="#third" class="nav-link rounded-0 py-1 disabled-tab">
                                            <i class="bi bi-person-rolodex font-14"></i>
                                            <span class="d-none d-sm-inline mleft-5">Contact Details</span>
                                        </a>
                                    </li>
                                </ul>

                                    <div class="tab-content mb-0 b-0">
                                        <div class="tab-pane" id="first">
                                            <form id="bookingForm" method="post" action="#" class="form-horizontal">
                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-label">Enter Start Date</label>
                                                        <input id="event-start-date" type="date" class="form-control" name="eventstartdate" required value="{{$date}}"/>
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-label">Enter End Date</label>
                                                        <input id="event-end-date" type="date" class="form-control" name="eventenddate" required />
                                                    </div>

                                                    <div id="day-type-containers" class="row mt-3 ml-1">
                                                    </div>
                                                </div>
                                            </form>
                                            <ul class="list-inline wizard mb-0 mt-3">
                                                <li class="next list-inline-item float-end">
                                                    <a href="javascript:void(0);" class="btn btn-info" id="booking_next">Next <i class="ri-arrow-right-line ms-1"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-pane fade" id="second">
                                            <form id="venueForm" method="post" action="#" class="form-horizontal">
                                                <div class="row venueContainer">
                                                </div>
                                            </form>
                                            <ul class="pager wizard mb-0 list-inline mt-3">
                                                <li class="previous list-inline-item">
                                                    <button type="button" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i> Back</button>
                                                </li>
                                                <li class="next list-inline-item float-end">
                                                    <button type="button" class="btn btn-info" id="venue_next">Next <i class="ri-arrow-right-line ms-1"></i></button>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-pane fade" id="third">
                                            <form id="contactForm" method="post" action="#" class="form-horizontal">
                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-label">Event Name</label>
                                                        <input id="event_name" type="text" name="event_name" class="form-control" value="" required />
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-label">Event Type</label>
                                                        <select name="event_id" id="event_id" class="form-select" required>
                                                            <option value="">Select Events</option>
                                                            @foreach($occasion_types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->eventtypename }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <input type="hidden" name="bookinguserid" id="bookinguserid" value="{{ Session::get('venueuserid') }}" />
                                                    <input type="hidden" name="booking_id" id="booking_id" value="0" />
                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-label">Contact Person Name</label>
                                                        <input id="person_name" name="person_name" type="text" class="form-control" required />
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-label">Phone No</label>
                                                        <input id="mobileno" type="text" name="mobileno" class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-label">Special Requirements</label>
                                                        <textarea id="special_requirements" class="form-control" name="special_requirements"></textarea>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-label">Address</label>
                                                        <textarea id="contact_address" name="contact_address" class="form-control" required></textarea>
                                                    </div>
                                                </div>
                                            </form>
                                            <ul class="pager wizard mb-0 list-inline mt-3">
                                                <li class="previous list-inline-item">
                                                    <button type="button" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i> Back</button>
                                                </li>
                                                <li class="next list-inline-item float-end">
                                                    <button type="button" id="confirm_booking" class="btn btn-info">Confirm Booking</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const baseUrl = "{{ url('/') }}";
        document.addEventListener("DOMContentLoaded", function () {
            const startDateInput = document.getElementById("event-start-date");
            const endDateInput = document.getElementById("event-end-date");
            const dayTypeContainers = document.getElementById("day-type-containers");

            startDateInput.addEventListener("change", generateDayTypeInputs);
            endDateInput.addEventListener("change", generateDayTypeInputs);

            function generateDayTypeInputs() {
                const startDate = startDateInput.value;
                const endDate = endDateInput.value;

                if (startDate && endDate) {
                    const start = new Date(startDate);
                    const end = new Date(endDate);
                    const diffInDays = (end - start) / (1000 * 60 * 60 * 24) + 1; // +1 to include both start and end dates

                    dayTypeContainers.innerHTML = ''; // Clear previous inputs

                    for (let i = 0; i < diffInDays; i++) {
                        const currentDate = new Date(start);
                        currentDate.setDate(currentDate.getDate() + i);
                        const formattedDate = currentDate.toISOString().split('T')[0]; // YYYY-MM-DD

                        const dayTypeContainer = document.createElement('div');
                        dayTypeContainer.classList.add('col-md-6', 'mt-2');
                        dayTypeContainer.innerHTML = `
                            <label class="form-label">Day ${i + 1} (${formattedDate})</label>
                            <div class="d-flex">
                                <div class="n-chk">
                                    <div class="form-check form-check-primary form-check-inline">
                                        <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="full" required />
                                        <label class="form-check-label mt-1">Full Day</label>
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
                        `;
                        dayTypeContainers.appendChild(dayTypeContainer);
                    }
                } else {
                    dayTypeContainers.innerHTML = ''; // Clear if dates are not selected
                }
            }
        });

        $('#booking_next').on('click', function(){
            if($('#bookingForm')[0].checkValidity()){
                $.ajax({
                    url: "{{ route('venue.check.available') }}",
                    type: "GET",
                    data: $('#bookingForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(response){
                        $('.venueContainer').empty();
                        if (response.venueDetails.length > 0) {
                            let venueHtml = '';
                            venueHtml += `<div class="row">`;
                            response.venueDetails.forEach(venue => {
                                if(response.uniqueVenueIds.includes(venue.id)){
                                    venueHtml += `
                                        <div class="col-4">
                                            <div class="card position-relative disabled-card">
                                                <input type="radio" name="venue" disabled id="venue-${venue.id}" value="${venue.id}" class="venue-radio" required>
                                                <label for="venue-${venue.id}" class="custom-radio"></label>

                                                <div class="card-header d-flex">
                                                    <i class="bi bi-building-check h4"></i>
                                                    <h4 class="mleft-10"> ${venue.venuename} </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row mb-2">
                                                        <div class="col-5 font-14">
                                                            <i class="bi bi-telephone"></i>
                                                            ${venue.contactmobile}
                                                        </div>
                                                        <div class="col-7 font-14">
                                                            <i class="bi bi-person-circle"></i>
                                                            ${venue.contactperson}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-12 font-14">
                                                            <i class="bi bi-menu-down"></i>
                                                            ${venue.description.length > 40 ? venue.description.substring(0, 40) + '...' : venue.description}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-12 font-14">
                                                            <i class="bi bi-geo-alt"></i>
                                                            ${venue.venueaddress.length > 40 ? venue.venueaddress.substring(0, 40) + '...' : venue.venueaddress}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer d-flex justify-content-end">
                                                    <a href="${baseUrl}/venueadmin/viewvenue/${venue.id}" target="_blank" class="btn btn-primary book_date_confirm" id="view_venue">View Details</a
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                    venueHtml += `</div>`;
                                }
                                else{
                                    venueHtml += `
                                        <div class="col-4">
                                            <div class="card position-relative">
                                                <input type="radio" name="venue" id="venue-${venue.id}" value="${venue.id}" class="venue-radio" required>
                                                <label for="venue-${venue.id}" class="custom-radio"></label>

                                                <div class="card-header d-flex">
                                                    <i class="bi bi-building-check h4"></i>
                                                    <h4 class="mleft-10 font-color"> ${venue.venuename} </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row mb-2">
                                                        <div class="col-5 font-14">
                                                            <i class="bi bi-telephone"></i>
                                                            ${venue.contactmobile}
                                                        </div>
                                                        <div class="col-7 font-14">
                                                            <i class="bi bi-person-circle"></i>
                                                            ${venue.contactperson}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-12 font-14">
                                                            <i class="bi bi-menu-down"></i>
                                                            ${venue.description.length > 40 ? venue.description.substring(0, 40) + '...' : venue.description}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-12 font-14">
                                                            <i class="bi bi-geo-alt"></i>
                                                            ${venue.venueaddress.length > 40 ? venue.venueaddress.substring(0, 40) + '...' : venue.venueaddress}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer d-flex justify-content-end">
                                                    <a href="${baseUrl}/venueadmin/viewvenue/${venue.id}" target="_blank" class="btn btn-primary book_date_confirm" id="view_venue">View Details</a
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                venueHtml += `</div>`;
                                }
                            });
                            venueHtml += `</div>`;
                            $('.venueContainer').append(venueHtml);
                            $('#venue_next').show();
                        }
                        else{
                            $('.venueContainer').append('<span class="font-16 text-center">No venues found</span>');
                            $('#venue_next').hide();
                        }
                    }, async: false
                })
            }
        })

        $('#confirm_booking').on('click', function(){
            var daytypes = {};
            $('input[type="radio"][class="form-check-input daytype"]:checked').each(function () {
                let dateKey = $(this).attr('name');
                daytypes[dateKey] = $(this).val();
            });
            console.log(daytypes);
            let daytypesInput = $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'daytypes')
                .val(JSON.stringify(daytypes));

            $('#bookingForm').append(daytypesInput);
            $.ajax({
                url: "{{ route('venue.booking.create') }}",
                type: "POST",
                data: $('#bookingForm, #venueForm, #contactForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(response){
                    console.log(response, 'response');
                    window.location.href = `{{ url('/venueadmin/venuebookinglist') }}`;
                }
            })
        })
        $(document).ready(function () {
            $('.disabled-tab').on('click', function (e) {
                e.preventDefault();
                return false;
            });

            $('#booking_next').on('click', function () {
                if ($('#bookingForm')[0].checkValidity()) {
                    $('#bookingForm')[0].reportValidity();
                    $('.nav-pills .nav-link[href="#second"]').removeClass('disabled-tab').tab('show');
                } else {
                    $('#bookingForm')[0].reportValidity();
                }
            });

            $('#venue_next').on('click', function () {
                if ($('#venueForm')[0].checkValidity()) {
                    $('#venueForm')[0].reportValidity();
                    $('.nav-pills .nav-link[href="#third"]').removeClass('disabled-tab').tab('show');
                } else {
                    $('#venueForm')[0].reportValidity();
                }
            });

            $('#confirm_booking').on('click', function () {
                if ($('#contactForm')[0].checkValidity()) {
                    $('#contactForm')[0].reportValidity();
                } else {
                    $('#contactForm')[0].reportValidity();
                }
            });

            $('.previous').on('click', function () {
                let activeTab = $('.nav-pills .nav-link.active').attr('href');
                if (activeTab === "#third") {
                    $('.nav-pills .nav-link[href="#second"]').tab('show');
                } else if (activeTab === "#second") {
                    $('.nav-pills .nav-link[href="#first"]').tab('show');
                }
            });
        });
    </script>
@endpush