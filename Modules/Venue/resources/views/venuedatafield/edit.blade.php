@extends('admin.layouts.app-admin')
@section('content')

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
                        <h4 class="header-title mb-4">Venue Data Field</h4>
                        <div class="text-end">
                           <a href = "{{ route('venuesettings/datafield') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>View List
                           </a>
                        </div>
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('datafield.update') }}">
                                        @csrf

                                         <input type="hidden" name="id" value="{{ $venuedatafield->id }}">
                                        <input type="hidden" name="_method" value="PUT">

                                        <div class="col-6">

                                         <div class="mb-4 row">
                                              <label class="col-md-4 col-form-label" for="datafieldtype">Select Data Field</label>
                                               <div class="col-md-8">
                                             <select class="form-select" id="datafieldtype" name="datafieldtype">

                                              

                                                <option selected>Open this Data Field</option>
                                                <option Value ="Text" {{ $venuedatafield->datafieldtype == "Text" ? 'Selected' : ''}} >Text</option>
                                                <option Value ="Select" {{ $venuedatafield->datafieldtype == 'Select' ? 'Selected' : ''}}>Select</option>
                                                <option Value ="Textarea" {{ $venuedatafield->datafieldtype == 'Textarea' ? 'Selected' : ''}}>Textarea</option>
                                                <option Value ="Radio" {{ $venuedatafield->datafieldtype == 'Radio' ? 'Selected' : ''}}>Radio</option>
                                                <option Value ="Checkbox" {{ $venuedatafield->datafieldtype == 'Checkbox' ? 'Selected' : ''}}>Checkbox</option>
                                            </select>
                                                 @if($errors->has('datafieldtype'))
                                                <div class="text-danger">{{ $errors->first('datafieldtype') }}</div>
                                                
                                            @endif
                                            </div>

                                         </div>   


                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuetypename">Venue Datafield Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="datafieldname" name="datafieldname" class="form-control" placeholder="Enter the Venue Datafield name" value = "{{ $venuedatafield->datafieldname }}" required>
                                                @if($errors->has('datafieldname'))
                                                <div class="text-danger">{{ $errors->first('datafieldname') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>

                                        
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="datafieldnametype">Datafield Name Units</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="datafieldnametype" name="datafieldnametype" class="form-control" placeholder="Enter the Venue Datafield Unit name" value = "{{ $venuedatafield->datafieldnametype }}" required>
                                                @if($errors->has('datafieldnametype'))
                                                <div class="text-danger">{{ $errors->first('datafieldnametype') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>

                                        
                                      </div>


                                              <div class="col-6">
                                                <div class="mb-4 col-2"><button type="button" class="btn btn-success waves-effect waves-light rowAdder"><i class="mdi mdi-plus"></i></button> </div>
                                               
                                            </div>

                                       @php

                                                $data = $venuedatafield->datafieldvalues;

                                                if($data!="")
                                                {
                                                $jsonData = json_decode($data, true); 
                                                $j = 1;
                                                foreach($jsonData as $item):
                                                   
                                        @endphp
                                        

                                              <div class="displayrow">
                                            <div class="row">
                                            <div class="col-6">
                                                <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="optionname">Option {{ $j }}</label>
                                                <div class="col-md-8">
                                                    <input type = "hidden" name ="optionid[]" value="{{ $item['id'] }}" >
                                                      <input type="text" id="optionname" name="optionname[]" class="form-control" placeholder="Enter the Option name" value = "{{ $item['optionname'] }}">
                                                
                                                </div>

                                            </div>
                                            </div>
                                            
                                          </div>
                                        </div>

                                      

                                        @php            



                                                    $j++;
                                                endforeach;
                                                }
                                                
                                            @endphp

                                                <div class="addnewinputrow">
                                      </div>
                                        <br><br>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update Datafield</button>
                                                </div>
                                            </div>
                                      
                                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
   


      $(".rowAdder").click(function () {   

      alert("haoi");     
            newRowAdd =
                '<div class="row divrow"> <div class="col-6"> <div class="mb-4 row"> <label class="col-md-4 col-form-label" for="optionname"> Option  </label><div class="col-md-8"> <input type="text" name="optionnamenew[]" class="form-control optionname" placeholder="Enter the Option name" value="" > </div></div></div><div class="col-6"><div class="mb-4 col-2"><button type="button" class="btn btn-danger waves-effect waves-light DeleteRow"><i class="mdi mdi-trash-can"></i></button></div></div></div>';
                
            $('.addnewinputrow').append(newRowAdd);
        });
        $("body").on("click", ".DeleteRow", function () {
            $(this).parents(".divrow").remove();
           
        });


        $("#datafieldtype").on('change',function () { 
            var datafieldtype = $(this).val();           
            if(datafieldtype != "Text" && datafieldtype != 'Textarea')
            {
             
                $('.addnewinputrow').html("");
                $(".displayrow").css("display", "block"); 
            }
            else
            {
                $('.addnewinputrow').html("");
                $(".displayrow").css("display", "none"); 
            }
        });
    });
</script>
@endpush