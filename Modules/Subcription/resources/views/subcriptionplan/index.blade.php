@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Subscription Plans</h4>

            <div class="text-end">
                <a href="{{ route('subcriptionplan.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-plus me-1"></span> Add 
                </a>
            </div>

            <div class="table-responsive">
                @php $i=1; @endphp

                @if(count($subscriptionPlans) > 0)
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscriptionPlans as $plan)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $plan->name }}</td>
                            <td>{{ $plan->description }}</td>
                            <td>{{ $plan->price }}</td>
                            <td>{{ $plan->duration }}</td>
                            <td>
                                <a href="{{ url('/admin/subscriptionplan/'.$plan->id.'/edit') }}" class="btn-warning btn" title="Edit">
                                    <i class="fa fa-pencil action_icon"></i>
                                </a>
                                <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="{{ $plan->id }}" title="Delete">
                                    <i class="fa fa-trash action_icon"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $subscriptionPlans->links('pagination::bootstrap-4') }}
                @else
                No Records Found
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection

<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/subscriptionplan/') }}">