 <aside class="left-sidebar with-horizontal">
        <!-- Sidebar scroll-->
        <div>
          <!-- Sidebar navigation-->
          <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
            <ul id="sidebarnav">
              <!-- ============================= -->
              <!-- Home -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Home</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="#" aria-expanded="false">
                  <span>
                    <i class="ti ti-home-2"></i>
                  </span>
                  <span class="hide-menu">Dashboard</span>
                </a>
            </li>

              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <span>
                    <i class="ti ti-layout-grid"></i>
                  </span>
                  <span class="hide-menu">Venue Management</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ route('venueadmin/venuelist') }}" class="sidebar-link">

                          <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                         </div>
                        <span class="hide-menu">List</span>

                     
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ route('venueadmin/create')}}" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                             <i class="ti ti-plus"></i>
                         </div>
                      <span class="hide-menu">Add</span>
                    </a>
                  </li>              
                </ul>
              </li>

                  <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <span>
                    <i class="ti ti-settings"></i>
                  </span>
                  <span class="hide-menu">Settings</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ route('venueadmin/userprofile')}}" class="sidebar-link">

                          <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-user"></i>
                         </div>
                        <span class="hide-menu">Profile</span>

                     
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ route('venueadmin/changemobileno')}}" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                             <i class="ti ti-key"></i>
                         </div>
                      <span class="hide-menu">Change Mobile No</span>
                    </a>
                  </li>              
                </ul>
              </li>

            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>