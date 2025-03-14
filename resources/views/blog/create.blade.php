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
<link rel="stylesheet" href="{{ asset('frontassets/css/tagify.css') }}" />    

<div class="mt-1 col-lg-10 col-md-10">
    <div id="all_contacts_container" class="content-section">
        <!--feature section start-->
        <section class="feature-section ptb-50 gray-light-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading text-center mb-5">
                            <h2>Blog - Let’s Begin the Adventure!</h2>
                          
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif               

                <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                                       
                  
                   
                    <div class="col-md-8">  
					
					
                        <div class="mb-3">
                            <label for="blogtitle" class="form-label">Blog Title</label>
                            <input type="text" class="form-control" id="blogtitle" name = "title" placeholder="Enter the Blog Title" value = "{{ old('title') }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Blog Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" 
                            value = "{{ old('slug') }}">
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <small id="slugFeedback" class="text-danger d-none">This slug is already taken.</small>
                        </div>
                        <div class="mb-3">
                            <label for="blogcontent" class="form-label">Blog Content</label>
                            <textarea class="form-control" id="blogcontent" placeholder="Enter the Blog Content" name="content" style="height:600px;">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
            
                                             
				 </div>
				 <div class="col-md-4">  
					  <div class="mb-3 text-center">
                      <img id="imagePreview" src="{{ asset('frontassets/img/preview.jpg') }}"  
         alt="Mangal Mall Image Preview" 
         style="width:350px"/>
					  </div>
				      <div class="mb-3">
                            <label for="blogimage" class="form-label">Banner Image</label>
                            <input class="form-control" type="file" id="blogimage" name = "image" accept="image/*">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                      </div> 
					                            
                      <div class="mb-3">
                        <label for="blogtags" class="form-label">Blog Tags</label>
                        <input type="text" id="tags" name="tags" />
                        @error('tags')
                                <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
					<div class="mb-3">
						<label for="blogimage" class="form-label">Blog Category</label>
						<select class="form-control" id="blogcategory" name = "category">
                            <option value="">Select Category</option>
							@foreach($categories as $category)
                            <option value="{{$category->id}} {{ old('category') ==  $category->id ? 'selected':''}} ">{{$category->categoryname}}</option>
                            @endforeach
						</select>
                        @error('category')
                                <div class="text-danger">{{ $message }}</div>
                        @enderror
					</div>	
					<div class="mb-3">
						<label for="blogstatus" class="form-label">Status</label>
						<select class="form-control" id="blogcategory" name ="blogstatus">
							<option value="draft" {{ old('blogstatus') ==  'draft' ? 'selected':''}} >Draft</option>							
							<option value="published" {{ old('blogstatus') ==  'published' ? 'selected':''}}>Published</option>
							<option value="rejected" {{ old('blogstatus') ==  'rejected' ? 'selected':''}}>Trash</option>						
						</select>
					</div>	
					
					 <button type="submit" class="btn btn-primary">Submit</button> 
				 </div>
                   
                   
                 </div>  
					</form>
                
                               
              </div>
                        
        </section>
    </div>
</div>
<div class="col-lg-2 col-md-2">
    @include('profile-layouts.rightside')
</div>
@endsection
@push('scripts')
<script src="{{ asset('ckeditor/js/ckeditor.js') }}"></script>
<script src="{{ asset('frontassets/js/tagify.js') }}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#blogcontent'))
        .catch(error => {
            console.error(error);
        });

    document.getElementById('blogimage').addEventListener('change', function(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;  // Update the preview image
            }
            reader.readAsDataURL(file);  // Read the uploaded file as a data URL
        }
    });


    
    
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.querySelector('#tags');
        
        var defaultTags = @json($tags->pluck('tagname')->take(4)); 

        var tagify = new Tagify(input, {
            whitelist: @json($tags->pluck('tagname')),
            dropdown: {
                maxItems: 5,
                enabled: 0, // Always show suggestions dropdown
                closeOnSelect: false
            }
        });

        // Set default tags
        tagify.addTags(defaultTags);
    });


    $(document).ready(function () {
        // Auto-generate slug from title
        $('#title').on('input', function () {
            let title = $(this).val();
            let slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#slug').val(slug);

            // Trigger uniqueness check when slug is generated
            checkSlug(slug);
        });

        // Check slug uniqueness when the user modifies the slug
        $('#slug').on('input', function () {
            let slug = $(this).val().trim();
            checkSlug(slug);
        });

        // Function to check slug uniqueness using AJAX
        function checkSlug(slug) {
            $.ajax({
                url: '{{ route("blog.check-slug") }}',  // Server endpoint to check slug
                method: 'GET',
                data: { slug: slug },
                success: function (response) {
                    if (response.exists) {
                        $('#slugFeedback').removeClass('d-none');
                    } else {
                        $('#slugFeedback').addClass('d-none');
                    }
                }
            });
        }
    });


</script>

@endpush