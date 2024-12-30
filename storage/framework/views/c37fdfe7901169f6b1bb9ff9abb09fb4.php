  <!-- ========== Left Sidebar ========== -->
        <div class="main-menu">
            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="#" class="logo-light">
                    <img src="<?php echo e(asset('adminassets/images/logo-light.png')); ?>" alt="" height="75">
                </a>

                <!-- Brand Logo Dark -->
                <a href="#" class="logo-dark">
                    <img src="<?php echo e(asset('adminassets/images/logo-light.png')); ?>" alt="" height="75">
                </a>
            </div>

            <!--- Menu -->
            <div data-simplebar>
                <ul class="app-menu">

                    <li class="menu-title">Menu</li>

                    <li class="menu-item">
                        <a href="<?php echo e(route('admin/dashboard')); ?>" class="menu-link waves-effect">
                            <span class="menu-icon"><i data-lucide="airplay "></i></span>
                            <span class="menu-text"> Dashboards </span>
                         
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect">
                            <span class="menu-icon"><i data-lucide="copy"></i></span>
                            <span class="menu-text"> Venue Management </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuExpages">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                        <span class="menu-text">Venue List</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                        <span class="menu-text">Invoice</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                        <span class="menu-text">Venue Categories</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                        <span class="menu-text">Venue Amenities</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                        <span class="menu-text">Venue Builder</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                        <span class="menu-text">Venue Settings</span>
                                    </a>
                                </li>                               
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i data-lucide="file-image"></i></span>
                            <span class="menu-text">Inviation Mangement</span>
                        </a>
                    </li>
                    
                    <li class="menu-item">
                        <a href="#" class="menu-link waves-effect"> 
                            <span class="menu-icon"><i data-lucide="fan"></i></span>
                            <span class="menu-text">Vendor Management</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i data-lucide="person-standing"></i></span>
                            <span class="menu-text">Staff Mangement</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">  
                            <span class="menu-icon"><i data-lucide="cog"></i></span>
                            <span class="menu-text">Settings</span>
                        </a>
                    </li>
              </ul>
                      

                <div class="help-box">
                    <h5 class="text-muted font-size-15 mb-3">For Help &amp; Support</h5>
                    <p class="font-size-13"><span class="font-weight-bold">Email:</span> <br> info@domain.com</p>
                    <p class="mb-0 font-size-13"><span class="font-weight-bold">Call:</span> <br> (+123) 123 456 789</p>
                </div>
            </div>
        </div>

        <?php /**PATH C:\xampp\htdocs\mangalmall\resources\views\admin\layouts\sidemenu.blade.php ENDPATH**/ ?>