@extends('venueadmin::layouts.admin-layout')
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
</style>
 <link href="{{ asset('adminassets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
 <div class="col-12">
 
  <div class="card">
	<div class="card-header text-bg-primary">
	  <h4 class="mb-0 text-white">Fill up the form</h4>
	</div>
 
 
<form class="form-horizontal" role="form" method = "post" action="{{ route('venueadmin/venueadd') }}" enctype="multipart/form-data">
                                        @csrf
    <div class="col-12 mt-5">
	
	
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
                                <label class="col-md-4 col-form-label" for="venuetypename">Venue Name</label>
                                <div class="col-md-8">
                                        <input type="text" id="venuename" name="venuename" class="form-control" placeholder="Enter the venue name" value = "{{ old('venuename') }}" required>
                                    @if($errors->has('venuename'))
                                    <div class="text-danger">{{ $errors->first('venuename') }}</div>
                                    
                                @endif
                                </div>

                            </div>
                                <div class="mb-4 row">
                                <label class="col-md-4 col-form-label" for="venueaddress">Venue Location</label>
                                <div class="col-md-8">
                                        

                                        <textarea class="form-control" placeholder="Enter the venue location" id="venueaddress" name = "venueaddress" style="height: 100px">{{ old('venueaddress') }}</textarea>
                                        @if($errors->has('venueaddress'))
                                    <div class="text-danger">{{ $errors->first('venuelocation') }}</div>
                                        @endif


                                </div>

                    </div>
                        <div class="mb-4 row">
                        <label class="col-md-4 col-form-label" for="venuearea">Area</label>
                        <div class="col-md-8">
                                <select id="venuearea" name="venuearea"  placeholder="Enter the Area name" required></select>
                            @if($errors->has('venuearea'))
                            <div class="text-danger">{{ $errors->first('venuearea') }}</div>
                            
                        @endif
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label" for="venuecity">City</label>
                        <div class="col-md-8">
                            <input type = "hidden" name = "locationid" id = "locationid" value = "" />
                                <input type="text" id="venuecity" name="venuecity" class="form-control" placeholder="Enter the city name" value = "{{ old('venuecity') }}" required>
                            @if($errors->has('venuecity'))
                            <div class="text-danger">{{ $errors->first('venuecity') }}</div>
                            
                        @endif
                        </div>
                    </div>


                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label" for="venuestate">State</label>
                        <div class="col-md-8">
                                <input type="text" id="venuestate" name="venuestate" class="form-control" placeholder="Enter the state name" value = "{{ old('venuestate') }}" required>
                            @if($errors->has('venuestate'))
                            <div class="text-danger">{{ $errors->first('venuestate') }}</div>              
                        @endif
                        </div>
                    </div> 

                    <div class="mb-4 row">
                    <label class="col-md-4 col-form-label" for="venuepincode">Pincode</label>
                    <div class="col-md-8">
                            <input type="text" id="venuepincode" name="venuepincode" class="form-control" placeholder="Enter the pincode name" value = "{{ old('venuepincode') }}" required>
                        @if($errors->has('venuepincode'))
                        <div class="text-danger">{{ $errors->first('venuepincode') }}</div>              
                    @endif
                    </div>
                </div> 

            </div> 

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="description">Description</label>
                <div class="col-md-10">
                        <textarea class="form-control" placeholder="Enter the venue location" id="description" name = "description" style="height: 100px">{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                        @endif
                </div>
        </div>


        <div class="row">
            <div class="col-6">
                    <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="contactperson">Contact Person</label>
                <div class="col-md-8">
                        <input type="text" id="contactperson" name="contactperson" class="form-control" placeholder="Enter the Contact person name" value = "{{ old('contactperson') }}" required>
                    @if($errors->has('contactperson'))
                    <div class="text-danger">{{ $errors->first('contactperson') }}</div>              
                @endif
                </div>
            </div> 
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="contactmobile">Mobile No</label>
                <div class="col-md-8">
                        <input type="text" id="contactmobile" name="contactmobile" class="form-control" placeholder="Enter the Contact Mobile No" value = "{{ old('contactmobile') }}" required>
                    @if($errors->has('contactmobile'))
                    <div class="text-danger">{{ $errors->first('contactmobile') }}</div>              
                @endif
                </div>
            </div> 
            

            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="contacttelephone">Telephone No</label>
                <div class="col-md-8">
                        <input type="text" id="contacttelephone" name="contacttelephone" class="form-control" placeholder="Enter the Venue Telephone No" value = "{{ old('contacttelephone') }}" required>
                    @if($errors->has('contacttelephone'))
                    <div class="text-danger">{{ $errors->first('contacttelephone') }}</div>              
                @endif
                </div>
            </div> 

            </div>
            <div class="col-6">

            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="contactemail">Email Id</label>
                <div class="col-md-8">
                        <input type="text" id="contactemail" name="contactemail" class="form-control" placeholder="Enter the Contact Email Id" value = "{{ old('contactemail') }}" required>
                    @if($errors->has('contactemail'))
                    <div class="text-danger">{{ $errors->first('contactemail') }}</div>              
                @endif
                </div>
            </div> 

            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="contactemail">Website</label>
                <div class="col-md-8">
                        <input type="text" id="websitename" name="websitename" class="form-control" placeholder="Enter the Contact Email" value = "{{ old('websitename') }}" required>
                    @if($errors->has('websitename'))
                    <div class="text-danger">{{ $errors->first('websitename') }}</div>              
                @endif
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
                                <option value = "{{ $type->id }}">{{ $type->venuetype_name }}</option>
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
                    <option selected>Open this Venue Subtype</option>
                  </select>
                     @if($errors->has('venuesubtypeid'))
                    <div class="text-danger">{{ $errors->first('venuesubtypeid') }}</div>
                    
                @endif
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
                                                <input type="hidden" name = "datafieldid[]" value = "{{ $datafield->id }}" />
                                                  <input type="text" id="datafieldvalue{{ $datafield->id }}" name="datafieldvalue[]" class="form-control" placeholder="Enter the {{ $datafield->datafieldname }} value" value = "{{ old('datafieldvalue.$datafield->id') }}" >
                                             
                                            </div>
                                            </div>

                                             @elseif($datafield->datafieldtype == "Select")

                                             @php
                                             $data = $datafield->datafieldvalues;

                                                if($data!="")
                                                {
                                                    $jsonData = json_decode($data, true); 
                                               
                                                @endphp


                                                   <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="datafieldvalue">{{ $datafield->datafieldname }}</label>
                                            <div class="col-md-8">
                                                  <input type="hidden" name = "datafieldid[]" value = "{{ $datafield->id }}" /> 
                                                  <select class="form-select" id="datafieldvalue{{ $datafield->id }}" name="datafieldvalue[]">

                                                    <option selected>Select this {{ $datafield->datafieldname }}</option>

                                                     @foreach($jsonData as $item)
                                                     <option value="{{ $item['id'] }}">{{ $item['optionname'] }}</option>
                                                     @endforeach

                                                  </select>


                                                
                                               
                                                </div>
                                            </div>
                                           @php

                                            }
                                                
                                            @endphp

                                            @elseif($datafield->datafieldtype == "Textarea")

                                             <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="extradatafield">{{ $datafield->datafieldname }}</label>
                                            <div class="col-md-8">
                                                 <input type="hidden" name = "datafieldid[]" value = "{{ $datafield->id }}" />
                                                  <textarea id="datafieldvalue{{ $datafield->id }}" name="datafieldvalue[]" class="form-control" placeholder="Enter the {{ $datafield->datafieldname }} value">{{ old('datafieldvalue.$datafield->id') }}</textarea>
                                             
                                            </div>
                                            </div>

                                            @elseif($datafield->datafieldtype == "Radio")

                                            @php
                                             $data = $datafield->datafieldvalues;

                                                if($data!="")
                                                {
                                                    $jsonData = json_decode($data, true); 
                                               
                                                @endphp

                                            <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="extradatafield">{{ $datafield->datafieldname }}</label>
                                            <div class="col-md-8">
                                                 <input type="hidden" name = "datafieldid[]" value = "{{ $datafield->id }}" />
                                                 <div class="form-check">
                                                    @foreach($jsonData as $item)

                                                        <input class="form-check-input" type="radio" name="datafieldvalue[]" id="datafieldvalue{{ $datafield->id }}" value = "{{ $item['id'] }}">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            {{ $item['optionname'] }}
                                                        </label>
                                                     @endforeach
                                                 </div>
                                                
                                            </div>
                                             @php

                                            }
                                                
                                            @endphp

                                            @else
                                               
                                            @php
                                             $data = $datafield->datafieldvalues;

                                                if($data!="")
                                                {
                                                    $jsonData = json_decode($data, true); 
                                               
                                                @endphp

                                            <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="extradatafield">{{ $datafield->datafieldname }}</label>
                                            <div class="col-md-8">
                                                 <input type="hidden" name = "datafieldid[]" value = "{{ $datafield->id }}" />
                                                 <div class="form-check">
                                                    @foreach($jsonData as $item)

                                                         <input class="form-check-input" type="checkbox" value="{{ $item['id'] }}" name = "datafieldvalue[]"id="datafieldvalue{{ $datafield->id }}">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            {{ $item['optionname'] }}
                                                        </label>
                                                     @endforeach
                                                    </div>
                                                 
                                              
                                            </div>
                                             @php

                                            }
                                                
                                            @endphp

                                            @endif
                                        
                                            @endforeach


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                        Image
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


								<div class="mb-4 row">
                                <label class="col-md-2 col-form-label" for="googlemap">Google Map </label>
                                <div class="col-md-8">
                                        
                                        <textarea class="form-control" placeholder="Enter the venue location" id="googlemap" name = "googlemap" style="height: 100px">{{ old('googlemap') }}</textarea>
                                        @if($errors->has('googlemap'))
                                    <div class="text-danger">{{ $errors->first('googlemap') }}</div>
                                        @endif


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
	</div>
</div>
</form>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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