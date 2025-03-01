@extends('admin.layouts.app-admin')
<style>::after, ::before {box-sizing: border-box;}

.container {
    display: flex; /* Enable flexbox on the container */
    flex-direction: column; /* Stack table and pagination vertically */
    min-height: 100vh; /* Optional: Make container take full viewport height */
}

#datatable {
    width: 100%;
    margin: 0 auto;
    clear: both;
    border-collapse: collapse;
    table-layout: fixed;
    word-wrap: break-word;
    flex: 1;
}

.pagination {
    margin-top: 20px; 
}

</style>

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Area</h4>

                <div class="row mt-4">
                    <div class="col-6">
                        <a href="{{ route('venuesettings') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-arrow-left-thick me-1"></span>Back
                        </a>
                    </div>

                    <div class="col-6 text-end">   
                        <a href="{{ route('venue.area/create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-plus me-1"></span>Add
                        </a>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <!-- Filter and Search Form -->
                        <form method="GET" action="{{ route('venue.area') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="text" name="search" class="form-control" placeholder="Search Area" value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="state" class="form-control" id="stateDropdown">
                                        <option value="">All State</option>
                                        @foreach($states as $sta)
                                            <option value="{{ $sta->id }}" {{ request('state') == $sta->statename ? 'selected' : '' }}>{{ $sta->statename }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select name="district" class="form-control" id="districtDropdown">
                                        <option value="">All District</option>
                                        @foreach($districts as $dist)
                                            <option value="{{ $dist->id }}" {{ request('district') == $dist->districtname ? 'selected' : '' }}>{{ $dist->districtname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="city" class="form-control" id="cityDropdown">
                                        <option value="">All City</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ request('city') == $city->cityname ? 'selected' : '' }}>{{ $city->cityname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select name="sort" class="form-control">
                                        <option value="">Sort by</option>
                                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Alphabet A - Z</option>
                                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Alphabet Z - A</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('venue.area') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container">
                    @if(count($area) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0" id="datatable">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Area Name</th>
                                        <th class="text-center">City Name</th>
                                        <th class="text-center">District Name</th>
                                        <th class="text-center">State Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $start = ($area->currentPage() - 1) * $area->perPage() + 1;
                                    @endphp
                                    @foreach($area as $dist)
                                        <tr>
                                            <td>{{ $start++ }}</td>
                                            <td>{{ $dist->areaname }}</td>
                                            <td>{{$dist->city->cityname }}</td>
                                            <td>{{ $dist->district->districtname ?? '' }}</td>
                                            <td>{{ $dist->state->statename ?? '' }}</td>
                                            <td>
                                                @if($dist->status == 'Active')
                                                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $dist->id }}" title="Status"><i class="fa fa-eye action_icon"></i></button>
                                                @else 
                                                    <button type="button" class="btn-info btn statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $dist->id }}" title="Status"><i class="fa fa-eye-slash action_icon"></i></button>
                                                @endif
                                                <a href="{{ url('/admin/area/'.$dist->id.'/edit') }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i></a>
                                                <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="{{ $dist->id }}" title="Delete"><i class="fa fa-trash action_icon"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center"> {{-- Center the pagination --}}
                            {{ $area->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    @else
                        No Records Found
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/area/') }}">

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