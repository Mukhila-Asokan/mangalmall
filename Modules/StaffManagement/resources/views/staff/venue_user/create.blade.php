@extends('admin.layouts.app-admin')
@section('content')
<style type="text/css">
    .form-check-input[type=checkbox]{
        border:1px solid black;
    }
    .imageOutput img{
        width:200px;
        height:auto;
    }
    .select2-selection__clear {
            margin-top: 5px !important;
    }
    .select2-selection__rendered {
        line-height: 40px !important;  /* Adjust text height */
    }
    .select2-container .select2-selection--single {
        height: 40px !important;  /* Adjust the select box height */
    }
    .is-valid {
        border-color: #28a745; /* Green border for valid input */
    }
    .is-invalid {
        border-color: #dc3545; /* Red border for invalid input */
    }
</style>
<link href="{{ asset('adminassets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4">Add Venue User</h4>
            <div class="text-end">
                <a href = "{{ route('venue/index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-eye me-1"></span>Venue User List
                </a>
            </div>
            <form class="form-horizontal" role="form" method = "post" action="{{ route('venue.venue_add') }}" enctype="multipart/form-data">
               @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control mt-2" placeholder="Enter venue user name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control mt-2" placeholder="Enter venue user email" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" id="mobile" name="mobile" class="form-control mt-2" placeholder="Enter venue user mobile number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="mobile">City</label>
                        <input type="text" id="mobile" name="mobile" class="form-control mt-2" placeholder="Enter venue user city" required>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="submit-btn justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Venue User </button>
                    </div>
                </div>
            </div>
         </div>
      </div>
      </form>
   </div>
</div>
</div>
</div>
@endsection