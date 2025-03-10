@extends('venueadmin::layouts.admin-layout')
@section('content')
<div class="row m-3">
<div class="card p-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Bell Icon with Unread Count -->
        <div class="d-flex align-items-center">
            <i class="fa fa-bell fs-4 text-primary me-2"></i>
            <h5 class="m-0">Notifications</h5>
        </div>

        <!-- Notification Counts -->
        <div class="d-flex">
            <div class="badge bg-success me-2">
                Unread: <span id="unreadCount">{{$user->unreadNotifications->count()}}</span>
            </div>
            <div class="badge bg-secondary">
                Read: <span id="readCount">{{$user->readNotifications->count()}}</span>
            </div>
        </div>
    </div>
    <hr>
    <!-- Notification List -->
    <div class="notification-list">
        <!-- Unread Notifications -->
        <h6 class="text-danger fw-bold">Unread Notifications</h6>
        @forelse ($user->unreadNotifications as $notification)
            <div class="alert alert-success p-2 mb-1">
                <small>{{ $notification->data['message'] }}</small>
            </div>
        @empty
            <p class="text-muted">No unread notifications</p>
        @endforelse

        <hr>

        <!-- Read Notifications -->
        <h6 class="text-success fw-bold">Read Notifications</h6>
        @forelse ($user->readNotifications as $notification)
            <div class="alert alert-secondary p-2 mb-1">
                <small>{{ $notification->data['message'] }}</small>
            </div>
        @empty
            <p class="text-muted">No read notifications</p>
        @endforelse
    </div>

    <!-- Mark All as Read Button -->
    <div class="text-end mt-2">
        <a href="{{ route('mark.as.read') }}" class="btn btn-sm btn-primary">Mark All as Read</a>
    </div>
</div>
</div>
@endsection