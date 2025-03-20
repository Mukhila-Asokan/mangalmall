<?php use App\Models\UserChecklist; ?>

@extends('profile-layouts.profile')

@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        @include('profile-layouts.sticky')
        <div class="col-lg-11 col-md-11 stickymenucontent">  
        @foreach($userOccasion as $occasion)
<div class="col-md-12 mb-12">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body">

            <?php $stats = UserChecklist::dashboardStats($occasion->id); ?>

            <!-- Event Title + Add Checklist Button -->
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $occasion->Occasionname->eventtypename }}</h4>
                <a href="{{ route('checklist.create', ['occasion_id' => $occasion->id]) }}" 
                   class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add Checklist
                </a>
            </div>
            <hr class="my-3">

            <!-- Occasion Details -->
            <div class="d-flex justify-content-between align-items-center">
                <p class="card-text"><strong>Date:</strong> {{ \Carbon\Carbon::parse($occasion->occasiondate)->format('d/m/y') }}</p>
                <p class="card-text"><strong>Place:</strong> {{ $occasion->occasion_place }}</p>
                <p class="card-text"><strong>Notes:</strong> {{ $occasion->notes }}</p>
            </div>

            <!-- Checklist Summary -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-warning">
                        <div class="card-body">
                            <h5>Total Tasks</h5>
                            <h2>{{ $stats['total_tasks'] }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-success text-white">
                        <div class="card-body">
                            <h5>Completed Tasks</h5>
                            <h2>{{ $stats['completed_tasks'] }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-warning">
                        <div class="card-body">
                            <h5>Not Yet Started</h5>
                            <h2>{{ $stats['not_yet_task'] }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-info text-white">
                        <div class="card-body">
                            <h5>Ongoing</h5>
                            <h2>{{ $stats['pending_tasks'] }}</h2>
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