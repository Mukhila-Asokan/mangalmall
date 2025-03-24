@extends('admin.layouts.app-admin')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4">List of {!! $pagetitle !!}</h4>
            <div class="text-end">
               <a href = "{{ route('roles/create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
            </div>
            <div class="table-responsive">
               @php $i=1; @endphp
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Department Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($roles) > 0)
                            @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{  $i++ }}</th>
                                <td>{{ $role->rolename }}</td>
                                <td>{{ $role->departments->departmentname }}</td>
                                <td>
                                    <a href="{{ route('admin.module.access.edit', ['id' => $role->id]) }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            {{ $roles->links('pagination::bootstrap-4') }}
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
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ route('admin.module.access') }}">