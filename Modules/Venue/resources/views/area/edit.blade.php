@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Edit Area</h4>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('venuesettings') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-arrow-left-thick me-1"></span>Back
                        </a>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('venue.area') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-eye me-1"></span>View List
                        </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form" method="post" action="{{ route('venue.area_update', $area->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="areaname">Area Name</label>
                            <div class="col-md-8">
                                <input type="text" id="areaname" name="areaname" class="form-control" placeholder="Enter the Area name" value="{{ old('areaname', $area->areaname) }}">
                                @error('areaname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="pincode">Pincode</label>
                            <div class="col-md-8">
                                <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter the Pincode" value="{{ old('pincode', $area->pincode) }}">
                                @error('pincode')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="stateid">State Name</label>
                            <div class="col-md-8">
                                <select name="stateid" class="form-control" id="stateDropdown">
                                    <option value="">Select State</option>
                                    @foreach($states as $sta)
                                    <option value="{{ $sta->id }}" {{ old('stateid', $area->stateid) == $sta->id ? 'selected' : '' }}>{{ $sta->statename }}</option>
                                    @endforeach
                                </select>
                                @error('stateid')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="districtid">District Name</label>
                            <div class="col-md-8">
                                <select name="districtid" class="form-control" id="districtDropdown">
                                    <option value="">Select District</option>
                                    @foreach($districts as $dis)
                                    <option value="{{ $dis->id }}" {{ old('districtid', $area->districtid) == $dis->id ? 'selected' : '' }}>{{ $dis->districtname }}</option>
                                    @endforeach
                                </select>
                                @error('districtid')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="cityid">City Name</label>
                            <div class="col-md-8">
                                <select name="cityid" class="form-control" id="cityDropdown">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('cityid', $area->cityid) == $city->id ? 'selected' : '' }}>{{ $city->cityname }}</option>
                                    @endforeach
                                </select>
                                @error('cityid')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Area</button>
                        </div>
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
    $('#stateDropdown').on('change', function () {
        var stateId = $(this).val();
        if (stateId) {
            $.ajax({
                url: "{{ route('get.districts') }}",
                type: "GET",
                data: { state_id: stateId },
                dataType: "json",
                success: function (data) {
                    $('#districtDropdown').empty().append('<option value="">All District</option>');
                    $.each(data, function (key, value) {
                        $('#districtDropdown').append('<option value="' + value.id + '">' + value.districtname + '</option>');
                    });
                }
            });
        } else {
            $('#districtDropdown').empty().append('<option value="">All District</option>');
        }
    });

    $('#districtDropdown').on('change', function () {
        var districtId = $(this).val();
        if (districtId) {
            $.ajax({
                url: "{{ route('get.cities') }}",
                type: "GET",
                data: { district_id: districtId },
                dataType: "json",
                success: function (data) {
                    $('#cityDropdown').empty().append('<option value="">All City</option>');
                    $.each(data, function (key, value) {
                        $('#cityDropdown').append('<option value="' + value.id + '">' + value.cityname + '</option>');
                    });
                }
            });
        } else {
            $('#cityDropdown').empty().append('<option value="">All City</option>');
        }
    });
});
</script>
@endpush