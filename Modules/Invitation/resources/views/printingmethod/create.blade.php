@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Printing Method</h4>
            
            <div class="text-end">
                <a href = "{{ route('invitation.printingmethod') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Printing Method List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('printingmethod.add') }}">
            @csrf
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="printingmethod">Printing Method Name</label>
                <div class="col-md-8">
                        <input type="text" id="printingmethod" name="printingmethod" class="form-control" placeholder="Enter the printing Method name" value = "{{ old('printingmethod') }}">
                        @error('printingmethod')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>

            </div>
            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Printing Method</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection