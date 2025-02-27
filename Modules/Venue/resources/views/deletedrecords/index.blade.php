@extends('admin.layouts.app-admin')

@section('content')
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-2">List of Menu</h4>
               
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-4">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Menu Name</th> 
                                <th class="text-center">Action</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through states here -->
                             @foreach($deletedMenus as $menu)
                            <tr>
                                <td class="text-center">{{ $menu->id }}</td>
                                <td class="text-center">{{ $menu->menuname }}</td>
                                <td class="text-center">
                                    <a href="{{ route('menus.restore', $menu->id) }}" class="btn btn-success btn-sm" title="Restore">
                                        <i class="fas fa-trash-restore"></i>
                                    </a>
                                    <a href="{{ route('menus.deletepermanent', $menu->id) }}" class="btn btn-danger btn-sm" title="Delete Permanently">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                            </tr>
                            @endforeach
                            <!-- End loop -->
                        </tbody>
                    </table>
                    <!-- Pagination links here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<input type="hidden" name="redirecturl" id="redirecturl" value="#">