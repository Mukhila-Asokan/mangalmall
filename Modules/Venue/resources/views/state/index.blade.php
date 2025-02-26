@extends('admin.layouts.app-admin')

@section('content')
<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">List of State</h4>
                         
                        <div class="row  mt-4">
                <div class="col-6">
                                 <a href = "{{ route('venuesettings') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-arrow-left-thick me-1"></span>Back
                           </a>
                             </div>            

                <div class="col-6 text-end">   
                        <a href = "{{ route('venue.state/create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-plus me-1"></span>Add
                           </a>
                        </div>
                        </div>

                         <div class="table-responsive">
                             
    <table class="table table-bordered table-hover mb-4">
        <thead class="table-dark">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">State Name</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @if(count($states) > 0)
        @php
    $start = ($states->currentPage() - 1) * $states->perPage() + 1;
@endphp
            @foreach($states as $state)
            <tr>
                <td>{{ $start++ }}</td>
                <td>{{ $state->statename }}</td>
                <td>@if($state->status == 'Active')
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $state->id }}" title="Active"><i class="fa fa-eye action_icon"></i></button>
                @else 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="{{ $state->id }}" title="Inactive"><i class="fa fa-eye-slash action_icon"></i></button>
                @endif
                <a href="{{ url('/admin/state/'.$state->id.'/edit') }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
                </a>
                 <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="{{ $state->id }}" title="Delete"  >
                    <i class="fa fa-trash action_icon"></i>
                </button>
           </td>
                                   
              
            </tr>

            @endforeach
            </tbody>
            </table>
            {{ $states->links('pagination::bootstrap-4') }}
            
            
            @else
                No Records Found
        @endif
       
</div>
</div> 
                    </div>
                </div>
            </div>
@endsection
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/state/') }}">  