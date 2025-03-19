@extends('admin.layouts.app-admin')

@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Checklists Settings</h4>
            <div class="row">
            <div class="col-md-4">
                <div class="card border border-primary">
                    <h5 class="card-header border-bottom">Checklist Category</h5>
                    <div class="card-body">
                        
                        <h5 class="card-title">Create a category for Checklist</h5><br>
                        <a href="{{ route('admin.checklistcat.create') }}" class="btn btn-primary waves-effect waves-light">Add</a>
                        <a href="{{ route('admin.checklistcat.index') }}" class="btn btn-primary waves-effect waves-light">View</a>
                    </div>
                </div>
                <!-- end card-box-->
            </div>

            <div class="col-md-4">
                <div class="card border border-danger">
                    <h5 class="card-header border-bottom">Checklist Items</h5>
                    <div class="card-body">
                        
                        <h5 class="card-title">Create a new items for Checklist Category</h5><br>
                        <a href="{{ route('admin.checklistitems.create') }}" class="btn btn-danger waves-effect waves-light">Add</a>
                        <a href="{{ route('admin.checklistitems.index') }}" class="btn btn-danger waves-effect waves-light">View</a>
                    </div>
                </div>
                <!-- end card-box-->
            </div>

            <div class="col-md-4">
                <div class="card border border-warning">
                    <h5 class="card-header border-bottom">Checklist for events</h5>
                    <div class="card-body">
                        
                        <h5 class="card-title">Create a events for Checklist</h5><br>
                        <a href="{{ route('admin.eventchecklist.create') }}" class="btn btn-warning waves-effect waves-light">Add</a>
                        <a href="{{ route('admin.eventchecklist.index') }}" class="btn btn-warning waves-effect waves-light">View</a>
                    </div>
                </div>
                <!-- end card-box-->
            </div>

            </div>
        </div> 
    </div>
</div>
</div>
@endsection