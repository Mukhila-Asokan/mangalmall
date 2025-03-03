@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Subscriber Menu Permissions</h4>

            <div class="text-end">
                <a href="{{ route('subscriptionmenupermission.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-plus me-1"></span> Add 
                </a>
            </div>

            <div class="accordion" id="subscriberAccordion">
    @if(count($menuPermissions) > 0)
        @php $i = 1; @endphp

        @foreach($menuPermissions->groupBy('subscriber_id') as $subscriberId => $permissions)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $subscriberId }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $subscriberId }}" aria-expanded="true" aria-controls="collapse{{ $subscriberId }}">
                        Subscriber Plan ID: {{ $subscriberId }} - {{ $permissions->first()->subscriberplan->name ?? 'Unknown Plan' }}
                    </button>
                </h2>
                <div id="collapse{{ $subscriberId }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $subscriberId }}" data-bs-parent="#subscriberAccordion">
                    <div class="accordion-body">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Menu Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $permission->usermenu->menuname ?? '' }}</td>
                                        <td>
                                            @if($permission->status == 'Active')
                                                <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $permission->id }}" title="Active">
                                                    <i class="fa fa-eye action_icon"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $permission->id }}" title="Inactive">
                                                    <i class="fa fa-eye-slash action_icon"></i>
                                                </button>
                                            @endif
                                            <a href="{{ url('/admin/subscription/subscriptionmenupermission/'.$permission->id.'/edit') }}" class="btn-warning btn" title="Edit">
                                                <i class="fa fa-pencil action_icon"></i>
                                            </a>
                                            <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="{{ $permission->id }}" title="Delete">
                                                <i class="fa fa-trash action_icon"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No Records Found</p>
    @endif
</div>

        </div>
    </div>
</div>
</div>
@endsection

<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/subscription/subscriptionmenupermission/') }}">