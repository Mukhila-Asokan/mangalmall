@extends('admin.layouts.app-admin')
@section('content')
<style type="text/css">
textarea {
    width: 100%;
    height: 250px;
}
.ck-content
{
    height: 250px;
    overflow-y: auto;
    overflow-x: hidden;
}

</style>
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Edit Subscription Plan</h4>
            
            <div class="text-end">
                <a href = "{{ route('subcriptionplan') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Subscription Plan List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('subcriptionplan.plan_update', $plan->id) }}">
            @csrf
            @method('PUT')
            <div class="col-12">
            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="name">Name</label>
                <div class="col-md-8">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter the plan name" value = "{{ old('name', $plan->name) }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="description">Description</label>
                <div class="col-md-8">
                        <textarea id="description" name="description" class="form-control" placeholder="Enter the plan description">{{ old('description', $plan->description) }}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="price">Price</label>
                <div class="col-md-8">
                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter the plan price" value = "{{ old('price', $plan->price) }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="duration">Duration</label>
                <div class="col-md-8">
                        <input type="text" id="duration" name="duration" class="form-control" placeholder="Enter the plan duration in month" value = "{{ old('duration', $plan->duration) }}">
                        @error('duration')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Subscription Plan</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
       ClassicEditor.create(document.querySelector('#description')).catch(error => {
            console.error(error);
        });
</script>
@endpush