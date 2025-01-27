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
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="topbar-text">
                            <ul class="list-inline text-right">
                                <li class="list-inline-item"><a href = "#"><?php echo e(Auth::user()->name); ?></a></li>
                                <li class="list-inline-item"> <a href = "<?php echo e(route('logout')); ?>">
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
                    <a class="navbar-brand" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('public/frontassets//img/logo-color.png')); ?>" width="120" alt="logo" class="img-fluid" /></a>
                    <!--logo end-->

                    <!--responsive toggle button start-->
                    <button type="button" class="navbar-toggler btn" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                        <span id="hamburgerTrigger">
                          <span class="fas fa-bars"></span>
                        </span>
                    </button>
                    <!--responsive toggle button end-->

                    <!--main menu start-->
                    <div id="navBar" class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto main-navbar-nav">
                            <!--home start-->
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="<?php echo e(route('home')); ?>" aria-haspopup="true" aria-expanded="false">Home</a>

                            </li>
                            <!--home end-->

                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">Venue</a>

                            </li>
                             <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">Invitation</a>

                            </li>
                             <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">Vendor</a>

                            </li>
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">Event Planning</a>

                            </li>
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">Guest</a>

                            </li>
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">Service</a>

                            </li>
                             <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a class="nav-link custom-nav-link" href="#" aria-haspopup="true" aria-expanded="false">About</a>

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