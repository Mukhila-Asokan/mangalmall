<?php use App\Models\UserChecklist; ?>

@extends('profile-layouts.profile')

@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        @include('profile-layouts.sticky')
        <div class="col-lg-11 col-md-11 stickymenucontent"> 
 <center><h4 class="text-center">Checklist Board</h4></center>		
        @foreach($userOccasion as $occasion)
<div class="col-md-12 mb-12">
    <div class="card shadow-lg border-0 rounded-3 p-3">
        <div class="card-body">

            <?php $stats = UserChecklist::dashboardStats($occasion->id); ?>

            <!-- Event Title + Add Checklist Button -->
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-color">{{ $occasion->Occasionname->eventtypename }}</h5>
                <a href="{{ route('checklist.create', ['occasion_id' => $occasion->id]) }}" 
                   class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add Checklist
                </a>
            </div>
            <hr class="my-3">

            <!-- Occasion Details -->
            <div class="justify-content-between align-items-center mb-2">
                <p class="card-text"><strong>Date:</strong> {{ \Carbon\Carbon::parse($occasion->occasiondate)->format('d/m/y') }}</p>
                <p class="card-text"><strong>Place:</strong> {{ $occasion->occasion_place }}</p>
                <p class="card-text overflow-hidden"><strong>Notes:</strong> {{ $occasion->notes }}</p>
            </div>

            <!-- Checklist Summary -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-warning">
                        <div class="card-body">
                            <h5>Total Tasks</h5>
                            <h4>{{ $stats['total_tasks'] }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-success text-white">
                        <div class="card-body">
                            <h5>Completed Tasks</h5>
                            <h4>{{ $stats['completed_tasks'] }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-warning">
                        <div class="card-body">
                            <h5>Not Yet Started</h5>
                            <h4>{{ $stats['not_yet_task'] }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-info text-white">
                        <div class="card-body">
                            <h5>Ongoing</h5>
                            <h4>{{ $stats['pending_tasks'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach

                 

        </div>
    </div>
</div>

<div class="col-lg-2 col-md-2">
    @include('profile-layouts.rightside')
</div>
@endsection