@extends('admin.layouts.app-admin')

@section('content')

<style type="text/css">
    .form-check-input[type=checkbox] {
        border: 1px solid black;
    }

    .imageOutput img {
        width: 200px;
        height: auto;
    }

    #venuearea-selectized {
        width: 100% !important;
        border: none !important;
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

</style>

<link href="{{ asset('adminassets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Edit Venue</h4>

                <div class="row">
                    <div class="col-6 text-start">
                        <a href ="{{ route('venue/detailview', ['id' => $venue->id]) }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-arrow-left me-1"></span>Back
                        </a>
                    </div>
                    <div class="col-6 text-end">
                        <a href = "{{ route('venue/index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-eye me-1"></span>List Venue
                        </a>
                    </div>
                </div>
                <br>
                <form action="{{ route('venue.hallupdate', ['id' => $venue->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                    <input type = "hidden" name = "parentid" value = "{{ $parentid }}" />
                        <!-- Venue Details -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="true">
                                    Venue Details
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-6">                    
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label required" for="venuetypename">Venue Name <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" id="venuename" name="venuename" class="form-control " placeholder="Enter the venue name" value="{{ $venue->venuename }}" #a32206>
                                                    @error('venuename')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="venueaddress">Venue Address <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" placeholder="Enter the venue Address" id="venueaddress" name = "venueaddress" style="height: 100px">{{ $venue->venueaddress }}</textarea>
                                                    @error('venueaddress')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="venuearea">Area <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                <select id="venuearea" name="venuearea" class="form-control">
                                                    @if(isset($venue) && $venue->locationid) 
                                                        <option value="{{ $venue->locationid }}" selected>{{ $venue->area->areaname }}</option>
                                                    @endif
                                                </select>
                                                    @error('venuearea')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <input type="hidden" name="locationid" id="locationid" value="{{ $venue->locationid }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="venuecity">City </label>
                                                <div class="col-md-8">
                                                    <input type="text" id="venuecity" name="venuecity" class="form-control" placeholder="Enter the city name" value="{{ $venue->area->city->cityname ?? '' }}" >
                                                    @error('venuecity')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="venuedistrict">District</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="venuedistrict" name="venuedistrict" class="form-control" placeholder="Enter the District name" value="{{ $venue->area->district->districtname ?? '' }}" >
                                                    @error('venuedistrict')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> 
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="venuestate">State</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="venuestate" name="venuestate" class="form-control" placeholder="Enter the state name" value="{{ $venue->area->state->statename ?? '' }}" >
                                                    @error('venuestate')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> 
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="venuepincode">Pincode</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="venuepincode" name="venuepincode" class="form-control" placeholder="Enter the pincode name" value="{{ $venue->area->pincode ?? '' }}" >
                                                    @error('venuepincode')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="mb-4 row">
                                            <label class="col-md-2 col-form-label" for="description">Description</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" placeholder="Enter the description about venue" id="description" name="description" style="height: 100px">{{ $venue->description }}</textarea>
                                                @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="contactperson">Contact Person</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="contactperson" name="contactperson" class="form-control" placeholder="Enter the Contact person name" value="{{ $venue->contactperson }}" required>
                                                        @error('contactperson')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="contactmobile">Mobile No</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="contactmobile" name="contactmobile" class="form-control" placeholder="Enter the Contact Mobile No" value="{{ $venue->contactmobile }}" required>
                                                        @error('contactmobile')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="contacttelephone">Telephone No</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="contacttelephone" name="contacttelephone" class="form-control" placeholder="Enter the Venue Telephone No" value="{{ $venue->contacttelephone }}">
                                                        @error('contacttelephone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="contactemail">Email Id</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="contactemail" name="contactemail" class="form-control" placeholder="Enter the Contact Email Id" value="{{ $venue->contactemail }}">
                                                        @error('contactemail')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="websitename">Website</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="websitename" name="websitename" class="form-control" placeholder="Enter the website name" value="{{ $venue->websitename }}">
                                                        @error('websitename')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                    <div class="mb-4 row">
                                                        <label class="col-md-4 col-form-label" for="bookingprice">Booking Rate <span class="text-danger">*</span></label>
                                                        <div class="col-md-8">
                                                            <input type="text" id="bookingprice" name="bookingprice" class="form-control" placeholder="Enter the Booking Price" value="{{ old('bookingprice', $venue->bookingprice) }}">
                                                            @error('bookingprice')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="venuetypeid">Select Venue Type <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                    <select class="form-select" id="venuetypeid" name="venuetypeid" aria-label="Floating label select example">
                                                        <option value="">Choose Venue Type</option>
                                                        @foreach($venuetypes as $type)
                                                            <option value="{{ $type->id }}" {{ old('venuetypeid', $venue->venuetypeid) == $type->id ? 'selected' : '' }}>
                                                                {{ $type->venuetype_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                        @error('venuetypeid')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="budgetperplate">Budget Per Plate</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="budgetperplate" name="budgetperplate" class="form-control" placeholder="Enter the budget per plate" value="{{ old('budgetperplate', $venue->budgetperplate) }}">
                                                        @error('budgetperplate')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="capacity">Seating Capacity <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="capacity" name="capacity" class="form-control" placeholder="Enter the capacity" value="{{ old('capacity', $venue->capacity) }}">
                                                        @error('capacity')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="food_type">Food Type <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <select id="food_type" name="food_type" class="form-control">
                                                            <option value="">Select Food Type</option>
                                                            <option value="Veg" {{ old('food_type', $venue->food_type) == 'Veg' ? 'selected' : '' }}>Veg</option>
                                                            <option value="Non-Veg" {{ old('food_type', $venue->food_type) == 'Non-Veg' ? 'selected' : '' }}>Non-Veg</option>
                                                            <option value="Both" {{ old('food_type', $venue->food_type) == 'Both' ? 'selected' : '' }}>Both (Veg & Non-Veg)</option>
                                                        </select>
                                                        @error('food_type')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <!-- Select Amenities -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo">
                                    Select Amenities
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="col-6" style="margin-left: 30px;">
                                        @foreach($venueamenities as $amenity)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="venueamenities[]"
                                                value="{{ $amenity->id }}" 
                                                {{ in_array($amenity->id, json_decode($venue->venueamenities, true) ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $amenity->amenities_name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Data Fields -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree">
                                    Add Data Fields
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="row">
                                        @php
                                            $venueDataArray = json_decode($venue->venuedata, true); // Convert JSON to array
                                        @endphp
                                        @foreach($venuedatafield as $index => $datafield)
                                        <div class="col-6">
                                            <div class="mb-4">
                                                <label class="col-md-4 col-form-label">{{ $datafield->datafieldname }}</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="datafieldvalue[{{ $datafield->id }}]" class="form-control"
                                                        value="{{ $venueDataArray[$index] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFour">
                                    Image Upload
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="mb-4">
                                        <label class="form-label">Upload Banner Image</label>
                                        <input class="form-control" type="file" name="bannerimage">
                                        @if($venue->bannerimage)
                                        <div class="imageOutput mt-2">
                                            <img src="{{ asset('storage/' . $venue->bannerimage) }}" alt="Venue Banner">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Google Map & Budget -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFive">
                                    Google Map
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="mb-4">
                                        <label class="form-label">Google Map Location Code</label>
                                        <textarea name="googlemap" class="form-control">{{ $venue->googlemap }}</textarea>
                                    </div>                                  
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Update Venue</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@php
    $areaOptions = $arealocation->map(function($area) {
        return [
            'id' => $area->id,
            'title' => $area->areaname  // or $area->Areaname depending on your attribute name
        ];
    });
@endphp

@endsection

@push('scripts')
<script type="text/javascript">

    $images = $('#categoryiconimage')
    $(".imageUpload").change(function(event){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            $.each(input.files, function() {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $images.html('<img src="'+ e.target.result+'" />')
                }
                reader.readAsDataURL(this);
            });
        }
    }

</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
/*
    var areaOptions = {!! json_encode($areaOptions) !!};
    $('#venuearea').selectize({
        valueField: 'id',
        labelField: 'title',
        searchField: 'title',
        options: areaOptions,
        create: false
    });*/

    $(document).ready(function () {
        var preselectedId = <?=$venue->area->id?>;
        var preselectedText = <?=$venue->area->areaname?>;
        var newOption = new Option(preselectedText, preselectedId, true, true);
        $('#venuearea').append(newOption).trigger('change');
    });

    $('#venuearea').select2({
        placeholder: 'Search for an area',
        allowClear: true,
        ajax: {
            url: "{{ route('venue.ajaxarealist') }}", // Route to fetch data
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // Send search term to backend
                };
            },
            processResults: function (data) {
                console.log(data.results); // Debug API response
                return {
                    results: data.results // Use 'results' key from API response
                };
            },
            cache: true,
        },
        minimumInputLength: 1,
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });

    $("#venuearea").change(function(e) {
        e.preventDefault();
        var area_id = $(this).val();

        $.ajax({
            type: 'POST',
            url: "{{ route('venue/create/ajaxcitylist') }}",
            dataType: 'json',
            data: { "_token": "{{ csrf_token() }}", "area_id": area_id },
            success: function(response) {
                var returnData = response;              
                
                $("#venuecity").val(returnData['city']);
                $("#venuestate").val(returnData['state']);
                $("#venuedistrict").val(returnData['district']);
                $("#venuepincode").val(returnData['pincode']);
                $("#locationid").val(returnData['id']);
            }
        });
    });

    $("#venuetypeid").change(function(e) {
        e.preventDefault();
        var venuetypeid = $(this).val();

        $.ajax({
            type: 'POST',
            url: "{{ route('venue/create/ajaxcvenuesubtypelist') }}",
            dataType: 'json',
            data: { "_token": "{{ csrf_token() }}", "venuetypeid": venuetypeid },
            success: function(response) {
                $("#venuesubtypeid").empty();
                var returnData = response;
                if (returnData.length > 0) {
                    let casestr = '<option>Select Venue Sub Type</option>';
                    for (i = 0; i < returnData.length; i++) {
                        casestr += '<option value="' + returnData[i]['id'] + '">' + returnData[i]['venuetype_name'] + '</option>';
                    }
                    $("#venuesubtypeid").append(casestr);
                } else {
                    alert("No Data");
                }
            }
        });
    });

</script>
@endpush
