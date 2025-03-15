 <div class="topbar container-fluid">
                    <div class="d-flex align-items-center gap-lg-2 gap-1">

                        <!-- Topbar Brand Logo -->
                        <div class="logo-topbar">
                            <!-- Logo light -->
                            <a href="#" class="logo-light">
                                <span class="logo-lg">
                                    <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="logo">
                                </span>
                                <span class="logo-sm">
                                    <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="small logo">
                                </span>
                            </a>

                            <!-- Logo Dark -->
                            <a href="#" class="logo-dark">
                                <span class="logo-lg">
                                    <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="dark logo">
                                </span>
                                <span class="logo-sm">
                                    <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="small logo">
                                </span>
                            </a>
                        </div>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu">
                            <i class="ri-menu-2-fill"></i>
                        </button>

                        <!-- Topbar Search Form -->
                        <div class="app-search dropdown d-none d-lg-block">
                            <!-- <form>
                                <div class="input-group">
                                    <input type="search" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                                    <span class="ri-search-line search-icon"></span>
                                </div>
                            </form> -->

                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h5 class="text-overflow mb-1">Found <b class="text-decoration-underline">08</b> results</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ri-file-chart-line fs-16 me-1"></i>
                                    <span>Booking Details</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ri-lifebuoy-line fs-16 me-1"></i>
                                    <span>Staff List</span>
                                </a>


                            </div>
                        </div>
                    </div>

                    <ul class="topbar-menu d-flex align-items-center gap-3">
                        <li class="dropdown d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="ri-search-line fs-22"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                <form class="p-3">
                                    <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>

                        <?php
                            $venueUser = Modules\VenueAdmin\Models\VenueUser::where('id', \Session::get('venueuserid'))->first();
                        ?>
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="ri-notification-3-line fs-22"></i>
                                @if(count($venueUser->unreadNotifications) > 0)
                                    <span class="noti-icon-badge"></span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                                <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold"> Notification</h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('mark.as.read') }}" class="text-dark text-decoration-underline">
                                                <small>Mark as read</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div style="max-height: 300px;" class="text-center" data-simplebar>
                                    <!-- item-->
                                    <div class="unread_notifications"></div>
                                    @if(count($venueUser->unreadNotifications) <= 0)
                                        No Record Found
                                    @endif
                                </div>

                                <!-- All-->
                                <a href="{{ route('get.all.notifications') }}" class="dropdown-item text-center text-primary text-decoration-underline fw-bold notify-item border-top border-light py-2">
                                    View All
                                </a>

                            </div>
                        </li>

                        

                        <li class="d-none d-sm-inline-block">
                            <div class="nav-link" id="light-dark-mode">
                                <i class="ri-moon-line fs-22"></i>
                            </div>
                        </li>


                        <li class="d-none d-md-inline-block">
                            <a class="nav-link" href="" data-toggle="fullscreen">
                                <i class="ri-fullscreen-line fs-22"></i>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">                              
                                <span class="d-lg-flex flex-column gap-1 d-none">
                                    <h5 class="my-0">{{ $username }}</h5>
                                    <h6 class="my-0 fw-normal">Venue Administrator</h6>
                                     <p class="mb-0 d-flex align-items-center gap-2">
                                      <i class="ri-mail-fill"></i> {{ $email }}
                                    </p>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="{{ route('venueadmin.userprofile'); }}" class="dropdown-item">
                                    <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('venueadmin.userprofile'); }}" class="dropdown-item">
                                    <i class="ri-settings-4-line fs-18 align-middle me-1"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item">
                                    <i class="ri-customer-service-2-line fs-18 align-middle me-1"></i>
                                    <span>Support</span>
                                </a>

                              
                                <!-- item-->
                                <a href="{{ route('venueadmin/logout') }}" class="dropdown-item">
                                    <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
@push('scripts')
 <script>
    document.addEventListener("DOMContentLoaded", function() {
        var baseUrl = "{{ url('/') }}";
        renderNotification(baseUrl);
        setInterval(() => {
            renderNotification(baseUrl);
        }, 5000);
    });

    function renderNotification(baseUrl){
        fetch(`${baseUrl}/venueadmin/notifications`)
        .then(response => response.json())
        .then(notifications => {
            let notificationContainer = document.querySelector(".unread_notifications");
            if (!notificationContainer) {
                console.error("Notification container not found.");
                return;
            }

            notificationContainer.innerHTML = "";
            notifications.forEach(notification => {
                console.log(notification);
                
                let item = `
                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item unread-noti card m-0 shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="notify-icon bg-primary">
                                        <i class="ri-message-3-line fs-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-truncate ms-2">
                                    <h5 class="noti-item-title fw-semibold fs-14">
                                        ${notification.data.type ?? ''} 
                                        <small class="fw-normal text-muted float-end ms-1"> - </small>
                                    </h5>
                                    <small class="noti-item-subtitle text-muted">${notification.data.message}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                `;
                notificationContainer.innerHTML += item;
            });
        })
    }
 </script>
@endpush