@extends('profile-layouts.profile')

@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        @include('profile-layouts.sticky')
        <div class="col-lg-11 col-md-11 stickymenucontent">
            <h4 class="text-center mb-3">Itinerary Board</h4>
            @foreach($events as $event)
                <div class="card p-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="font-color">{{ $event->occasion_name }}</h5>
                            <a data-bs-toggle="modal" data-bs-target="#itineraryModal" data-id="{{ $event->id }}" class="btn btn-primary btn-sm add_itinerary">
                                <i class="fas fa-plus mt-1"></i> Add Itinerary
                            </a>
                        </div>
                        <span class="text-muted font-14">Event - {{ $event->Occasionname->eventtypename }}</span>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row" id="itineraryList">
                            @foreach($event->occasionItinerary as $key => $itinerary)
                                <div class="col-md-6 mb-3" id="itinerary-{{ $itinerary->id }}">
                                    <div class="card shadow-lg border-0 rounded-3 p-2">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-6">
                                                <h6 class="mb-1">{{ $itinerary->label }}</h6>
                                                <p class="text-muted mb-0">{{ date('F d, Y', strtotime($itinerary->date)) }}</p>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-between align-items-center">
                                                <p class="mb-0">{{ $itinerary->start_time_value }} {{ $itinerary->start_time_label }} - {{ $itinerary->end_time_value }} {{ $itinerary->end_time_label }}</p>
                                                <button class="btn btn-danger btn-sm delete-itinerary" data-id="{{ $itinerary->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($key >= 3)
                                    @break;
                                @endif
                            @endforeach
                            @if(count($event->occasionItinerary) > 4)
                                <a href="{{ route('view.event.page', ['id' => $event->id]) }}" target="_blank" class="font-14 ml-4">View more....</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>         
    </div>
</div>

<div class="modal fade" id="itineraryModal" tabindex="-1" aria-labelledby="itineraryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itineraryModalLabel">Add Itinerary</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Itinerary</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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

                        $("#itineraryList").append(`
                            <div class="col-md-6 mb-3" id="itinerary-${response.itinerary.id}">
                                <div class="card shadow-lg border-0 rounded-3 p-3">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-6">
                                            <h6 class="mb-1">${response.itinerary.label}</h6>
                                            <p class="text-muted mb-0">${response.itinerary.date}</p>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-between align-items-center">
                                            <p class="mb-0">${response.itinerary.start_time_value} ${response.itinerary.start_time_label} - ${response.itinerary.end_time_value} ${response.itinerary.end_time_label}</p>
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
    });
</script>
@endpush
