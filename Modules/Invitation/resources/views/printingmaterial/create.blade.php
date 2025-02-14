@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Printing Material</h4>
            
            <div class="text-end">
                <a href = "{{ route('invitation.printingmaterial') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Printing Material List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('printingmaterial.add') }}">
            @csrf
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="printingmaterialname">Printing Material Name</label>
                <div class="col-md-8">
                        <input type="text" id="printingmaterialname" name="printingmaterialname" class="form-control" placeholder="Enter the printing material name" value = "{{ old('printingmaterialname') }}">
                        @error('printingmaterialname')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>

            </div>
            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Printing Material</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection