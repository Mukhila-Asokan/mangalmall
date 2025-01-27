@extends('admin.layouts.app-admin')
@section('content')
<style type="text/css">
    
 
    .imageOutput img
    {
        width:200px;
        height:auto;
    }
</style>
 <link href="{{ asset('public/adminassets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
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
                         <a href = "{{ route('admin/themebuilder') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                             <span class="tf-icon mdi mdi-eye me-1"></span>Theme Builder List
                           </a>
                        </div>
                  
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('venue.themebuilder_add') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-6">


                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="themename">Theme Builder Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="themename" name="themename" class="form-control" placeholder="Enter the venue Theme name" value = "{{ old('themename') }}" required>
                                                @if($errors->has('themename'))
                                                <div class="text-danger">{{ $errors->first('themename') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>


                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="theme_zipfile">Theme Path</label>
                                            <div class="col-md-8">
                                                  <input type="file"  id="theme_zipfile" name="theme_zipfile" class="form-control" required>
                                                @if($errors->has('theme_zipfile'))
                                                <div class="text-danger">{{ $errors->first('theme_zipfile') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>


                                        <div class="mb-4 row">
                                              <label class="col-md-4 col-form-label" for="theme_type">Theme Option</label>
                                               <div class="col-md-8">
                                             <select class="form-select" id="theme_type" name="theme_type" aria-label="Select Theme Type">
                                                    <option selected>Select Theme type</option>
                                                    <option value = "1">One Page</option>
                                                    <option value = "2">Multi Page</option>     
                                              </select>
                                                 @if($errors->has('theme_type'))
                                                <div class="text-danger">{{ $errors->first('theme_type') }}</div>
                                                
                                            @endif
                                            </div>

                                         </div>   

                                           <div class="mb-4 row">
                                         <label for="formFile" class="col-md-4 col-form-label">Preview Image Uplaod</label>
                                         <div class="col-md-8">
                                        <input class="form-control imageUpload" type="file" id="formFile" name = "preview_image">
                                    </div>
                                        </div>

                                         <div id = "categoryiconimage" class="imageOutput"></div>





                                        <br><br>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Theme Bulider </button>
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
@endpush
