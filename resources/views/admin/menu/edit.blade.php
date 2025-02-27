@extends('admin.layouts.app-admin')
@section('content')

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Edit Menu</h4>
                        <div class="row">
                           
                        <div class="text-end">
                         <a href = "{{ route('admin.menu') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>View List
                           </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" method="post" action="{{ route('menu.update', $menu->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="menuname">Menu Name</label>
                            <div class="col-md-8">
                                <input type="text" id="menuname" name="menuname" class="form-control" placeholder="Enter the Menu name" value="{{ old('menuname', $menu->menuname) }}">
                                @error('menuname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="modelname">Model Name</label>
                            <div class="col-md-8">
                                <input type="text" id="modelname" name="modelname" class="form-control" placeholder="Enter the Model name" value="{{ old('modelname', $menu->modelname) }}">
                                @error('modelname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="controllername">Controller Name</label>
                            <div class="col-md-8">
                                <input type="text" id="controllername" name="controllername" class="form-control" placeholder="Enter the Controller name" value="{{ old('controllername', $menu->controllername) }}">
                                @error('controllername')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="tablename">Table Name</label>
                            <div class="col-md-8">
                                <input type="text" id="tablename" name="tablename" class="form-control" placeholder="Enter the Table name" value="{{ old('tablename', $menu->tablename) }}">
                                @error('tablename')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="icon">Icon</label>
                            <div class="col-md-8">
                                <input type="text" id="icon" name="icon" class="form-control" placeholder="Enter the Icon" value="{{ old('icon', $menu->icon) }}">
                                @error('icon')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="url">URL</label>
                            <div class="col-md-8">
                                <input type="text" id="url" name="url" class="form-control" placeholder="Enter the URL" value="{{ old('url', $menu->url) }}">
                                @error('url')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="route">Route</label>
                            <div class="col-md-8">
                                <input type="text" id="route" name="route" class="form-control" placeholder="Enter the Route" value="{{ old('route', $menu->route) }}">
                                @error('route')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="sortorder">Sort Order</label>
                            <div class="col-md-8">
                                <input type="number" id="sortorder" name="sortorder" class="form-control" placeholder="Enter the Sort Order" value="{{ old('sortorder', $menu->sortorder) }}">
                                @error('sortorder')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="parentid">Parent Menu</label>
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
                        <br><br>
                            <div class="justify-content-end row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update Menu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection