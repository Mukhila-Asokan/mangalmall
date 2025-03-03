@extends('admin.layouts.app-admin')
@section('content')
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Edit User Menu</h4>
            
            <div class="text-end">
                <a href = "{{ route('admin.usermenu') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>User Menu List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('usermenu.menu_update', $menu->id) }}">
            @csrf
            @method('PUT')
            <div class="col-12">
            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="menuname">Menu Name</label>
                <div class="col-md-8">
                        <input type="text" id="menuname" name="menuname" class="form-control" placeholder="Enter the menu name" value = "{{ old('menuname', $menu->menuname) }}">
                        @error('menuname')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="icon">Icon</label>
                <div class="col-md-8">
                        <input type="text" id="icon" name="icon" class="form-control" placeholder="Enter the icon class" value = "{{ old('icon', $menu->icon) }}">
                        @error('icon')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="parentid">Parent Menu</label>
                <div class="col-md-8">
                        <select id="parentid" name="parentid" class="form-control">
                            <option value="">Select Parent Menu</option>
                            @foreach($menus as $parentMenu)
                                <option value="{{ $parentMenu->id }}" {{ old('parentid', $menu->parentid) == $parentMenu->id ? 'selected' : '' }}>{{ $parentMenu->menuname }}</option>
                            @endforeach
                        </select>
                        @error('parentid')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="sortorder">Sort Order</label>
                <div class="col-md-8">
                        <input type="text" id="sortorder" name="sortorder" class="form-control" placeholder="Enter the sort order" value = "{{ old('sortorder', $menu->sortorder) }}">
                        @error('sortorder')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update User Menu</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection