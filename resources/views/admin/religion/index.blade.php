@extends('admin.layouts.app-admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-2">Religion</h4>
                 
                <div class="text-end">   
                    <a href="{{ route('religion.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-plus me-1"></span>Add
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Religion Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($religions) > 0)
                        @php $i=1; @endphp
                            @foreach($religions as $religion)
                            <tr>
                                <td>{{ $religion->id }}</td>
                                <td>{{ $religion->religionname }}</td>
                                <td>
                                    @if($religion->status == 'Active')
                                        <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $religion->id }}" title="Active Status"><i class="fa fa-eye action_icon"></i></button>
                                    @else 
                                        <button type="button" class="btn-info btn statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $religion->id }}" title="inactive Status"><i class="fa fa-eye-slash action_icon"></i></button>
                                    @endif
                                    <a href="{{ url('/admin/religion/'.$religion->id.'/edit') }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i></a>
                                    <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="{{ $religion->id }}" title="Delete"><i class="fa fa-trash action_icon"></i></button>
                                </td>
                            </tr>
                            @endforeach
                            {{ $religions->links('pagination::bootstrap-4') }}
                        @else
                            No Records Found
                        @endif
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection

<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/religion/') }}">