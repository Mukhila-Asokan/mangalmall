@extends('admin.layouts.app-admin')
@section('content')
<style type="text/css">
    table
    {
        color:#000;
    }
</style>
 <div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="header-title mb-4">{{ $pagetitle }}</h4>
			   
				<div class="text-end">
				 <a href = "{{ route('staff/create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
						<span class="tf-icon mdi mdi-plus me-1"></span>Add Staff
				   </a>
				</div>
			

				<table class="table table-bordered data-table">
		<thead>
			<tr>
				<th>#</th>
				<th>First Name</th>
                <th>Last Name</th>
                <th>Email ID</th>
				<th>Mobile No</th>
				<th width="100px">Action</th>
			</tr>
		</thead>
		<tbody>
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
        
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin/staff') }}",
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

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