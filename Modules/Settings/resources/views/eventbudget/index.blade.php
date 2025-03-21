@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Event Budget Management</h4>

            <div class="text-end">
                <a href="{{ route('admin.eventbudget.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add Budget </a>
            </div>

            <div class="table-responsive">
                @php $i=1; @endphp

                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th>Budget Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($eventBudgets) > 0)
                        @foreach($eventBudgets as $eventBudget)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $eventBudget->occasion->eventtypename ?? '' }}</td>
                            <td>{{ $eventBudget->budgetCategory->name ?? '' }}</td>                          
                            <td>
                                <a href="{{ route('admin.eventbudget.edit', $eventBudget->id) }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i></a>
                                <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="{{ $eventBudget->id }}" title="Delete"><i class="fa fa-trash action_icon"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No Records Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {{ $eventBudgets->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/settings/eventbudget/') }}">