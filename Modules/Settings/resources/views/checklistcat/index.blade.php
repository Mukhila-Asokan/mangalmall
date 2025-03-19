@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Checklist Category</h4>

                
            <div class="text-end">
                    <a href = "{{ route('admin.checklistcat.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
            </div>
        

                <div class="table-responsive">
                    @php $i=1; @endphp

                
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Checklist Category Name</th>            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($category) > 0)
                        @foreach($category as $cat)
                        <tr>
                            <th scope="row">{{  $i++ }}</th>
                            <td>{{ $cat->name }}</td>           
                            
                            
                            <td>@if($cat->status == 'Active')
        <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $cat->id }}" title="Status"><i class="fa fa-eye action_icon"></i></button>
    @else 
    <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="{{ $cat->id }}" title="Status"><i class="fa fa-eye-slash action_icon"></i></button>
    @endif
    <a href="{{ route('admin.checklistcat.edit',$cat->id) }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
    </a>
        <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="{{ $cat->id }}" title="Delete"  >
        <i class="fa fa-trash action_icon"></i>
    </button>
</td>
                        </tr>                                             
                        @endforeach
                        @else
                        <tr>    
                            <td colspan = "4"> No Records Found</td>
                        </tr>   
                        @endif
                        </tbody>
                </table>
                            {{ $category->links('pagination::bootstrap-4') }}

                    
            </div> 
        </div>
    </div>
</div>
</div>
@endsection
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/settings/checklistcat/') }}">