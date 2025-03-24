@extends('admin.layouts.app-admin')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4">{{ $pagetitle }}</h4>
            <div class="text-end">
               <a href = "{{ route('admin.module.access') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
               <span class="tf-icon mdi mdi-eye me-1"></span>Module Access List
               </a>
            </div>
            <form class="form-horizontal" role="form" method = "post" action="{{ route('admin.module.access.update') }}">
               @csrf
               <input type="hidden" name="role_id" value="{{ $role->id ?? null }}">
               <div class="col-6">
                    <div class="mb-4 row">
                        <label for="role_name" class="col-md-4 col-form-label">Role Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{ $role->rolename }}" id="role_name" disabled>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label" for="menu">Menu</label>
                        <div class="col-md-8">
                            <select id="menu" name="menu[]" class="form-control select2" multiple>
                                <option>Select Menu</option>
                                @foreach($menues as $menu)
                                    <option value="{{ $menu->id }}" @if(in_array($menu->id, old('menu', $moduleAccess ?? []))) selected @endif> {{ $menu->menuname }}</option> 
                                @endforeach
                            </select>
                            @error('menu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  <br><br>
                  <div class="justify-content-end row">
                     <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection