@extends('venueadmin::layouts.admin-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 text-start">
                        <a href ="{{ route('venueadmin/view', ['id' => $venue->id]) }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-arrow-left me-1"></span>Back
                        </a>
                        </div>
                        <div class="col-6 text-end">
                        <a href = "{{ route('venueadmin/venuelist') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-eye me-1"></span>List Venue
                        </a>
                        </div>
                    </div>
                    <div class="row">
                        <form class="form-horizontal" role="form" method = "post" action="{{ route('venueadmin/venueimage_add') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="venue_id" value="{{ $venue->id }}">
                        <div class="col-8">
                            <div class="mb-4 row">
                                <label class="col-md-2 col-form-label" for="sliderimage">Slider</label>
                                <div class="col-md-10">
                                    <input id="images" type="file" class="form-control" name="sliderimage[]" multiple>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-md-2 col-form-label" for="sliderimage">Gallery</label>
                                <div class="col-md-10">
                                    <input id="images" type="file" class="form-control" name="galleryimage[]" multiple>
                                </div>
                            </div>
                            @if ($errors->has('sliderimage'))
                            <div class="text-danger">{{ $errors->first('sliderimage') }}</div>
                            @elseif ($errors->has('galleryimage'))
                            <div class="text-danger">{{ $errors->first('galleryimage') }}</div>
                            @endif
                            <br><br>
                            <div class="justify-content-end row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update Gallery</button>
                                </div>
                            </div>
                        </form>
                        <br><br><br>
                        @if($venueimage->count() > 0)    {{-- Check if there are images --}}
                            <h3>Uploaded Images</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Slider Images</h5>
                                    <div class="row">
                                        @foreach($venueimage->where('image_type', 'slider') as $image)
                                            <div class="col-md-4">
                                                <div class="image-container">
                                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail" width="350">
                                                    <button class="delete-btn" data-id="{{ $image->id }}"><span class="tf-icon mdi mdi-delete me-1"></span></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="clearfix" style="height:20px;width:100%;float:none;position:relative"></div>
                                    <div class="col-md-12">
                                        <h5>Gallery Images</h5>
                                        <div class="row">
                                            @foreach($venueimage->where('image_type', 'gallery') as $image)
                                                <div class="col-md-4">
                                                    <div class="image-container">
                                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail" width="350">
                                                        <button class="delete-btn" data-id="{{ $image->id }}"><span class="tf-icon mdi mdi-delete me-1"></span></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".delete-btn").click(function() {
                let imageId = $(this).data("id");
                let imageContainer = $(this).closest(".col-md-4");

                if (confirm("Are you sure you want to delete this image?")) {
                    $.ajax({
                        url: "{{ route('venue.image_delete') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: imageId
                        },
                        success: function(response) {
                            if (response.success) {
                                imageContainer.fadeOut(500, function() {
                                    $(this).remove();
                                });
                            } else {
                                alert("Error deleting image.");
                            }
                        },
                        error: function(response) {
                            alert("Something went wrong.");
                        }
                    });
                }
            });
        });
    </script>
@endpush