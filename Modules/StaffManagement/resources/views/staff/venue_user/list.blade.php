@extends('admin.layouts.app-admin')
@section('content')
    <style type="text/css">
        table{
            color:#000;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">{{ $pagetitle }}</h4>
                    <div class="text-end">
                        <a href = "{{ route('admin/create/venue/user', ['id' => $staff->id ]) }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-plus me-1"></span>Create Venue User
                        </a>
                        <a href ="{{ route('admin/staff') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-eye me-1"></span> Staff List
                        </a>
                    </div>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email ID</th>
                                <th>Mobile No</th>
                                <th>Status</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venueUsers as $key => $venueUser)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $venueUser->name }}</td>
                                    <td>{{ $venueUser->email }}</td>
                                    <td>{{ $venueUser->mobileno }}</td>
                                    <td>{{ $venueUser->status }}</td>
                                    <td>
                                        <a href="{{ route('admin/venue/user/details', ['id' => $venueUser->id]) }}" class="view btn btn-primary btn-sm"><i class="tf-icon mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link href="{{ asset('adminassets/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable();
            $(document).on('click', '#delete_staff', function(){
                if (confirm("Are you sure you want to delete this staff?")) {
                    return true;
                }
                else{
                    return false;
                }
            })
        });
    </script>
@endpush