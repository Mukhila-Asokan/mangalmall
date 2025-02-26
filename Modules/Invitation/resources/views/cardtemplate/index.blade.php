@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Card Templates</h4>

            <div class="text-end">
                <a href="{{ route('cardtemplate.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-plus me-1"></span> Add 
                </a>
            </div>

            <form method="GET" action="{{ route('invitation.cardtemplate') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search Card Name" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
            <select name="occasion" class="form-control">
                <option value="">Select Occasion</option>
                @foreach($occasiontypes as $occasion)
                    <option value="{{ $occasion->id }}" {{ request('occasion') == $occasion->id ? 'selected' : '' }}>
                        {{ $occasion->eventtypename }}
                    </option>
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
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('invitation.cardtemplate') }}" class="btn btn-secondary">Reset</a>
            </div>

        </div>
            </form>


            <div class="table-responsive">
                @php  $start = ($cardTemplates->currentPage() - 1) * $cardTemplates->perPage() + 1;  @endphp

                @if(count($cardTemplates) > 0)
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Template Name</th>
                            <th>Occasion</th>
                            <th>Template Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cardTemplates as $template)
                        <tr>
                            <th scope="row">{{ $start++ }}</th>
                            <td>{{ $template->templatename }}</td>
                            <td>{{ $template->occasionType->eventtypename ?? ''}}</td>
                            <td><img src="{{ asset(''.$template->templateimage) }}" alt="{{ $template->templatename }}" width="100"></td>
                            <td>
                                @if($template->status == 'Active')
                                <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $template->id }}" title="Status">
                                    <i class="fa fa-eye action_icon"></i>
                                </button>
                                @else 
                                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $template->id }}" title="Status">
                                    <i class="fa fa-eye-slash action_icon"></i>
                                </button>
                                @endif
                                <a href="{{ url('/admin/invitation/cardtemplate/'.$template->id.'/edit') }}" class="btn-warning btn" title="Edit">
                                    <i class="fa fa-pencil action_icon"></i>
                                </a>
                                <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="{{ $template->id }}" title="Delete">
                                    <i class="fa fa-trash action_icon"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $cardTemplates->links('pagination::bootstrap-4') }}
                @else
                No Records Found
                @endif
            </div> 
        </div>
    </div>
</div>
</div>
@endsection

<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/invitation/cardtemplate/') }}">

