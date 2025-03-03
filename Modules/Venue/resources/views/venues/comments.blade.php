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
				<h4 class="header-title mb-4">Venue Comments</h4>
				<table class="table table-bordered data-table">
		<thead>
			<tr>
				<th class="text-center"><input type="checkbox" id="select-all"></th>
				<th>Venue</th>
				<th>Comment</th>
				<th>Commented User</th>
				<th>Commented At</th>
				<th width="200px">Action</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
			<a href="javascript:void(0);" class="btn btn-danger mt-3 bulk_action" style="float:right;" id="bulk_comments_approve">Approve Selected Comments</a>
			<a href="javascript:void(0);" class="btn btn-danger me-3 mt-3 bulk_action" style="float:right;" id="bulk_comments_reject">Reject Selected Comments</a>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/venue/') }}">  
@endsection
@push('scripts')

<script type="text/javascript">
	$(function () {
		var table = $('.data-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('venue.comments') }}",
			columns: [
				{ 
					data: 'id', 
					name: 'id',
					orderable: false,
					searchable: false,
					render: function(data, type, row) {
						return '<input type="checkbox" class="record-checkbox" name="record_ids[]" value="' + data + '">';
					}
				},
				{data: 'venue_name', name: 'venue_name'},
				{data: 'review', name: 'review'},
				{data: 'user_name', name: 'user_name'},
				{data: 'created_at', name: 'created_at'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
	});
	document.getElementById('select-all').addEventListener('change', function() {
		let checkboxes = document.querySelectorAll('.record-checkbox');
		checkboxes.forEach(checkbox => {
			checkbox.checked = this.checked;
		});
	});

	$('.bulk_action').on('click', function(){
		$.ajax({
			url: "{{ route('bulk.comments.action') }}",
			type: "GET",
			data: { 
				record_ids: $("input[name='record_ids[]']:checked").map(function() {
					return this.value;
				}).get(),
				action : $(this).attr('id') == 'bulk_comments_approve' ? 'approve' : 'reject',
			},
			dataType: "json",
			success: function (data) {
				if(data.status == 'success'){
					window.location.reload();
				}
			}
		});
	})
</script>
@endpush