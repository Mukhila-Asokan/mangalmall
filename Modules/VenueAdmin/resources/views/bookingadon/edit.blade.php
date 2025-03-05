@extends('venueadmin::layouts.admin-layout')
@section('content')

<form class="form-horizontal" role="form" method="post" action="{{ route('bookingadons.update', $bookingadon->id) }}">
    @csrf
    @method('PUT')
    <div class="col-12">
        <div class="card">
        <div class="row mt-4">
                <div class="text-end me-2">   
                        <a href="{{ route('venue.bookingadons') }}" class="me-4 btn btn-primary waves-effect waves-light mb-4 text-end">
                        <i class="bi bi-eye"></i> View
                        </a>
                </div>
        </div>
            <div class="card-body">
             
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="addonname">Addon Name</label>
                    <div class="col-md-6">
                        <input type="text" id="addonname" name="addonname" class="form-control border border-warning" placeholder="Enter the addon name" value="{{ old('addonname', $bookingadon->addonname) }}" required>
                        @error('addonname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="price">Price</label>
                    <div class="col-md-6">
                        <input type="text" id="price" name="price" class="form-control border border-warning" placeholder="Enter the price" value="{{ old('price', $bookingadon->price) }}" required>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="addon_description">Addon Description</label>
                    <div class="col-md-6">
                        <textarea id="addon_description" name="addon_description" class="form-control border border-warning" placeholder="Enter the addon description" required>{{ old('addon_description', $bookingadon->addon_description) }}</textarea>
                        @error('addon_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection