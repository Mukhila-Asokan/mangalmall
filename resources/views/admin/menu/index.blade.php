@extends('admin.layouts.app-admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-2">Menu</h4>
                 
                <div class="text-end">   
                    <a href="{{ route('menu.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-plus me-1"></span>Add
                    </a>
                </div>
                <div class="table-responsive">
                @if(count($menus) > 0)
                
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Menu Name</th>
                                <th class="text-center">Parent Name</th>
                                <th class="text-center">Model Name</th>
                                <th class="text-center">Controller Name</th>
                                <th class="text-center">Module Name</th>
                                <th class="text-center">Route</th>
                                <th class="text-center">URL</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                        @php
    $start = ($menus->currentPage() - 1) * $menus->perPage() + 1;
@endphp
                            @foreach($menus as $menu)
                            <tr>
                                <td>{{ $start++ }}</td>
                                <td>{{ $menu->menuname }}</td>
                                <td>{{ $menu->parentname->menuname ?? '' }}</td>
                                <td>{{ $menu->modelname }}</td>
                                <td>{{ $menu->controllername }}</td>
                                <td>{{ $menu->parentname->menuname ?? '' }}</td>
                                <td>{{ $menu->route }}</td>
                                <td>{{ $menu->url }}</td>
                                <td>
                                    @if($menu->status == 'Active')
                                        <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $menu->id }}" title="Active Status"><i class="fa fa-eye action_icon"></i></button>
                                    @else 
                                        <button type="button" class="btn-info btn statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $menu->id }}" title="Inactive Status"><i class="fa fa-eye-slash action_icon"></i></button>
                                    @endif
                                    <a href="{{ url('/admin/menu/'.$menu->id.'/edit') }}" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i></a>
                                    <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="{{ $menu->id }}" title="Delete"><i class="fa fa-trash action_icon"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                   
                            {{ $menus->links('pagination::bootstrap-4') }}
                        @else
                            No Records Found
                        @endif
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection

<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/menu/') }}">