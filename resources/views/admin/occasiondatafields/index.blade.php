@extends('admin.layouts.app-admin')

@section('content')

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">List of Occasion Type Data Fields</h4>

                          
                        <div class="text-end">
                              <a href = "{{ route('admin/occasiondatafield/create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
                        </div>
                   

    <!-- Filter and Search Form -->
    <form method="GET" action="{{ route('admin/occasiondatafield') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search Occasion Data Field" value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="occasion" class="form-control">
                    <option value="">All Occasions</option>
                    @foreach($occasions as $occasion)
                    <option value="{{ $occasion->id }}" {{ request('occasion') ==  $occasion->id ? 'selected' : '' }} > {{$occasion->eventtypename  }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="sort" class="form-control">
                    <option value="">Sort by</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Alphabet A - Z</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Alphabet Z - A</option>
                </select>
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin/occasiondatafield') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

                         <div class="table-responsive">
                         @php
                            $start = ($occasionDataFields->currentPage() - 1) * $occasionDataFields->perPage() + 1;
                        @endphp
                             @if(count($occasionDataFields) > 0)
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Occasion Data Field Name</th>   
                                        <th>Occasion Name</th>         
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                    @foreach($occasionDataFields as $datafield)
                                    <tr>
                                        <th scope="row">{{ $start++ }}</th>
                                        <td>{{ $datafield->datafieldname }}</td>  
                                        <td>{{ $datafield->occasion->eventtypename }}</td>         
                                        
                                        
                                        <td>@if($datafield->status == 'Active')
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $datafield->id }}" title="Active"><i class="fa fa-eye action_icon"></i></button>
                @else 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="{{ $datafield->id }}" title="Inactive"><i class="fa fa-eye-slash action_icon"></i></button>
                @endif
                <a href="{{ url('/admin/occasiondatafield/'.$datafield->id.'/edit') }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
                </a>
                 <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="{{ $datafield->id }}" title="Delete"  >
                    <i class="fa fa-trash action_icon"></i>
                </button>
           </td>
                                    </tr>     
                                    
                                
                                    @endforeach

                                    </tbody>
                                    </table>
                                       {{ $occasionDataFields->links('pagination::bootstrap-4') }}
           @else
                No Records Found
        @endif
                           
                        </div> 
                    </div>
                </div>
            </div>
        </div>
@endsection
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/occasiondatafield/') }}">  