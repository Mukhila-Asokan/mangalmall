@extends('admin.layouts.app-admin')

@section('content')

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">List of Checklists</h4>

                          
                        <div class="text-end">
                              <a href = "{{ route('admin.checklist.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
                        </div>
                   

                         <div class="table-responsive table-hover table-border">
                             @php
                                        $start = ($checklists->currentPage() - 1) * $checklists->perPage() + 1;
                                    @endphp
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Occasion ID</th>            
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($checklists) > 0)
                                    @foreach($checklists as $checklist)
                                    <tr>
                                        <th scope="row">{{  $start++ }}</th>
                                        <td>{{ $checklist->name }}</td>
                                        <td>{{ $checklist->occasion_id }}</td>           
                                        
                                        
                                        <td>@if($checklist->status == 'Active')
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $checklist->id }}" title="Active Status"><i class="fa fa-eye action_icon"></i></button>
                @else 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="{{ $checklist->id }}" title="Inactive Status"><i class="fa fa-eye-slash action_icon"></i></button>
                @endif
                <a href="{{ url('/admin/checklist/'.$checklist->id.'/edit') }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
                </a>
                 <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="{{ $checklist->id }}" title="Delete"  >
                    <i class="fa fa-trash action_icon"></i>
                </button>
           </td>
                                    </tr>                                             
                                    @endforeach
                                    <tr>
                                        <td colspan="4">
                                       {{ $checklists->links('pagination::bootstrap-4') }}

                                       </td>
                                    </tr>
                                        @else 
                                            <tr>
                                            <td colspan="4">
                                                No Records Found

                                            </td>
                                        </tr>   
                                        @endif
                                       
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
@endsection
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/checklist/') }}">