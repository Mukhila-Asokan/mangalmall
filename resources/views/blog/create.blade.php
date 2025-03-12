@extends('profile-layouts.profile')
@section('content')
<style>
   textarea {
    width: 100%;
    height: 450px;
}
.ck-content
{
    height: 450px;
    overflow-y: auto;
    overflow-x: hidden;
}

    </style>
<script src="{{ asset('ckeditor/js/ckeditor.js') }}"></script>
<div class="mt-1 col-lg-10 col-md-10">
    <div id="all_contacts_container" class="content-section">
        <!--feature section start-->
        <section class="feature-section ptb-100 gray-light-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading text-center mb-5">
                            <h2>Blog - Let’s Begin the Adventure!</h2>
                          
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">                      
                  
                    <form>
                        <div class="mb-3">
                            <label for="blogtitle" class="form-label">Blog Title</label>
                            <input type="text" class="form-control" id="blogtitle" name = "title" placeholder="Enter the Blog Title">
                        </div>
                        <div class="mb-3">
                            <label for="blogcontent" class="form-label">Blog Content</label>
                            <textarea class="form-control" id="blogcontent" placeholder="Enter the Blog Content" name="content" style="height:600px;"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="blogimage" class="form-label">Banner Image</label>
                            <input class="form-control" type="file" id="blogimage">
                        </div>                        
                <div class="mb-3">
                    <label for="blogtags" class="form-label">Blog Tags</label>
                    <input type="text" class="form-control" id="blogtags" placeholder="Enter the Blog Tags">
                </div>
                <div class="mb-3">
                    <label for="blogimage" class="form-label">Blog Category</label>
                    <select class="form-control" id="blogcategory">
                        <option value="technology">Technology</option>
                        <option value="lifestyle">Lifestyle</option>
                        <option value="education">Education</option>
                        <option value="health">Health</option>
                    </select>
                </div>
                                             
               
                   
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    </div>
                </div>
                               
              </div>
                        
        </section>
    </div>
</div>
<div class="col-lg-2 col-md-2">
    @include('profile-layouts.rightside')
</div>
@endsection
@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#blogcontent'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush