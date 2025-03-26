@extends('profile-layouts.profile')
@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        @include('profile-layouts.invitationmenu')
        <div class="col-lg-11 col-md-11 stickymenucontent"> 

            <!--blog section start-->
    
        <div class="container">
    <div class="row justify-content-center">
    <center><h2 class="text-center">{{ __('Invitation') }}</h2></center>
    <div class="col-md-12 mb-12">
    <div class="col-md-12 mb-12">
            <div class="card shadow-lg border-0 rounded-3">
           

                <div class="card-body">
                <div class="d-flex justify-content-end">
                    <!-- Button trigger modal -->
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInvitationModal">Create Invitation</a>

                 
                </div>
				<div>
					
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
<div class="col-lg-2 col-md-2">
    @include('profile-layouts.rightside')
</div>
   <!-- Modal -->
   <div class="modal fade" id="createInvitationModal" tabindex="-1" aria-labelledby="createInvitationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="homemodal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createInvitationModalLabel">Create Invitation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('invitationcard.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="template_name" name="template_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="size" class="form-label">Size</label>
                            <select class="form-control" id="template_size" name="template_size" required>
                                <option value="">Select Size</option>
                                @foreach($invitationCardSizes as $size)
                                    <option value="{{ $size->size_name }}">{{ $size->size_width }} -  {{ $size->size_height }}</option>
                                @endforeach
                            </select>
                        </div>
                     
                        <div class="mb-3">
                            <label for="cat_id" class="form-label">Occasion Type</label>
                            <select class="form-control" id="cat_id" name="cat_id" required>
                                <option value="">Select Event</option>
                                @foreach($occasionTypes as $occasionType)
                                    <option value="{{ $occasionType->id }}">{{ $occasionType->eventtypename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection