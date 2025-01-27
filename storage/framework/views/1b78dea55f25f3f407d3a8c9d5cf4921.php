 <!--  Header Start -->
      <header class="topbar shadow-sm">
        <div class="with-vertical">
        	<nav class="navbar navbar-expand-lg p-0">
        	
          <ul class="navbar-nav">
              <li class="nav-item nav-icon-hover-bg rounded-circle ms-n2">
                <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                  <i class="ti ti-menu-2"></i>
                </a>
              </li>
              <li class="nav-item nav-icon-hover-bg rounded-circle d-none d-lg-flex">
                <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="ti ti-search"></i>
                </a>
              </li>
            </ul>

            <ul class="navbar-nav quick-links d-none d-lg-flex align-items-center">
               <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="#">Support</a>
              </li>
              <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="#">Calendar</a>
              </li>
              
            </ul>

          <div class="d-block d-lg-none py-4">
              <a href="#" class="text-nowrap logo-img">
                <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="dark-logo" alt="Logo-Dark" />
                <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="light-logo" alt="Logo-light" />
              </a>
            </div>
            <a class="navbar-toggler nav-icon-hover-bg rounded-circle p-0 mx-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <i class="ti ti-dots fs-7"></i>
            </a>

              <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <div class="d-flex align-items-center justify-content-between">
                <a href="javascript:void(0)" class="nav-link nav-icon-hover-bg rounded-circle mx-0 ms-n1 d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                  <i class="ti ti-align-justified fs-7"></i>
                </a>
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
               
                	<li class="nav-item nav-icon-hover-bg rounded-circle dropdown">
                    <a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
                      <i class="ti ti-bell-ringing"></i>
                      <div class="notification bg-primary rounded-circle"></div>
                    </a>
                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                      <div class="d-flex align-items-center justify-content-between py-3 px-7">
                        <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                        <span class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
                      </div>
                      <div class="message-body" data-simplebar>
                     
                        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                          <span class="me-3">
                            <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" alt="user" class="rounded-circle" width="48" height="48" />
                          </span>
                          <div class="w-100">
                            <h6 class="mb-1 fw-semibold lh-base">New message</h6>
                            <span class="fs-2 d-block text-body-secondary">Mangal Mall sent you new message</span>
                          </div>
                        </a>
                  
                  
                      </div>
                      <div class="py-6 px-7 mb-1">
                        <button class="btn btn-outline-primary w-100">See All Notifications</button>
                      </div>
                    </div>
                  </li>

                     <li class="nav-item dropdown">
                    <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" aria-expanded="false">
                      <div class="d-flex align-items-center">
                        <div class="user-profile-img">
                          <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="rounded-circle" width="35" height="35" alt="modernize-img" />
                        </div>
                      </div>
                    </a>
                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                      <div class="profile-dropdown position-relative" data-simplebar>
                        <div class="py-3 px-7 pb-0">
                          <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                        </div>
                        <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                          <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="rounded-circle" width="80" height="80" alt="modernize-img" />
                          <div class="ms-3">
                            <h5 class="mb-1 fs-3"><?php echo e($username); ?></h5>
                            <span class="mb-1 d-block">Venue Administrator</span>
                            <p class="mb-0 d-flex align-items-center gap-2">
                              <i class="ti ti-mail fs-4"></i> <?php echo e($email); ?>

                            </p>
                          </div>
                        </div>                       
                        <div class="d-grid py-4 px-7 pt-8">
                         
                          <a href="<?php echo e(route('venueadmin/logout')); ?>" class="btn btn-outline-primary">Log Out</a>
                        </div>
                      </div>
                    </div>
                  </li>

               	</ul>


        </div>
    </div>
</nav>
</div>


 <div class="app-header with-horizontal">

  <nav class="navbar navbar-expand-xl container-fluid p-0">

    <ul class="navbar-nav align-items-center">
      <li class="nav-item nav-icon-hover-bg rounded-circle d-flex d-xl-none ms-n2">
        <a class="nav-link sidebartoggler" id="sidebarCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      <li class="nav-item d-none d-xl-block">
        <a href="#" class="text-nowrap nav-link">
          <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="dark-logo" width="120" alt="modernize-img" />
          <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="light-logo" width="120" alt="modernize-img" />
        </a>
      </li>
      <li class="nav-item nav-icon-hover-bg rounded-circle d-none d-xl-flex">
        <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class="ti ti-search"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav quick-links d-none d-xl-flex align-items-center">
     <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="#">Support</a>
              </li>
              <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="#">Calendar</a>
              </li>

      </ul>

        <div class="d-block d-xl-none">
              <a href="#" class="text-nowrap nav-link">
                <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" width="120" alt="modernize-img" />
              </a>
       </div>
        <a class="navbar-toggler nav-icon-hover-bg rounded-circle p-0 mx-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="p-2">
            <i class="ti ti-dots fs-7"></i>
          </span>
        </a>

         <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                       <li class="nav-item nav-icon-hover-bg rounded-circle">
                    <a class="nav-link moon dark-layout" href="javascript:void(0)">
                      <i class="ti ti-moon moon"></i>
                    </a>
                    <a class="nav-link sun light-layout" href="javascript:void(0)">
                      <i class="ti ti-sun sun"></i>
                    </a>
                  </li>

                    <li class="nav-item nav-icon-hover-bg rounded-circle dropdown">
                    <a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
                      <i class="ti ti-bell-ringing"></i>
                      <div class="notification bg-primary rounded-circle"></div>
                    </a>
                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                      <div class="d-flex align-items-center justify-content-between py-3 px-7">
                        <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                        <span class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
                      </div>
                      <div class="message-body" data-simplebar>
                        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                          <span class="me-3">
                            <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" alt="user" class="rounded-circle" width="48" height="48" />
                          </span>
                          <div class="w-100">
                            <h6 class="mb-1 fw-semibold lh-base">Mangal Mall!</h6>
                            <span class="fs-2 d-block text-body-secondary">Congratulate you</span>
                          </div>
                        </a>

                      </div>
                    </div>
                  </li>

                   <li class="nav-item dropdown">
                    <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" aria-expanded="false">
                      <div class="d-flex align-items-center">
                        <div class="user-profile-img">
                          <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="rounded-circle" width="35" height="35" alt="modernize-img" />
                        </div>
                      </div>
                    </a>
                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                      <div class="profile-dropdown position-relative" data-simplebar>
                        <div class="py-3 px-7 pb-0">
                          <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                        </div>
                        <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                          <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="rounded-circle" width="80" height="80" alt="modernize-img" />
                          <div class="ms-3">
                            <h5 class="mb-1 fs-3"><?php echo e($username); ?></h5>
                            <span class="mb-1 d-block">Venue Administrator</span>
                            <p class="mb-0 d-flex align-items-center gap-2">
                              <i class="ti ti-mail fs-4"></i> <?php echo e($email); ?>

                            </p>
                          </div>
                        </div>
                       
                        <div class="d-grid py-4 px-7 pt-8">
                         
                          <a href="<?php echo e(route('venueadmin/logout')); ?>" class="btn btn-outline-primary">Log Out</a>
                        </div>
                      </div>
                    </div>
                  </li>

                    </ul>

              </div>
          </div>

              <div>
</nav>

 </div>
</header><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/layouts/topbar.blade.php ENDPATH**/ ?>