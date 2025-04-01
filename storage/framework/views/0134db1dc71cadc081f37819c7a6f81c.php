   <header id="header" class="header-main">
        <!--topbar start-->
        <div id="header-top-bar" class="gray-light-bg">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-7 col-lg-7">
                        <div class="topbar-text d-none d-md-block d-lg-block">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="tell:888-1234567"><span class="fas fa-phone mr-2"></span> 24x7 Technical Support 888-1234567</a>
                                </li>
                                <li class="list-inline-item"><a href="#"><span class="fas fa-comments mr-2"></span> Live
                                        Chat</a></li>
                                        <li class="list-inline-item"><a href="#"><span class="fas fa-comments mr-2"></span> Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="topbar-text">
                            <ul class="list-inline text-right">                               
                                <li class="list-inline-item"> <a href = "<?php echo e(route('user.profile')); ?>"><i class="fas fa-solid fa-user mr-1"></i> Profile</a></li>
                                <li class="list-inline-item"> <a href = "<?php echo e(route('home/logout')); ?>"><i class="fa-solid fa-right-from-bracket mr-1"></i> 
                        <?php echo e(__('Log Out')); ?></a>
             
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--topbar end-->
        

        <!--main header menu start-->
        <div id="logoAndNav" class="main-header-menu-wrap white-bg border-bottom">
            <div class="container">
                <nav class="js-mega-menu navbar navbar-expand-md header-nav">

                    <!--logo start-->
                    <a class="navbar-brand" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('frontassets//img/logo-color.png')); ?>" alt="logo" class="img-fluid" /></a>
                    <!--logo end-->

                    <!--responsive toggle button start-->
                    <button type="button" class="navbar-toggler btn" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                        <span id="hamburgerTrigger">
                          <span class="fas fa-bars"></span>
                        </span>
                    </button>
                    <!--responsive toggle button end-->

                    <!--main menu start-->
                    <div id="navBar" class="navbar-collapse">
                        <ul class="navbar-nav ml-auto main-navbar-nav">
                          
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accessPaidMenus', Auth::user())): ?>
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="<?php echo e(route('venuereact.search')); ?>" aria-haspopup="true" aria-expanded="false">Venue</a>

                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accessPaidMenus', Auth::user())): ?>
                             <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">Invitation</a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="<?php echo e(route('venuereact.search')); ?>" aria-haspopup="true" aria-expanded="false">Venue</a>

                            </li>

                            <li class="nav-item hs-has-sub-menu custom-nav-item">
                            <a id="pagesMegaMenu" class="nav-link custom-nav-link main-link-toggle" href="javascript:void(0);" aria-haspopup="true" aria-expanded="false" aria-labelledby="pagesSubMenu">Invitation</a>
                            
                                          <!-- Pages - Submenu -->
                                          <ul id="pagesSubMenu" class="hs-sub-menu main-sub-menu" aria-labelledby="pagesMegaMenu" style="min-width: 260px;">                                   
                                    <li class="hs-has-sub-menu">
                                        <a id="navLinkPagesPricing" class="nav-link sub-menu-nav-link sub-link-toggle" href="javascript:void(0);" aria-haspopup="true" aria-expanded="false" aria-controls="navSubmenuPagesPricing">Card Design</a>

                                        <ul id="navSubmenuPagesPricing" class="hs-sub-menu main-sub-menu" aria-labelledby="navLinkPagesPricing" style="min-width: 230px;">
                                            <li><a class="nav-link sub-menu-nav-link" href="<?php echo e(route('user.carddesign')); ?>">Choose Card</a></li>
                                            <li><a class="nav-link sub-menu-nav-link" href="">Design Your Own Card</a></li>                                           
                                        </ul>
                                    </li>
                                    <li class="hs-has-sub-menu">
                                        <a id="navLinkPagesBlog" class="nav-link sub-menu-nav-link sub-link-toggle" href="javascript:void(0);" aria-haspopup="true" aria-expanded="false" aria-controls="navSubmenuPagesBlog">Web Page Design</a>

                                        <ul id="navSubmenuPagesBlog" class="hs-sub-menu main-sub-menu" aria-labelledby="navLinkPagesBlog" style="min-width: 230px;">
                                            <li><a class="nav-link sub-menu-nav-link" href="<?php echo e(route('user.webpage')); ?>">Choose Web Page</a></li>
                                            <li><a class="nav-link sub-menu-nav-link" href="<?php echo e(route('user.showtemplate')); ?>">Design your Own page</a></li>
                                          
                                        </ul>
                                    </li>
                                    <li class="nav-item submenu-item">
                                        <a class="nav-link sub-menu-nav-link" href="<?php echo e(route('video.index')); ?>">Video Making</a>
                                    </li>

                                 
                                </ul>
                                <!-- End Pages - Submenu -->
                            </li>
                            <!--pages end-->




                            
                             <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">Vendor</a>
                            </li>
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">Gift Repository</a>

                            </li>
     
                            <!-- <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="<?php echo e(route('guest.index', ['user_id'=> auth()->user()->id])); ?>" aria-haspopup="true" aria-expanded="false">Guest</a>

                            </li> -->
                            <li class="nav-item hs-has-sub-menu custom-nav-item">
                                <a id="pagesMegaMenu" class="nav-link custom-nav-link main-link-toggle" href="javascript:void(0);" aria-haspopup="true" aria-expanded="false" aria-labelledby="pagesGuestSubMenu">Guest</a>
                                <ul id="pagesGuestSubMenu" class="hs-sub-menu main-sub-menu" aria-labelledby="pagesMegaMenu" style="min-width: 260px;">                                   
                                    <li><a class="nav-link sub-menu-nav-link" href="<?php echo e(route('guest.index', ['user_id'=> auth()->user()->id])); ?>">All Guests</a></li>
                                    <li><a class="nav-link sub-menu-nav-link" href="<?php echo e(route('guest.group.index')); ?>">Guest Groups</a></li>
                                    <li><a class="nav-link sub-menu-nav-link" href="<?php echo e(route('list.caretaker')); ?>">Caretakers</a></li>
                                </ul>
                            </li>
          
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="<?php echo e(route('home.occasion')); ?>" aria-haspopup="true" aria-expanded="false">Event Plan</a>

                            </li>

                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="<?php echo e(route('blog.index')); ?>" aria-haspopup="true" aria-expanded="false">Blog Writing</a>
                            </li>
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="<?php echo e(route('home.pricing')); ?>" aria-haspopup="true" aria-expanded="false">Pricing</a>
                            </li>
                        
                           

                        </ul>
                    </div>
                    <!--main menu end-->
                </nav>
            </div>
        </div>
        <!--main header menu end-->
    </header>
    <!--header section end-->
<?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/profile-layouts/menubar.blade.php ENDPATH**/ ?>