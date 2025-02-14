@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Budgets</h4>

                
            <div class="text-end">
                    <a href = "{{ route('budget.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
            </div>
        

                <div class="table-responsive">
                    @php $i=1; @endphp
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Budget Name</th>            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($invitationbudget) > 0)
                        @foreach($invitationbudget as $budget)
                        <tr>
                            <th scope="row">{{  $i++ }}</th>
                            <td>{{ $budget->budgetname }}</td>           
                            
                            
                            <td>@if($budget->status == 'Active')
        <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $budget->id }}" title="Status"><i class="fa fa-eye action_icon"></i></button>
    @else 
    <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="{{ $budget->id }}" title="Status"><i class="fa fa-eye-slash action_icon"></i></button>
    @endif
    <a href="{{ url('/admin/invitation/budget/'.$budget->id.'/edit') }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
    </a>
        <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="{{ $budget->id }}" title="Delete"  >
        <i class="fa fa-trash action_icon"></i>
    </button>
</td>
                        </tr>                                             
                        @endforeach
                            {{ $invitationbudget->links('pagination::bootstrap-4') }}
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
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/invitation/budget/') }}">