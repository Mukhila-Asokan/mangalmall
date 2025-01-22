@extends('admin.layouts.app-admin')
@section('content')


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Merchandiser Category</h4>
                       
                        <div class="text-end">
                         <a href = "{{ route('merchandisercategory') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Merchandiser Category List
                           </a>
                       </div>
                       <form class="form-horizontal" role="form" method="post" action="{{ route('merchandisercategory.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-6">
                                <div class="mb-4 row">
                                    <label class="col-md-4 col-form-label" for="category_name">Merchandiser Category</label>
                                    <div class="col-md-8">
                                            <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter the category name" value = "{{ old('category_name') }}" required>
                                        @if($errors->has('category_name'))
                                        <div class="text-danger">{{ $errors->first('category_name') }}</div>
                                        
                                    @endif
                                    </div>

                                </div>
                                <div class="mb-4 row">
                                    <label class="col-md-4 col-form-label" for="category_image">Category Image</label>
                                    <div class="col-md-8">
                                        <input type="file" id="category_image" name="category_image" class="form-control" accept="image/*">
                                        <div id="category_image_preview" class="mt-2"></div>
                                        @if($errors->has('category_image'))
                                            <div class="text-danger">{{ $errors->first('category_image') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label class="col-md-4 col-form-label" for="category_icon">Category Icon Image</label>
                                    <div class="col-md-8">
                                        <input type="file" id="category_icon" name="category_icon" class="form-control" accept="image/*">
                                        <div id="category_icon_preview" class="mt-2"></div>
                                        @if($errors->has('category_icon'))
                                            <div class="text-danger">{{ $errors->first('category_icon') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <br><br>
                                <div class="justify-content-end row">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Merchandiser Category</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<script>
    document.getElementById('category_image').addEventListener('change', function(event) {
        displayImagePreview(event.target, 'category_image_preview');
    });

    document.getElementById('category_icon').addEventListener('change', function(event) {
        displayImagePreview(event.target, 'category_icon_preview');
    });

    function displayImagePreview(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = ''; // Clear existing previews
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Preview';
                img.style.maxWidth = '100px';
                img.style.maxHeight = '100px';
                img.classList.add('img-thumbnail', 'mt-2');
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
