<aside class="left-sidebar with-vertical">
    <div><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="#" class="text-nowrap logo-img">
            <img src="<?php echo e(asset('venueassets/images/logo-light.png')); ?>" class="dark-logo" alt="Logo-Dark" />
            <img src="<?php echo e(asset('venueassets/images/logo-light.png')); ?>" class="light-logo" alt="Logo-light" />
          </a>
          <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
            <i class="ti ti-x"></i>
          </a>
        </div>
      </div>
       <nav class="sidebar-nav scroll-sidebar" data-simplebar>
          <ul id="sidebarnav">

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
                <span class="d-flex">
                  <i class="ti ti-layout-grid"></i>
                </span>
                <span class="hide-menu">Venue Management</span>
              </a>
               <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="<?php echo e(route('venueadmin/venuelist')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('venueadmin/create')); ?>" class="sidebar-link">
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
                <span class="d-flex">
                  <i class="ti ti-layout-cog"></i>
                </span>
                <span class="hide-menu">Settings</span>
              </a>
               <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="#" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Profile</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('venueadmin/venueadd')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-plus"></i>
                    </div>
                    <span class="hide-menu">Change Password</span>
                  </a>
                </li>
              </ul>
            </li>



          </ul>
        </nav>


</aside><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/layouts/left-sidemenubar.blade.php ENDPATH**/ ?>