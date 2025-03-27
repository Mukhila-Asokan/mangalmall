@extends('profile-layouts.profile')
@section('content')
<div class="col-lg-10 col-md-10">
    <div class="row mt-2">
        <div class="col-md-2" id="verticalScrollspy">
            <div id="event" class="list-group share_list_group">
                <a class="list-group-item list-group-item-action" href="#list-item-1">Event Details</a>
                <a class="list-group-item list-group-item-action" href="#list-item-2">Event Gallery</a>
                <a class="list-group-item list-group-item-action" href="#list-item-3">Event Budget</a>
                <a class="list-group-item list-group-item-action" href="#list-item-4">Event Check List</a>
                <a class="list-group-item list-group-item-action" href="#list-item-5">Event Itinerary</a>
            </div>
        </div>
        <div class="col-md-10 card">
            <div id="scrollspy-example" class="scrollspy-example p-3" style="height: 500px; overflow-y: auto;">
                <div id="list-item-1" class="mb-2 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="font-color">{{ $event->occasion_name }}</h4>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <a id="edit_event" data-target="#edit_occasion_popup" data-toggle="modal" class="font-14 btn btn-primary waves-effect waves-light">
                                <span><i class="bi bi-pencil-square"></i> Edit Event</span>
                            </a>
                            @if($collaborators->pluck('user_id')->contains(auth()->user()->id))
                                <a title="Collaborate Event" data-target="#collaborate_occasion" data-toggle="modal" class="font-14 btn btn-primary waves-effect waves-light ml-1">
                                    <i class="fa-solid fa-handshake-simple"></i>
                                </a>
                            @endif
                            <a title="Share Event" data-target="#share_occasion" data-toggle="modal" class="font-14 btn btn-primary waves-effect waves-light ml-1">
                                <i class="bi bi-share-fill"></i>
                            </a>
                        </div>
                    </div>
                    <p class="text-muted d-flex justify-content-start font-14">Event - {{ $event->Occasionname->eventtypename }}</p>
                    @if($collaborators->pluck('user_id')->contains(auth()->user()->id))
                        <?php $collaboratorNames = $collaborators->pluck('name')->toArray() ?>
                        <div class="row">
                            <div class="col-md-12">
                                <span>
                                    <i class="fa-solid fa-handshake-simple font-color"></i>
                                    <span class="ml-2 font-14">{{ implode(', ', $collaboratorNames) }}</span>
                                </span>
                            </div>
                        </div>
                    @else
                        <?php $collaborator = $collaborators->first() ?>
                        <div class="row">
                            <div class="col-md-12">
                                <i class="fa-solid fa-handshake-simple font-color"></i>
                                <span class="font-14 ml-2">
                                    Collaborated By -
                                    <span class="ml-2 font-14">{{ $collaborator->user->name }}</span>
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <span>
                                <i class="bi bi-geo-alt-fill font-color"></i>
                                <span class="ml-2 font-14">{{ $event->occasion_place }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <span>
                                <i class="bi bi-calendar-check-fill font-color"></i>
                                <span class="ml-2 font-14">{{ \Carbon\Carbon::parse($event->occasiondate)->format('M d, Y') }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="row mt-2 mb-4">
                        <div class="col-md-12 font-14">
                            {{ $event->notes }}
                        </div>
                    </div>
                </div>
                <hr>
                <div id="list-item-2" class="mb-2 mt-2">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="font-color">Gallery</h4>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a id="add_gallery" target="_blank" href="{{ route('home.gallery.add', ['event_id' => $event->id]) }}" class="font-14 btn btn-primary waves-effect waves-light">
                                        <span>+ Add / Update Gallery</span>
                                    </a>
                                </div>
                            </div>
                            <section class="image-grid mt-3">
                                <div class="container-xxl">
                                    <div class="row gy-4">
                                        @foreach($event->occasionGallery as $gallery)
                                            <div class="col-12 col-sm-6 col-md-3 mb-2">
                                                <a class="d-block">
                                                    <img src="{{ asset('storage/'.$gallery->gallery_image) }}" class="img-fluid image-preview-list">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="list-item-3" class="mb-2 mt-2">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <h4 class="font-color">Budget</h4>
                                </div>
                                <div class="col-md-6 col-sm-12 d-flex justify-content-end">
                                    <a id="add_budget" target="_blank" href="{{ route('homebudget.create', ['budget_id' => $event->id]) }}" class="font-14 btn btn-primary waves-effect waves-light">
                                        <span>+ Add / Update Budget</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-3 stickymenucontent">
                                <div class="col-md-3 col-sm-12">
                                    <div class="card shadow-lg text-center bg-danger text-white">
                                        <div class="card-body">
                                            <h5>Total Budget</h5>
                                            <?php
                                                $plannedAmount = (float)$budget->sum('planned_amount');
                                                $completedAmount = (float)$budget->sum('completed_amount');
                                                $remainingAmount = $plannedAmount - $completedAmount;
                                            ?>
                                            <h3><i class= "fas fa-inr"></i> {{ number_format($budget->sum('planned_amount'), 2) }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card shadow-lg text-center bg-warning text-white">
                                        <div class="card-body">
                                            <h5>Planned Budget</h5>
                                            <h3><i class= "fas fa-inr"></i> {{ number_format($budget->sum('planned_amount'), 2) }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card shadow-lg text-center bg-success text-white">
                                        <div class="card-body">
                                            <h5>Actual Amount</h5>
                                            <h3><i class= "fas fa-inr"></i> {{ number_format($budget->sum('completed_amount'), 2) }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card shadow-lg text-center bg-warning text-white">
                                        <div class="card-body">
                                            <h5>Remaining Amount</h5>
                                            <h3><i class= "fas fa-inr"></i> {{ number_format($remainingAmount, 2) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="list-item-4" class="mb-2 mt-2">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="font-color">Check List</h4>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a id="add_checklist" target="_blank" href="{{ route('checklist.create', ['occasion_id' => $event->id]) }}" class="font-14 btn btn-primary waves-effect waves-light">
                                        <span>+ Add / Update Check List</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-4 stickymenucontent">
                                <div class="col-md-3">
                                    <div class="card shadow-lg text-center bg-warning">
                                        <div class="card-body">
                                            <h5>Total Tasks</h5>
                                            <h2>{{ $checkList['total_tasks'] }}</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card shadow-lg text-center bg-success text-white">
                                        <div class="card-body">
                                            <h5>Completed Tasks</h5>
                                            <h2>{{ $checkList['completed_tasks'] }}</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card shadow-lg text-center bg-warning">
                                        <div class="card-body">
                                            <h5>Not Yet Started</h5>
                                            <h2>{{ $checkList['not_yet_task'] }}</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card shadow-lg text-center bg-info text-white">
                                        <div class="card-body">
                                            <h5>Ongoing</h5>
                                            <h2>{{ $checkList['pending_tasks'] }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="list-item-5" class="mb-2 mt-2">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="font-color">Itinerary</h4>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a data-bs-toggle="modal" data-bs-target="#itineraryModal" data-id="{{ $event->id }}" class="font-14 btn btn-primary waves-effect waves-light add_itinerary">
                                        <span>+ Add Itinerary</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row stickymenucontent p-3" id="itineraryList">
                                @foreach($event->occasionItinerary as $key => $itinerary)
                                    <div class="col-md-6 mb-3" id="itinerary-{{ $itinerary->id }}">
                                        <div class="card shadow-lg border-0 rounded-3 p-3">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-md-6">
                                                    <h6 class="mb-1">{{ $itinerary->label }}</h6>
                                                    <p class="text-muted mb-0">{{ date('F d, Y', strtotime($itinerary->date)) }}</p>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-between align-items-center">
                                                    <p class="mb-0 font-14">{{ $itinerary->start_time_value }} {{ $itinerary->start_time_label }} - {{ $itinerary->end_time_value }} {{ $itinerary->end_time_label }}</p>
                                                    <button class="btn btn-danger btn-sm delete-itinerary" data-id="{{ $itinerary->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lightbox-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="homemodal-content bg-transparent border-0 shadow-none">
            <div class="card">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <img id="lightbox-image" src="" class="img-fluid rounded border border-dark">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="collaborate_occasion" tabindex="-1" aria-labelledby="collaborateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="collaborateModalLabel">Add Collaborator</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form id="collaborateForm" method="post" action="{{ route('collaborate.event') }}">
                    @csrf
                    <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_number" required>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-slide-right" id="share_occasion" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Share Event</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <!-- Nav Pills -->
                <ul class="nav nav-pills mb-3 whatsapp-pills" id="collabTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link font-14 active" id="guest-tab" data-bs-toggle="pill" href="#guests" role="tab">Guests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-14 ml-2" id="group-tab" data-bs-toggle="pill" href="#groups" role="tab">Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-14 ml-2" id="relation-tab" data-bs-toggle="pill" href="#relations" role="tab">Relations</a>
                    </li>
                </ul>

                
                <!-- Search Box -->
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search Guests, Groups, Relations...">
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Guests Tab -->
                    <div class="tab-pane fade show active" id="guests" role="tabpanel">
                        <ul class="list-group share_list_group" id="guestList">
                            @foreach($guests as $guest)
                                <li class="list-group-item search-item">
                                    <input type="checkbox" name="guests[]" value="{{ $guest->id }}" class="guest-checkbox" id="guest_checkbox_{{ $guest->id }}"> 
                                    <label for="guest_checkbox_{{ $guest->id }}">{{ $guest->name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Groups Tab -->
                    <div class="tab-pane fade" id="groups" role="tabpanel">
                        <ul class="list-group share_list_group" id="groupList">
                            @foreach($guestGroups as $group)
                                <li class="list-group-item search-item">
                                    <input type="checkbox" name="groups[]" value="{{ $group->id }}" class="group-checkbox" id="group_checkbox_{{ $group->id }}">
                                    <label for="group_checkbox_{{ $group->id }}">{{ $group->group_name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Relations Tab -->
                    <div class="tab-pane fade" id="relations" role="tabpanel">
                        <ul class="list-group share_list_group" id="relationList">
                            @foreach($guestRelation as $rel)
                                <li class="list-group-item search-item">
                                    <input type="checkbox" name="relations[]" value="{{ $rel->relationship }}" class="relation-checkbox" id="relation_checkbox_{{ $rel->relationship }}">
                                    <label for="relation_checkbox_{{ $rel->relationship }}">{{ $rel->relationship }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <form action="{{ route('share.event') }}" method="post">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <input type="hidden" id="selectedGuests" name="selectedGuests">
                <input type="hidden" id="selectedGroups" name="selectedGroups">
                <input type="hidden" id="selectedRelations" name="selectedRelations">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Share</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="itineraryModal" tabindex="-1" aria-labelledby="itineraryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itineraryModalLabel">Add Itinerary</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form id="itineraryForm">
                    @csrf
                    <input type="hidden" name="event_id" id="event_id">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Start Time</label>
                            <div class="d-flex">
                                <input type="time" class="form-control" name="start_time" required>
                                <select class="form-select ml-2" name="start_ampm">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Time</label>
                            <div class="d-flex">
                                <input type="time" class="form-control" name="end_time" required>
                                <select class="form-select ml-2" name="end_ampm">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Itinerary</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_occasion_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method = "post" action = "{{ route('home/occasion/update')}}">
                @csrf
                <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="occasiondate" class="font-14">Event Date </label>
                                <input type="Date" class="form-control" name="occasiondate" id="occasiondate" placeholder="Select Date" required="required" value="{{ $event->occasiondate }}">
                            </div>
                            <input type = "hidden" name = "userid" value = "{{ Auth::user()->id }}" />
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="event_name" class="font-14">Event Name </label>
                                <input type="text" id="event_name" placeholder="Event Name" name="event_name" class="form-control" value="{{ $event->occasion_name }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="occasiontype" class="font-14">Event Type </label>
                                <select class="form-control" name="occasiontype" id="occasiontype" required="required">
                                <option>Select Event</option>
                                    @foreach($occasiontype as $typename)
                                        <option value="{{ $typename->id }}" {{$typename->id == $event->occasiontypeid ? 'selected' : '' }}>{{ $typename->eventtypename }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="countryInput" class="font-14">Occasion Place </label>
                                <input type="text" id="countryInput" placeholder="Event Place" name="occasion_place" value="{{ $event->occasion_place }}" class="form-control">                
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="message" class="font-14">Notes </label>
                                <textarea name="message" id="message" class="form-control" rows="5" cols="25" placeholder="Notes"> {{ $event->notes }} </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn secondary-outline-btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn primary-solid-btn" id ="updateoccasion">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new bootstrap.ScrollSpy(document.body, {
            target: "#event",
            offset: 10
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const images = document.querySelectorAll(".image-preview-list");
        const lightboxImage = document.getElementById("lightbox-image");
        const lightboxModal = new bootstrap.Modal(document.getElementById("lightbox-modal"));

        images.forEach(img => {
            img.addEventListener("click", function () {
                lightboxImage.src = this.src;
                lightboxModal.show();
            });
        });
    });

    $(document).on("click", ".btn-close", function () {
        $(".modal").modal("hide");
    });
</script>
<script>
    $(document).ready(function () {
        $("#itineraryForm").submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('home.itinerary.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        $("#itineraryModal").modal("hide");
                        $("#itineraryForm")[0].reset();

                        const itineraryDate = new Date(response.itinerary.date);
                        const formattedDate = itineraryDate.toLocaleDateString('en-US', { 
                            month: 'long', 
                            day: '2-digit', 
                            year: 'numeric' 
                        });
                        $("#itineraryList").append(`
                            <div class="col-md-6 mb-3" id="itinerary-${response.itinerary.id}">
                                <div class="card shadow-lg border-0 rounded-3 p-3">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-6">
                                            <h6 class="mb-1">${response.itinerary.label}</h6>
                                            <p class="text-muted mb-0">${formattedDate}</p>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-between align-items-center">
                                            <p class="mb-0 font-14">${response.itinerary.start_time_value} ${response.itinerary.start_time_label} - ${response.itinerary.end_time_value} ${response.itinerary.end_time_label}</p>
                                            <button class="btn btn-danger btn-sm delete-itinerary" data-id="${response.itinerary.id}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                },
                error: function (xhr) {
                    alert("Error saving itinerary!");
                },
            });
        });

        $(document).on("click", ".delete-itinerary", function () {
            let id = $(this).data("id");

            $.ajax({
                url: "{{ url('/home/event/itinerary/delete') }}/" + id,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function (response) {
                    if (response.success) {
                        $("#itinerary-" + id).remove();
                    }
                },
                error: function () {
                    alert("Error deleting itinerary!");
                },
            });
        });

        $('.add_itinerary').on('click', function(){
            $('#event_id').val($(this).data('id'));
        })

        document.addEventListener("DOMContentLoaded", function () {
            const listItems = document.querySelectorAll(".list-group-item");

            listItems.forEach(item => {
                item.addEventListener("click", function () {
                    // Remove 'active' class from all items
                    listItems.forEach(li => li.classList.remove("active"));

                    // Add 'active' class to the clicked item
                    this.classList.add("active");
                });
            });
        });
    });

    $(document).ready(function() {
        $('body').scrollspy({ target: '#verticalScrollspy' });
    });

    $(document).on('click', '[data-dismiss="modal"]', function () {
        $('.modal').modal('hide');
    });

    $(document).ready(function () {
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".search-item").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        function updateSelectedValues() {
            var selectedGuests = [];
            var selectedGroups = [];
            var selectedRelations = [];

            $(".guest-checkbox:checked").each(function () {
                selectedGuests.push($(this).val());
            });

            $(".group-checkbox:checked").each(function () {
                selectedGroups.push($(this).val());
            });

            $(".relation-checkbox:checked").each(function () {
                selectedRelations.push($(this).val());
            });

            // Assign values to hidden inputs
            $("#selectedGuests").val(selectedGuests.join(","));
            $("#selectedGroups").val(selectedGroups.join(","));
            $("#selectedRelations").val(selectedRelations.join(","));
        }

        $(".guest-checkbox, .group-checkbox, .relation-checkbox").on("change", function () {
            updateSelectedValues();
        });
    });

</script>
@endpush
