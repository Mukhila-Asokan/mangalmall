    <!-- Brand Logo Light -->
                <a href="#" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="small logo">
                    </span>
                </a>

                <!-- Brand Logo Dark -->
                <a href="#" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="small logo">
                    </span>
                </a>
                <!-- Full Sidebar Menu Close Button -->
                <div class="button-close-fullsidebar">
                    <i class="ri-close-fill align-middle"></i>
                </div>

                <!-- Sidebar -left -->
                <div class="h-100" id="leftside-menu-container" data-simplebar>
                    <!-- Leftbar User -->
                    <div class="leftbar-user">
                        <a href="#">
                            <img src="{{ asset('venueasset/images/users/avatar-1.jpg') }}" alt="user-image" height="42" class="rounded-circle shadow-sm">
                            <span class="leftbar-user-name mt-2">Michael Berndt</span>
                        </a>
                    </div>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                       
                        <li class="side-nav-title">Main</li>

                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <i class="ri-dashboard-2-fill"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <i class="ri-calendar-event-fill"></i>
                                <span> Calendar </span>
                            </a>
                        </li>

                        <!--li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <i class="ri-message-3-fill"></i>
                                <span> Chat </span>
                            </a>
                        </li-->

                        <!--li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                                <i class="ri-mail-fill"></i>
                                <span> Email </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEmail">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="#">Inbox</a>
                                    </li>
                                    <li>
                                        <a href="#">Read Email</a>
                                    </li>
                                </ul>
                            </div>
                        </li-->

                        <li class="side-nav-title">Venue Mangament</li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarBaseUI" class="side-nav-link">
                                <i class="ri-home-heart-fill"></i>
                                <span>Venues </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarBaseUI">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('venueadmin/create')}}">Add Venue</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('venueadmin/venuelist') }}">List Venue</a>
                                    </li>                                  
                                    <li>
                                        <a href="{{ route('venuebooking.eventslist') }}">Booking Details</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarExtendedUI" aria-expanded="false" aria-controls="sidebarExtendedUI" class="side-nav-link">
                                <i class="ri-price-tag-2-fill"></i>
                                <span> Venue Pricing</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarExtendedUI">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="#">Venue Booking Payment</a>
                                    </li>  
                                    <li>
                                        <a href="#">Invoice Generator</a>
                                    </li>
                                                                  
                                </ul>
                            </div>
                        </li>
            
            <li class="side-nav-title">Staff Mangament</li>
            
               <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarStaff" aria-expanded="false" aria-controls="sidebarStaff" class="side-nav-link">
                                <i class="ri-team-fill"></i>
                                <span> Staff</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarStaff">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('venueadmin.add.staff') }}">Add Staff</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('venueadmin.list.staff') }}">List</a>
                                    </li>                                  
                                </ul>
                            </div>
                   </li>
            <li class="side-nav-title">Settings</li>
            
            <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarsettings" aria-expanded="false" aria-controls="sidebarStaff" class="side-nav-link">
                                <i class="ri-team-fill"></i>
                                <span> Settings</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarsettings">
                                <ul class="side-nav-second-level">
                                <li>  <a href="{{ route('venueadmin.changemobileno')}}">Change Mobile No</a></li> 
                                    <li>
                                        <a href="{{ route('venue.bookingadons')}}">Booking Adds</a>
                                    </li> 
                                    <li>  <a href="{{ route('venueadmin.userprofile')}}">User Profile</a></li>                                  
                                </ul>
                            </div>
                   </li>


           
            
            <li class="side-nav-item">
                            <a href="{{ route('venueadmin/logout') }}" class="side-nav-link">
                                <i class="ri-logout-circle-r-fill"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                        


                    </ul>
                    <!--- End Sidemenu -->

                     <div class="bg-flower-bot">
                      <img src="{{ asset('venueasset/images/flowers/img-4.png') }}">
                  </div>


                    <div class="clearfix"></div>
                </div>