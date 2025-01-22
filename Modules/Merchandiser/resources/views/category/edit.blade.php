@extends('admin.layouts.app-admin')
@section('content')

<!-- start page title -->
        
        <!-- end page title -->

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Update Merchandiser Category</h4>
                       
                        <div class="text-end">
                         <a href = "{{ route('merchandisercategory') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Merchandiser Category List
                           </a>
                       </div>
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('merchandisercategory.update', $merchant->id) }}" enctype="multipart/form-data">
                                        @csrf
                                         <input type="hidden" name="id" value="{{ $merchant->id }}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="col-6">
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="category_name">Merchandiser Category</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter the category name" value = "{{ $merchant->category_name }}" required>
                                                @if($errors->has('category_name'))
                                                <div class="text-danger">{{ $errors->first('category_name') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>
                                        <!-- Category Icon Preview -->
<div class="mb-4 row">
    <label class="col-md-4 col-form-label" for="category_icon">Category Icon Image</label>
    <div class="col-md-8">
        <div id="category_icon_preview">
            @if($merchant->category_icon)
                <img src="{{ $merchant->category_icon }}" alt="Category Icon" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;">
            @else
                <p>No icon image available</p>
            @endif
        </div>
        <input type="file" id="category_icon" name="category_icon" class="form-control" accept="image/*">
        @if($errors->has('category_icon'))
            <div class="text-danger">{{ $errors->first('category_icon') }}</div>
        @endif
    </div>
</div>

<!-- Category Image Preview -->
<div class="mb-4 row">
    <label class="col-md-4 col-form-label" for="category_image">Category Image</label>
    <div class="col-md-8">
        <div id="category_image_preview">
            @if($merchant->category_image)
                <img src="{{ $merchant->category_image }}" alt="Category Image" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;">
            @else
                <p>No image available</p>
            @endif
        </div>
        <input type="file" id="category_image" name="category_image" class="form-control" accept="image/*">
        @if($errors->has('category_image'))
            <div class="text-danger">{{ $errors->first('category_image') }}</div>
        @endif
    </div>
</div>
                                        <br><br>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                                </div>
                                            </div>
                                        </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
    // Preview new image when the user updates the input for Category Icon
    document.getElementById('category_icon').addEventListener('change', function(event) {
        updateImagePreview(event.target, 'category_icon_preview');
    });

    // Preview new image when the user updates the input for Category Image
    document.getElementById('category_image').addEventListener('change', function(event) {
        updateImagePreview(event.target, 'category_image_preview');
    });

    function updateImagePreview(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = ''; // Clear existing preview
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Preview';
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.marginBottom = '10px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
