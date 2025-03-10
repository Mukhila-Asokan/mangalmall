@extends('admin.layouts.app-admin')
@section('content')
<div class="row m-3">
    <div class="col-12">
        <div class="card">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Booking Date</th>
                        <th>Mobile Number</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;                                              
                    @endphp
                    @foreach($getAllEnquiries as $enquiry)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $enquiry->name }}</td>
                            <td>{{ $enquiry->booking_date }}</td>
                            <td>{{ $enquiry->mobile_number }}</td>
                            <td>{{ $enquiry->message }}</td>
                            <td>{{ $enquiry->status }}</td>
                            <td>
                                @if($enquiry->status != 'ENQUIRED')
                                    <a href = "{{ route('update.enquiry.status', ['id' => $enquiry->id]) }}" class="btn btn-warning" title = "Invoice">
                                        Click here to update status
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if(count($getAllEnquiries) == 0)
                        <tr>
                            <td colspan="11" class="text-center">No Records Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection