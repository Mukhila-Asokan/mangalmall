@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Card Template</h4>
            
            <div class="text-end">
                <a href = "{{ route('invitation.cardtemplate') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Card Template List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('cardtemplate.add') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="templatename">Template Name</label>
                <div class="col-md-8">
                        <input type="text" id="templatename" name="templatename" class="form-control" placeholder="Enter the template name" value = "{{ old('templatename') }}">
                        @error('templatename')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="templateurl">Template URL</label>
                <div class="col-md-8">
                        <input type="file" id="templateurl" name="templateurl" class="form-control" accept="image/*" onchange="previewImage(event)">
                        @error('templateurl')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
                        
                        <script>
                            function previewImage(event) {
                                var reader = new FileReader();
                                reader.onload = function(){
                                    var output = document.getElementById('imagePreview');
                                    output.src = reader.result;
                                    output.style.display = 'block';
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            }
                        </script>
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="occasionid">Occasion</label>
                <div class="col-md-8">
                    <select id="occasionid" name="occasionid" class="form-control">
                        <option value="">Select Occasion</option>
                        <option value="all">All</option>
                        @foreach($occasiontypes as $occasion)
                            <option value="{{ $occasion->id }}" {{ old('occasionid') == $occasion->id ? 'selected' : '' }}>{{ $occasion->eventtypename }}</option>
                        @endforeach
                    </select>
                    @error('occasionid')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Card Template</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection