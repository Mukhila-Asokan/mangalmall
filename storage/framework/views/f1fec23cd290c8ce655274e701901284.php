<div class="sidebar-left pr-4">

    

    <!-- Categories widget-->
    <aside class="widget widget-categories">
        <div class="widget-title">
            <h6>Mangal Mall</h6>
        </div>
        <div class="sidebar">
            <a href="#">Profile</a>  
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accessPaidMenus', Auth::user())): ?>
            <a href="<?php echo e(route('venuereact.search')); ?>">Venue</a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accessPaidMenus', Auth::user())): ?>
            <a href="#taskSubmenu" data-toggle="collapse"> <i class="ti-layers"></i> Invitation  <i class="fas fa-chevron-down toggle-icon"></i></a>
            <div id="taskSubmenu" class="collapse submenu">
                <a href="<?php echo e(route('user.carddesign')); ?>"><i class="ti-id-badge"></i> Card Desgin </a>
                <a href="<?php echo e(route('user.webpage')); ?>">Web Page Design</a>
                <a href="<?php echo e(route('user.showtemplate')); ?>">Design Own Page</a>
                <a href="#">Video Making </a>
            </div>
            <?php endif; ?>
        
            <a href="#">Gift Repository </a>
            <a href="#">Todo list </a>
            <a href="#">Plan Details </a>
           <a href="#">Blog Writing</a>
        </div>
    </aside>

  

    <!-- Subscribe widget-->
    <aside class="widget widget-categories">
        <div class="widget-title">
            <h6>Newsletter</h6>
        </div>
        <p>Enter your email address below to subscribe to my newsletter</p>
        <form action="#" method="post" class="d-none d-md-block d-lg-block">
            <input type="text" class="form-control input" id="email-footer" name="email" placeholder="info@yourdomain.com">
            <button type="submit" class="btn primary-solid-btn btn-block btn-not-rounded mt-3">Subscribe</button>
        </form>
    </aside>

    <!-- Tags widget-->
    <aside class="widget widget-tag-cloud">
        <div class="widget-title">
            <h6>Tags</h6>
        </div>
        <div class="tag-cloud"><a href="#">Occasion</a><a href="#">vendor</a><a href="#">Venue</a><a href="#">Calendor</a></div>
    </aside>
</div><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/profile-layouts/sidebar.blade.php ENDPATH**/ ?>