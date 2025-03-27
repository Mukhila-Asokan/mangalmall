  <?php
    $userId = Session::get('userid');
    $admin = App\Models\AdminUser::where('id', $userId)->first();
    if($admin->role == 'Staff'){
        $role = App\Models\Staff::where('id', $admin->staff_id)->pluck('roleid')->first();
    }
    else{
        $role = 1;
    }
  ?>
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
                            <span class="menu-text"> Dashboard </span>
                         
                        </a>
                    </li>
                    <?php if($role == 1 || hasMenuAccess($role, 'Venue')): ?>
                        <li class="menu-item">
                            <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="copy"></i></span>
                                <span class="menu-text"> Venue Management </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="menuExpages">
                                <ul class="sub-menu">
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('venue')); ?>" class="menu-link">
                                            <span class="menu-text">Venue</span>
                                        </a>
                                    </li>

                                    
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('venue.venueportalrequest')); ?>" class="menu-link">
                                            <span class="menu-text">Venue Portal Request</span>
                                        </a>
                                    </li>
                                
                                    <li class="menu-item">
                                        <a href="#" class="menu-link">
                                            <span class="menu-text">Invoice</span>
                                        </a>
                                    </li>
                                    <!--li class="menu-item">
                                        <a href="" class="menu-link">
                                            <span class="menu-text">Venue Categories</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('venue/venueamenities')); ?>" class="menu-link">
                                            <span class="menu-text">Venue Amenities</span>
                                        </a>
                                    </li-->                              
                                    
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin/venuethemes')); ?>" class="menu-link">
                                            <span class="menu-text">Venue Themes</span>
                                        </a>
                                    </li>
                            
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('venuesettings')); ?>" class="menu-link">
                                            <span class="menu-text">Venue Settings</span>
                                        </a>
                                    </li>     
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('venue.deletedrecords')); ?>" class="menu-link">
                                            <span class="menu-text">Venue Deleted Records</span>
                                        </a>
                                    </li>   
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('venue.comments')); ?>" class="menu-link">
                                            <span class="menu-text">Venue Comments Approve</span>
                                        </a>
                                    </li>
                                                        
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if($role == 1 || hasMenuAccess($role, 'Invitation')): ?>
                        <li class="menu-item">
                            <a href="#invitationExpages" data-bs-toggle="collapse" class="menu-link waves-effect" >
                                <span class="menu-icon"><i data-lucide="file-image"></i></span>
                                <span class="menu-text">Invitation Mangement</span>
                                <span class="menu-arrow"></span>
                            </a>

                            <div class="collapse" id="invitationExpages">
                                <ul class="sub-menu">
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation/invitationmodel')); ?>" class="menu-link">
                                            <span class="menu-text">Design & Style</span>
                                        </a>
                                    </li>
                                    
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation/invitationsize')); ?>" class="menu-link">
                                            <span class="menu-text">Size</span>
                                        </a>
                                    </li>

                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation.silhouette')); ?>" class="menu-link">
                                            <span class="menu-text">Silhouette</span>
                                        </a>
                                    </li>

                                    
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation.cardthickness')); ?>" class="menu-link">
                                            <span class="menu-text">Card Thickness</span>
                                        </a>
                                    </li>
                                    
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation.invitationcolor')); ?>" class="menu-link">
                                            <span class="menu-text">Color</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation.printingmethod')); ?>" class="menu-link">
                                            <span class="menu-text">Printing Method</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation.printingmaterial')); ?>" class="menu-link">
                                            <span class="menu-text">Material</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation.budget')); ?>" class="menu-link">
                                            <span class="menu-text">Budget</span>
                                        </a>
                                    </li>     
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation.webpage')); ?>" class="menu-link">
                                            <span class="menu-text">Webpage</span>
                                        </a>
                                    </li>     
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('invitation.cardtemplate')); ?>" class="menu-link">
                                            <span class="menu-text">Card Template</span>
                                        </a>
                                    </li>    
                                                                        
                                </ul>
                            </div>

                        </li>
                    <?php endif; ?>
                    
                    <?php if($role == 1 || hasMenuAccess($role, 'Vendor')): ?>
                        <li class="menu-item">
                            <a href="#menuvendor" data-bs-toggle="collapse" class="menu-link waves-effect"> 
                                <span class="menu-icon"><i data-lucide="fan"></i></span>
                                <span class="menu-text">Vendor Management</span>
                                <span class="menu-arrow"></span>
                            </a>


                            <div class="collapse" id="menuvendor">
                                <ul class="sub-menu">
                                    <li class="menu-item">

                                        <a href="<?php echo e(route('venue.venueportalrequest')); ?>" class="menu-link">
                                            <span class="menu-text">Vendor List</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('venue.venueportalrequest')); ?>" class="menu-link">
                                            <span class="menu-text">Vendor Portal Request</span>
                                        </a>
                                    </li>
                                                
                                </ul>
                            </div>

                        </li>
                    <?php endif; ?>

                    <?php if($role == 1 || hasMenuAccess($role, 'Blog')): ?>
                        <li class= "menu-item">
                            <a href="#menublogpages" data-bs-toggle="collapse" class="menu-link waves-effect">
                                    <span class="menu-icon"><i data-lucide="person-standing"></i></span>
                                    <span class="menu-text">Blog Mangement</span>
                                    <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="menublogpages">
                                    <ul class="sub-menu">
                                    <li class="menu-item">
                                            <a href="<?php echo e(route('subcriptionplan')); ?>" class="menu-link">
                                                <span class="menu-text">Blog Analytics</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="<?php echo e(route('subcriptionplan')); ?>" class="menu-link">
                                                <span class="menu-text">Blog</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="<?php echo e(route('subcriptionplan')); ?>" class="menu-link">
                                                <span class="menu-text">User Request</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="<?php echo e(route('admin.blogcategory')); ?>" class="menu-link">
                                                <span class="menu-text">Blog Category</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="<?php echo e(route('admin.blogtag')); ?>" class="menu-link">
                                                <span class="menu-text">Blog Tags</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="<?php echo e(route('admin.subscriptionmenupermission')); ?>" class="menu-link">
                                                <span class="menu-text">Social Login</span>
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                        </li>
                    <?php endif; ?>


                    <?php if($role == 1 || hasMenuAccess($role, 'Subscription')): ?>
                        <li class= "menu-item">
                            <a href="#menusubcriptionpages" data-bs-toggle="collapse" class="menu-link waves-effect">
                                    <span class="menu-icon"><i data-lucide="person-standing"></i></span>
                                    <span class="menu-text">Subscription Mangement</span>
                                    <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="menusubcriptionpages">
                                    <ul class="sub-menu">
                                        <li class="menu-item">
                                            <a href="<?php echo e(route('subcriptionplan')); ?>" class="menu-link">
                                                <span class="menu-text">Subcription Plan</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="<?php echo e(route('admin.subscriptionmenupermission')); ?>" class="menu-link">
                                                <span class="menu-text">Permission Module</span>
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                        </li>
                    <?php endif; ?>



                    <?php if($role == 1 || hasMenuAccess($role, 'Subscription')): ?>
                        <li class="menu-item">
                            <a href="#menustaffpages" data-bs-toggle="collapse" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="person-standing"></i></span>
                                <span class="menu-text">Staff Mangement</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="menustaffpages">
                                <ul class="sub-menu">
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin/staff')); ?>" class="menu-link">
                                            <span class="menu-text">Staff</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('staff/departments')); ?>" class="menu-link">
                                            <span class="menu-text">Departments</span>
                                        </a>
                                    </li>  
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('staff/roles')); ?>" class="menu-link">
                                            <span class="menu-text">Roles</span>
                                        </a>
                                    </li>  
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin.module.access')); ?>" class="menu-link">
                                            <span class="menu-text">Module Access</span>
                                        </a>
                                    </li>  
                                </ul>
                            </div>

                        </li>
                    <?php endif; ?>

                    <?php if($admin->role == 'Super Admin'): ?>
                        <li class="menu-item">
                            <!--a href="#" class="menu-link">  
                                <span class="menu-icon"><i data-lucide="cog"></i></span>
                                <span class="menu-text">Settings</span>
                            </a-->

                            <a href="#menuSettpages" data-bs-toggle="collapse" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="cog"></i></span>
                                <span class="menu-text"> Settings </span>
                                <span class="menu-arrow"></span>
                            </a>

                            <div class="collapse" id="menuSettpages">
                                <ul class="sub-menu">
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin/occasion')); ?>" class="menu-link">
                                            <span class="menu-text">Occasion</span>
                                        </a>
                                    </li>   
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin.checklist')); ?>" class="menu-link">
                                            <span class="menu-text">Checklist</span>
                                        </a>
                                    </li>   
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin.budget')); ?>" class="menu-link">
                                            <span class="menu-text">Budget</span>
                                        </a>
                                    </li>  
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin/occasiondatafield')); ?>" class="menu-link">
                                            <span class="menu-text">Occasion Data Field</span>
                                        </a>
                                    </li>   
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin/religion')); ?>" class="menu-link">
                                            <span class="menu-text">Religion</span>
                                        </a>
                                    </li>  
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin.menu')); ?>" class="menu-link">
                                            <span class="menu-text">Menu</span>
                                        </a>
                                    </li>  
                                    <li class="menu-item">
                                        <a href="<?php echo e(route('admin.usermenu')); ?>" class="menu-link">
                                            <span class="menu-text">User Menu</span>
                                        </a>
                                    </li>      
                                
                                </ul>
                            </div>   
                        </li>
                    <?php endif; ?>
              </ul>
                      

                <div class="help-box">
                    <h5 class="text-muted font-size-15 mb-3">For Help &amp; Support</h5>
                    <p class="font-size-13"><span class="font-weight-bold">Email:</span> <br> info@domain.com</p>
                    <p class="mb-0 font-size-13"><span class="font-weight-bold">Call:</span> <br> (+123) 123 456 789</p>
                </div>
            </div>

        

        </div>

        <?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/layouts/sidemenu.blade.php ENDPATH**/ ?>