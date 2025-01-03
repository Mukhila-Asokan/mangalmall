@extends('admin.layouts.app-admin')
@section('content')
<style type="text/css">
    
    .form-check-input[type=checkbox]
    {
        border:1px solid black;
    }
</style>

<!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">{!! $pagetitle !!}</h4>
                </div>
                <div class="col-lg-6">
                   <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $pageroot }}</a></li>
                        <li class="breadcrumb-item active">{!! $pagetitle !!}</li>
                    </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Venue</h4>
                       
                        <div class="text-end">
                         <a href = "{{ route('venue/show') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Venue List
                           </a>
                        </div>
                  
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('venuetype.venuetype_add') }}">
                                        @csrf
                                        <div class="col-12">

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
                                                  <input type="text" id="venuetype_name" name="venuetype_name" class="form-control" placeholder="Enter the venue name" value = "{{ old('venuetype_name') }}" required>
                                                @if($errors->has('venuetype_name'))
                                                <div class="text-danger">{{ $errors->first('venuetype_name') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>
                                         <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuelocation">Venue Location</label>
                                            <div class="col-md-8">
                                                  

                                                 <textarea class="form-control" placeholder="Enter the venue location" id="venuelocation" style="height: 100px">{{ old('venuelocation') }}</textarea>
                                                  @if($errors->has('venuelocation'))
                                                <div class="text-danger">{{ $errors->first('venuelocation') }}</div>
                                                 @endif


                                            </div>

                                        </div>
                                          <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuearea">Area</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuearea" name="venuearea" class="form-control" placeholder="Enter the Area name" value = "{{ old('venuearea') }}" required>
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
                                                  <textarea class="form-control" placeholder="Enter the venue location" id="description" style="height: 100px">{{ old('description') }}</textarea>
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
                                                  <input type="text" id="websitename" name="contactemail" class="form-control" placeholder="Enter the Contact Email" value = "{{ old('contactemail') }}" required>
                                                @if($errors->has('contactemail'))
                                                <div class="text-danger">{{ $errors->first('contactemail') }}</div>              
                                            @endif
                                            </div>
                                        </div> 

                                        </div>
                                        </div>

<div class ="row">
    <div class="col-6">
             <div class="mb-4 row">
                  <label class="col-md-4 col-form-label" for="venuetypename">Select Venue Type</label>
                   <div class="col-md-8">
                 <select class="form-select" id="roottype" name="roottype" aria-label="Floating label select example">
                                <option selected>Open this Venue Type</option>
                                @foreach($venuetypes as $type)
                                <option value = "{{ $type->id }}">{{ $type->venuetype_name }}</option>
                                @endforeach
                            </select>
                     @if($errors->has('venuetype_name'))
                    <div class="text-danger">{{ $errors->first('venuetype_name') }}</div>
                    
                @endif
                </div>

             </div>   
</div>
    <div class="col-6">
           <div class="mb-4 row">
                  <label class="col-md-4 col-form-label" for="venuetypename">Select Venue Subtype</label>
                   <div class="col-md-8">
                 <select class="form-select" id="roottype" name="roottype" aria-label="Floating label select example">
                    <option selected>Open this Venue Subtype</option>
                  </select>
                     @if($errors->has('venuetype_name'))
                    <div class="text-danger">{{ $errors->first('venuetype_name') }}</div>
                    
                @endif
                </div>

             </div>
</div>
</div>


                                     </div>
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
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
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
                                                        @if($datafield->datafieldtype == "Text" && $datafield->datafieldtype == "Textarea")
                                                             <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="extradatafield">{{ $datafield->datafieldname }}</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="extradatafield" name="extradatafield[]" class="form-control" placeholder="Enter the {{ $datafield->datafieldname }} value" value = "{{ old('extradatafield') }}" required>
                                                @if($errors->has('extradatafield'))
                                                <div class="text-danger">{{ $errors->first('extradatafield') }}</div>
                                            </div>
                                            </div>
                                                @else if($datafield->datafieldtype == "Select"):

                                                   <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="extradatafield">{{ $datafield->datafieldname }}</label>
                                            <div class="col-md-8">
                                                  


                                                  <input type="text" id="extradatafield" name="extradatafield[]" class="form-control" placeholder="Enter the {{ $datafield->datafieldname }} value" value = "{{ old('extradatafield') }}" required>
                                                
                                                @if($errors->has('extradatafield'))
                                                <div class="text-danger">{{ $errors->first('extradatafield') }}

                                                </div>
                                            </div>
                                            </div>

                                            @else    

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
                                                    <div class="accordion-body">Yes, We will update the Scoxe regularly. All the
                                                        future updates would be available without any cost</div>
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
                                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
