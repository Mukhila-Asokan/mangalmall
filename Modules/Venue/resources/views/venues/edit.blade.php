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
    #venuearea-selectized
    {
        width:100% !important;
        border:none !important;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Edit Venue</h4>

                <div class="text-end">
                    <a href="{{ route('venue/index') }}" class="btn btn-primary">
                        <span class="tf-icon mdi mdi-eye me-1"></span> Venue List
                    </a>
                </div>

                <form action="{{ route('venue.update', $venue->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="accordion accordion-flush" id="accordionFlushExample">

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
                                            <div class="mb-4">
                                                <label class="form-label">Venue Name</label>
                                                <input type="text" name="venuename" class="form-control" value="{{ $venue->venuename }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Venue Location</label>
                                                <textarea name="venueaddress" class="form-control" required>{{ $venue->venueaddress }}</textarea>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Area</label>



                                                <select id="venuearea" name="venuearea" placeholder="Enter the Area name" class="form-select">
                                                  <option value="{{ $venue->locationid }}" selected>{{ $venue->locationid }}</option> 
                                                    </select>

                                                    @error('locationid')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror


                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-4">
                                                <label class="form-label">City</label>
                                                <input type="text" name="venuecity" class="form-control" value="{{ $venue->indianlocation->City }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">State</label>
                                                <input type="text" name="venuestate" class="form-control" value="{{ $venue->indianlocation->State }}" required>
                                            </div>
                                            <br>
                                            <div class="mb-4">
                                                <label class="form-label">Pincode</label>
                                                <input type="text" name="venuepincode" class="form-control" value="{{ $venue->indianlocation->Pincode }}" required>
                                            </div>
                                        </div>
                                    </div>
									
									
                                    <div class="mb-4 row">
                                            <label class="col-md-2 col-form-label" for="description">Description</label>
                                            <div class="col-md-10">
                                                  <textarea class="form-control" placeholder="Enter the descritption about venue" id="description" name = "description" style="height: 100px">{{ $venue->description }}</textarea>
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
                                                  <input type="text" id="contactperson" name="contactperson" class="form-control" placeholder="Enter the Contact person name" value = "{{ $venue->contactperson }}" required>
                                                @error('contactperson')
                                                <div class="text-danger">{{ $message }}</div>              
                                            @enderror
                                            </div>
                                        </div> 
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactmobile">Mobile No</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactmobile" name="contactmobile" class="form-control" placeholder="Enter the Contact Mobile No" value = "{{ $venue->contactmobile }}" required>
                                               @error('contactmobile')
                                                <div class="text-danger">{{ $message }}</div>              
                                            @enderror
                                            </div>
                                        </div> 
                                        

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contacttelephone">Telephone No</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contacttelephone" name="contacttelephone" class="form-control" placeholder="Enter the Venue Telephone No" value = "{{ $venue->contacttelephone }}" >
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
                                                  <input type="text" id="contactemail" name="contactemail" class="form-control" placeholder="Enter the Contact Email Id" value = "{{ $venue->contactemail }}" >
                                              @error('contactemail')
													<div class="text-danger">{{ $message }}</div>              
												@enderror
                                            </div>
                                        </div> 

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactemail">Website</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="websitename" name="websitename" class="form-control" placeholder="Enter the websitename" value = "{{ $venue->websitename }}" >
                                                @error('websitename')
													<div class="text-danger">{{ $message }}</div>              
												@enderror
                                            </div>
                                        </div> 

                                        </div>
                                        </div>
									
									
									
							
						
						<div class ="row">
    <div class="col-6">
             <div class="mb-4 row">
                  <label class="col-md-4 col-form-label" for="venuetypeid">Select Venue Type</label>
                   <div class="col-md-8">
                 <select class="form-select" id="venuetypeid" name="venuetypeid" aria-label="Floating label select example">
                                <option selected>Open this Venue Type</option>
                                @foreach($venuetypes as $type)
                                <option value = "{{ $type->id }}" {!! ($type->id == $venue->venuetypeid) ? 'Selected' : '' !!} >{{ $type->venuetype_name }}</option>
                                @endforeach
                            </select>
                     @if($errors->has('venuetypeid'))
                    <div class="text-danger">{{ $errors->first('venuetypeid') }}</div>
                    
                @endif
                </div>

             </div>   
</div>
    <div class="col-6">
           <div class="mb-4 row">
                  <label class="col-md-4 col-form-label" for="venuesubtypeid">Select Venue Subtype</label>
                   <div class="col-md-8">
                 <select class="form-select" id="venuesubtypeid" name="venuesubtypeid" aria-label="Floating label select example">
                    <option value = "{{ $venue->venuetsubtype->id}}" selected>{{ $venue->venuetsubtype->venuetype_name}}</option>
                  </select>
                     @if($errors->has('venuesubtypeid'))
                    <div class="text-danger">{{ $errors->first('venuesubtypeid') }}</div>
                    
                @endif
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
									
                                    @foreach($venuedatafield as  $index => $datafield)
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
                                    Google Map & Budget
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="mb-4">
                                        <label class="form-label">Google Map Location Code</label>
                                        <textarea name="googlemap" class="form-control">{{ $venue->googlemap }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Booking Rate</label>
                                        <input type="text" name="bookingprice" class="form-control" value="{{ $venue->bookingprice }}" required>
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


<?php 
    $areaContent = ''; 

    foreach ($arealocation as $key => $area) {
        $areaContent .= '{id: '.$area['id'].', title: "' . $area['Areaname'] . '"},'; 
    }

    // Remove the trailing comma
    $areaContent = rtrim($areaContent, ','); 

   
?>



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
<script src="{{ asset('adminassets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<script type="text/javascript">
    
  

    $('#venuearea').selectize({
 
  valueField: 'id',
  labelField: 'title',
  searchField: 'title',
  options: [<?PHP echo $areaContent; ?> 
  ],
  create: false
});

var selectize = $select[0].selectize;
selectize.setValue("{{ $venue->locationid }}");


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
            $("#venuecity").val(returnData[0]['City']);
            $("#venuestate").val(returnData[0]['State']);
            $("#venuepincode").val(returnData[0]['Pincode']);
            $("#locationid").val(returnData[0]['id']);
                   
         }        
          
        });
           
     });



      $("#venuetypeid").change(function(e) {


      
        e.preventDefault();   
        var venuetypeid = $(this).val();

        $.ajax({
           type:'POST',
           url:"{{ route('venue/create/ajaxcvenuesubtypelist') }}",
           dataType: 'json',
           data:{ "_token": "{{ csrf_token() }}", "venuetypeid" :venuetypeid},
           success:function(response){  
            $("#venuesubtypeid").empty();   
            var returnData = response;   
            if(returnData.length>0)
            {
                let casestr = '<option>Select Venue Sub Type</option>';
                for(i=0;i<returnData.length;i++)
                {
                    casestr  += '<option value = "' + returnData[i]['id'] + ' ">' + returnData[i]['venuetype_name'] + '</option>';
                }
             console.log(casestr);       
           
             $("#venuesubtypeid").append(casestr);
            }
            else
            {
                alert("No Data")
            }
         }        
          
        });
           
     });







</script>
@endpush
