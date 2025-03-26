@extends('profile-layouts.profile')
@section('content')
    <div class="mt-1 col-lg-10 col-md-10">
        <div class="row">
            @include('profile-layouts.sticky')
            <div class="col-lg-11 col-md-11 stickymenucontent">  
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h4 class="text-center"> {{ $event->occasion_name }} Checklist</h4>
                    </div>
                    <form action="{{ route('home.gallery.create') }}" method="post" enctype="multipart/form-data" id="form-upload">
                        @csrf
                        <input type="hidden" name="id" value="{{ $eventId }}">
                        <div class="form-group mt-3">
                            <label for="">Upload Event Images</label>
                            <input type="file" class="form-control" name="images[]" multiple id="upload-img" />
                        </div>
                        <div class="img-thumbs" id="img-preview">
                            @foreach($event->occasionGallery as $gallery)
                                <div class="wrapper-thumb" data-id="{{ $gallery->id }}">
                                    <img src="{{ asset('storage/'.$gallery->gallery_image) }}" class="img-preview-thumb">
                                    <span class="remove-btn existing-remove" data-id="{{ $gallery->id }}">x</span>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var imgUpload = document.getElementById("upload-img"),
            imgPreview = document.getElementById("img-preview"),
            selectedFiles = [];

        imgUpload.addEventListener("change", function (event) {
            let files = Array.from(event.target.files);
            imgPreview.classList.remove("img-thumbs-hidden");

            files.forEach((file, index) => {
                let wrapper = document.createElement("div");
                wrapper.classList.add("wrapper-thumb");

                let removeBtn = document.createElement("span");
                removeBtn.classList.add("remove-btn");
                removeBtn.textContent = "x";

                let img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.classList.add("img-preview-thumb");

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                imgPreview.appendChild(wrapper);

                // Store file in array
                selectedFiles.push(file);

                // Remove image on click
                removeBtn.addEventListener("click", function () {
                    let indexToRemove = selectedFiles.indexOf(file);
                    if (indexToRemove > -1) {
                        selectedFiles.splice(indexToRemove, 1);
                    }
                    wrapper.remove();
                    updateFileInput();
                });
            });

            updateFileInput();
        });

        function updateFileInput() {
            let newFileList = new DataTransfer();
            selectedFiles.forEach((file) => newFileList.items.add(file));
            imgUpload.files = newFileList.files;
        }

        $(document).on('click', '.existing-remove', function () {
            let imageId = $(this).data('id');
            let imageWrapper = $(this).closest('.wrapper-thumb');

            $.ajax({
                url: "{{ route('home.gallery.delete') }}",
                type: "POST",
                data: { id: imageId, _token: "{{ csrf_token() }}" },
                success: function (response) {
                    if (response.status == 'success') {
                        imageWrapper.remove();
                    } else {
                        alert('Error deleting image!');
                    }
                }
            });
        });
    });

</script>
@endpush
