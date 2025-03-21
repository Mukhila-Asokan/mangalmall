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
                        <a href = "{{ route('admin/list/venue/user', ['staffId' => $staff->id]) }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-eye me-1"></span>Venue User List
                        </a>
                    </div>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Venue Name</th>
                                <th>Booked User Name</th>
                                <th>Booked Mobile No</th>
                                <th>Booking Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookingEnquiries as $key => $enquiry)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $enquiry->venue->venuename }}</td>
                                    <td>{{ $enquiry->name }}</td>
                                    <td>{{ $enquiry->mobile_number }}</td>
                                    <td>{{ $enquiry->booking_date }}</td>
                                    <td>{{ $enquiry->status }}</td>
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