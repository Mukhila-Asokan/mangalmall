@extends('admin.layouts.app-admin')
@section('content')
<style type="text/css">
    
    .form-check-input[type=checkbox]
    {
        border:1px solid black;
    }

    .imageOutput img
    {
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
</style>

 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Venue</h4>
                       
                        <div class="text-end">
                         <a href = "{{ route('venue/index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Venue List
                           </a>
                        </div>
                  
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('venue.hall_add') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12">
                                        <input type = "hidden" name = "parentid" value = "{{ $parentid }}" />
                                           <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Venue Details
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">

                          <div class="row">
                                  <div class="col-6">                    
                                          <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label required" for="venuetypename">Hall/Venue Name <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuename" name="venuename" class="form-control " placeholder="Enter the venue name" value = "{{ old('venuename') }}" #a32206>
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
                                        </div>
                                    </div>

                                   <div class="col-6">
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuecity">City </label>
                                            <div class="col-md-8">                                          
                                                <input type = "hidden" name = "locationid" id = "locationid" value = "{{ $venue->locationid }}" />
                                                  <input type="text" id="venuecity" name="venuecity" class="form-control" placeholder="Enter the city name" value = "{{ old('venuecity', $venue->area->city->cityname ?? '') }}" >
                                                  @error('venuecity')
                                                   <div class="text-danger">{{ $message }}</div>
                                                  @enderror
                                            </div>
                                        </div>

                                        
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuedistrict">District</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuedistrict" name="venuedistrict" class="form-control" placeholder="Enter the District name" value = "{{ $venue->area->district->districtname ?? '' }}" >
                                             
                                            </div>
                                        </div> 


                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuestate">State</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuestate" name="venuestate" class="form-control" placeholder="Enter the state name" value = "{{ $venue->area->state->statename ?? '' }}" >
                                                  @error('venuestate')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> 

                                         <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuepincode">Pincode</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuepincode" name="venuepincode" class="form-control" placeholder="Enter the pincode name" value = "{{ $venue->area->pincode ?? '' }}" >
                                                  @error('venuepincode')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> 

                                    </div> 

                                    <div class="mb-4 row">
                                            <label class="col-md-2 col-form-label" for="description">Description <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                  <textarea class="form-control" placeholder="Enter the Description" id="description" name = "description" style="height: 100px">{{ old('description') }}</textarea>
                                                  @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                             <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactperson">Contact Person <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactperson" name="contactperson" class="form-control" placeholder="Enter the Contact person name" value = "{{ $venue->contactperson }}" >
                                                  @error('contactperson')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> 
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactmobile">Mobile No <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactmobile" name="contactmobile" class="form-control" placeholder="Enter the Contact Mobile No" value = "{{ $venue->contactmobile }}" >
                                                  @error('contactmobile')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> 
                                        

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contacttelephone">Telephone No</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contacttelephone" name="contacttelephone" class="form-control" placeholder="Enter the Venue Telephone No" value = "{{ $venue->contacttelephone }}" >
                                               
                                            </div>
                                        </div> 



                                        </div>
                                        <div class="col-6">

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactemail">Email Id</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactemail" name="contactemail" class="form-control" placeholder="Enter the Contact Email Id" value = "{{ $venue->contactemail }}" >
                                                 
                                            </div>
                                        </div> 

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactemail">Website</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="websitename" name="websitename" class="form-control" placeholder="Enter the websitename" value = "{{ $venue->websitename }}" >
                                                
                                            </div>
                                        </div> 

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="bookingprice">Booking Rate <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                            <input type="text" id="bookingprice" name="bookingprice" class="form-control" placeholder="Enter the Booking Price" value = "{{ old('bookingprice') }}" >
											   @error('bookingprice')
													<div class="text-danger">{{ $message }}</div>
                                               @enderror
                                            </div>
                                        </div> 

                                        </div>
                                        </div>

<div class ="row">
    <div class="col-6">
             <div class="mb-4 row">
                  <label class="col-md-4 col-form-label" for="venuetypeid">Select Venue Type <span class="text-danger">*</span></label>
                   <div class="col-md-8">                    
                   <select class="form-select" id="venuetypeid" name="venuetypeid" aria-label="Floating label select example">
                        <option value="">Select Venue Type</option>
                        @foreach($venuetypes as $type)
                            <option value="{{ $type->id }}" 
                                {{ (string) old('venuetypeid', $venue->venuetypeid ?? '') === (string) $type->id ? 'selected' : '' }}>
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
                  <label class="col-md-4 col-form-label" for="budgetperplate">Budget Per Plate </label>
                   <div class="col-md-8">
                 
                        <input type="text" id="budgetperplate" name="budgetperplate" class="form-control" placeholder="Enter the budget per plate" value = "{{ old('budgetperplate') }}" >
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
                 
                        <input type="text" id="capacity" name="capacity" class="form-control" placeholder="Enter the capacity" value = "{{ old('capacity') }}" >
                    @error('capacity')
                    <div class="text-danger">{{ $message }}</div>              
                    @enderror
        
                </div>

             </div>

             <div class="mb-4 row">
                  <label class="col-md-4 col-form-label" for="food_type">Food Type <span class="text-danger">*</span></label>
                   <div class="col-md-8">
                 
                        <select id="food_type" name="food_type" class="form-control" >
                            <option selected>Select Food Type</option>
                            <option value="Veg" {{ old('food_type') == 'Veg' ? 'selected' : '' }}>Veg</option>
                            <option value = "Non-Veg" {{ old('food_type') == 'Non-Veg' ? 'selected' : '' }}>Non-Veg</option>
                            <option value = "Both" {{ old('food_type') == 'Both' ? 'selected' : '' }}>Both (Veg & Non-Veg) </option>
                        </select>
                    @error('food_type')
                    <div class="text-danger">{{ $message }}</div>              
                    @enderror
        
                </div>

             </div>
</div>
</div></div>
      </div>
           </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">Select Amenities
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">


                                         
                                    <div class="col-6" style="margin-left: 30px;">
                                        
                                         @foreach($venueamenities as $amenities)
                                         <div class="mt-3">
                                             <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $amenities->id }}" id="venueamenities" name="venueamenities[]">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                    {{ $amenities->amenities_name }}
                                                </label>
                                             </div>
                                        </div>

                                         @endforeach
                                    </div></div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                        Add Data Fields
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        
                                                    @foreach($venuedatafield as $datafield)
    @if($datafield->datafieldtype == "Text")
        <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="datafieldvalue{{ $datafield->id }}">{{ $datafield->datafieldname }}</label>
            <div class="col-md-8">
                <input type="hidden" name="datafieldid[]" value="{{ $datafield->id }}" />
                <input type="text" id="datafieldvalue{{ $datafield->id }}" name="datafieldvalue[]" class="form-control" placeholder="Enter the {{ $datafield->datafieldname }} value" value="{{ old('datafieldvalue.' . $loop->index) }}">
            </div>
        </div>

    @elseif($datafield->datafieldtype == "Select")
        @php
            $data = $datafield->datafieldvalues;
            if($data!="") {
                $jsonData = json_decode($data, true);
            }
        @endphp

        <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="datafieldvalue{{ $datafield->id }}">{{ $datafield->datafieldname }}</label>
            <div class="col-md-8">
                <input type="hidden" name="datafieldid[]" value="{{ $datafield->id }}" />
                <select class="form-select" id="datafieldvalue{{ $datafield->id }}" name="datafieldvalue[]">
                    <option selected>Select this {{ $datafield->datafieldname }}</option>
                    @foreach($jsonData as $item)
                        <option value="{{ $item['id'] }}" @if(old('datafieldvalue.' . $loop->parent->index) == $item['id']) selected @endif>{{ $item['optionname'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    @elseif($datafield->datafieldtype == "Textarea")
        <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="datafieldvalue{{ $datafield->id }}">{{ $datafield->datafieldname }}</label>
            <div class="col-md-8">
                <input type="hidden" name="datafieldid[]" value="{{ $datafield->id }}" />
                <textarea id="datafieldvalue{{ $datafield->id }}" name="datafieldvalue[]" class="form-control" placeholder="Enter the {{ $datafield->datafieldname }} value">{{ old('datafieldvalue.' . $loop->index) }}</textarea>
            </div>
        </div>

    @elseif($datafield->datafieldtype == "Radio")
        @php
            $data = $datafield->datafieldvalues;
            if($data!="") {
                $jsonData = json_decode($data, true);
            }
        @endphp

        <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="datafieldvalue{{ $datafield->id }}">{{ $datafield->datafieldname }}</label>
            <div class="col-md-8">
                <input type="hidden" name="datafieldid[]" value="{{ $datafield->id }}" />
                <div class="form-check">
                    @foreach($jsonData as $item)
                        <input class="form-check-input" type="radio" name="datafieldvalue[]" id="datafieldvalue{{ $datafield->id }}" value="{{ $item['id'] }}" @if(old('datafieldvalue.' . $loop->parent->index) == $item['id']) checked @endif>
                        <label class="form-check-label" for="datafieldvalue{{ $datafield->id }}">
                            {{ $item['optionname'] }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

    @endif
@endforeach


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                        Image <span class="text-danger">*</span>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                        <div class="mb-4 row">
                                         <label for="formFile" class="form-label">Image Uplaod</label>
                                        <input class="form-control imageUpload" type="file" id="formFile" name = "bannerimage">
                                        </div>

                                         <div id = "categoryiconimage" class="imageOutput"></div>

                                        <!--div class="mb-4 row">
                                            <label for="formFileMultiple" class="form-label">Gallery Image</label>
  <input class="form-control" type="file" id="formFileMultiple" multiple>
                                        </div-->




                                                    </div>
                                                </div>
                                            </div>
				
				<div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                                        Google Map
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                        <div class="mb-4 row">
                                         <label for="formFile" class="form-label">Google Map Location Code</label>
                                          
                                            <div class="col-md-10">
                                                  <textarea class="form-control" placeholder="Enter the venue location" id="googlemap" name = "googlemap" style="height: 100px">{{ $venue->googlemap }}</textarea>
                                              
                                            </div>
                                  

                                        </div>
								
										
                                    

                                                    </div>
                                                </div>
                                            </div>





                                        </div>









                                        <br><br>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Venue </button>
                                                </div>
                                            </div>
                                        </div>
										  </div>
        </div>   </div>
                                    </form>
                 
                </div>
</div>
</div>
</div>        



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
           type:'POST',
           url:"{{ route('venue/create/ajaxcitylist') }}",
           dataType: 'json',
           data:{ "_token": "{{ csrf_token() }}", "area_id" :area_id},
           success:function(response){     
            var returnData = response;     
            console.log($("#venuecity"));     
            $("#venuecity").val(returnData['city']);
            $("#venuestate").val(returnData['state']);
            $("#venuedistrict").val(returnData['district']);
            $("#venuepincode").val(returnData['pincode']);
            $("#locationid").val(returnData['id']);
                   
         }        
          
        });
           
     });

</script>
@endpush
