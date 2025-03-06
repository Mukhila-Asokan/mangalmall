@extends('venueadmin::layouts.admin-layout')
@section('content')
<div class="col-12">
    <div class="card">
	    <div class="card-body p-4">
            <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Staff Code</th>
                            <th>Mobile</th>						
                            <th>Email</th>
                            <th>Address</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @if(count($venueStaffs) > 0)
                            @foreach($venueStaffs as $staff)
                                <tr>
                                    <td>{{  $i++ }}</td>
                                    <td>{{ $staff->first_name }} </td>
                                    <td>{{ $staff->last_name }} </td>
                                    <td>{{ $staff->staff_code }} </td>
                                    <td>{{ $staff->mobile_number }} </td>
                                    <td>{{ $staff->email }} </td>
                                    <td>{{ $staff->address }} </td>
                                    <td>
                                        <a href="{{ route('venueadmin.edit.staff', ['id'=> $staff->id]) }}" class="font-14 text-warning mleft-10" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                        <a href="javascript:void(0)" class="font-14 text-danger mleft-10 delete_venue_staff" data-id="{{ $staff->id }}" title="Delete"><i class="bi bi-trash3"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else                                     
                            <tr>
                                <td colspan="7" class="text-center">No Records Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $('.delete_venue_staff').on('click', function(){
            var id = $(this).data('id');
            if(confirm('Are you sure want to delete this staff?')){
                window.location.href = "{{ url('venueadmin/delete/staff') }}/" + id;
            }
        })
    </script>
@endpush