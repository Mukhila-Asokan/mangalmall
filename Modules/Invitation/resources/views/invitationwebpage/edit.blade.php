@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Edit Invitation Web Page</h4>
                
                <div class="text-end">
                    <a href="{{ route('invitation.webpage') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-eye me-1"></span>Invitation Web Page List
                    </a>
                </div>
                
                <form class="form-horizontal" role="form" method="post" action="{{ route('webpage.update', $webpage->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="webpagename">Web Page Name</label>
                            <div class="col-md-8">
                                <input type="text" id="webpagename" name="webpagename" class="form-control" placeholder="Enter the Web Page name" value="{{ old('webpagename', $webpage->webpagename) }}" required>
                                @if($errors->has('webpagename'))
                                    <div class="text-danger">{{ $errors->first('webpagename') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="occasiontype">Occasion Type</label>
                            <div class="col-md-8">
                                <select id="occasiontype" name="occasiontype" class="form-control" required>
                                    <option value="">Select Occasion Type</option>
                                    @foreach($occasiontype as $occasionType)
                                        <option value="{{ $occasionType->id }}" {{ old('occasiontype', $webpage->occasion_id) == $occasionType->id ? 'selected' : '' }}>
                                            {{ $occasionType->eventtypename }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('occasiontype'))
                                    <div class="text-danger">{{ $errors->first('occasiontype') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="preview_image">Image Preview</label>
                            <div class="col-md-8">
                                <input type="file" id="preview_image" name="preview_image" class="form-control">
                                @if($errors->has('preview_image'))
                                    <div class="text-danger">{{ $errors->first('preview_image') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="imagePreview">Image Preview</label>
                            <div class="col-md-8">
                                <img id="imagePreview" src="{{ $webpage->image ? asset('storage/' . $webpage->image) : '#' }}" alt="Image Preview" style="max-width: 100%; height: auto; {{ $webpage->image ? '' : 'display: none;' }}">
                            </div>
                        </div>

                        <script>
                            document.getElementById('preview_image').addEventListener('change', function(event) {
                                const [file] = event.target.files;
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const img = document.getElementById('imagePreview');
                                        img.src = e.target.result;
                                        img.style.display = 'block';
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });
                        </script>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="pathname">Website Path</label>
                            <div class="col-md-8">
                                <input type="file" id="pathname" name="pathname" class="form-control">
                                @if($errors->has('pathname'))
                                    <div class="text-danger">{{ $errors->first('pathname') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Invitation Web Page</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection