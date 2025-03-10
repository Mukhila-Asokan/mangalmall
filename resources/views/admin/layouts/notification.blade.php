@php
use Carbon\Carbon;

$today = Carbon::today();
$yesterday = Carbon::yesterday();
@endphp

<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown"
       href="#" role="button" aria-haspopup="false" aria-expanded="false">
        <i class="mdi mdi-bell font-size-24"></i>
        <span class="badge bg-danger rounded-circle noti-icon-badge" id = "notificationcount">{{ auth()->guard('admin')->user()->unreadNotifications->count() }}</span>
    </a>

    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0 font-size-16 fw-semibold">Notification</h6>
                </div>
                <div class="col-auto">
                    <a href="javascript:void(0);" class="text-dark text-decoration-underline">
                        <small>Clear All</small>
                    </a>
                </div>
            </div>
        </div>

        <div class="px-1" style="max-height: 300px;" data-simplebar>

            {{-- Today’s Notifications --}}
            @php
                $todayNotifications = auth()->guard('admin')->user()->unreadNotifications->filter(function ($notification) use ($today) {
                    return Carbon::parse($notification->created_at)->isToday();
                });
            @endphp

            @if($todayNotifications->count() > 0)
                <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5>
                @foreach($todayNotifications as $notification)
                    <a href="{{ route('admin.markNotification', $notification->id) }}"
                       class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 text-truncate ms-2">
                                    <h5 class="noti-item-title fw-semibold font-size-14">{{ $notification->data['user_name'] }} 
                                        <small class="fw-normal text-muted ms-1">{{ $notification->created_at->format('H:i A') }}</small>
                                    </h5>
                                    <small class="noti-item-subtitle text-muted">
                                        {{ $notification->data['message'] ?? 'New Notification' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif

            {{-- Yesterday’s Notifications --}}
            @php
                $yesterdayNotifications = auth()->guard('admin')->user()->unreadNotifications->filter(function ($notification) use ($yesterday) {
                    return Carbon::parse($notification->created_at)->isYesterday();
                });
            @endphp

            @if($yesterdayNotifications->count() > 0)
                <h5 class="text-muted font-size-13 fw-normal mt-2">Yesterday</h5>
                @foreach($yesterdayNotifications as $notification)
                    <a href="{{ route('admin.markNotification', $notification->id) }}"
                       class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 text-truncate ms-2">
                                    <h5 class="noti-item-title fw-semibold font-size-14">{{ $notification->data['user_name'] }} 
                                        <small class="fw-normal text-muted ms-1">{{ $notification->created_at->format('d-m-Y H:i A') }}</small>
                                    </h5>
                                    <small class="noti-item-subtitle text-muted">
                                        {{ $notification->data['message'] ?? 'New Notification' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif

            {{-- Older Notifications --}}
            @php
                $olderNotifications = auth()->guard('admin')->user()->unreadNotifications->filter(function ($notification) use ($today, $yesterday) {
                    return Carbon::parse($notification->created_at)->lt($yesterday);
                });
            @endphp

            @if($olderNotifications->count() > 0)
                <h5 class="text-muted font-size-13 fw-normal mt-2">Earlier</h5>
                @foreach($olderNotifications as $notification)
                    <a href="{{ route('admin.markNotification', $notification->id) }}"
                       class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 text-truncate ms-2">
                                    <h5 class="noti-item-title fw-semibold font-size-14">{{ $notification->data['user_name'] }} 
                                        <small class="fw-normal text-muted ms-1">{{ $notification->created_at->format('d-m-Y H:i A') }}</small>
                                    </h5>
                                    <small class="noti-item-subtitle text-muted">
                                        {{ $notification->data['message'] ?? 'New Notification' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif

            @if(auth()->guard('admin')->user()->unreadNotifications->count() == 0)
                <a class="dropdown-item text-center">No new notifications</a>
            @endif

        </div>

        <!-- View All -->
        <a href="{{ route('admin.notifications') }}"
           class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
            View All
        </a>
    </div>
</li>
