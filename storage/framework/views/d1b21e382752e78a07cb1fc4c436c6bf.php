<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_basic_shapes">Basic Shapes</a>
        </h4>
    </div>
    <div id="acc_basic_shapes" class="panel-collapse collapse in pg-basic-shaps">
        <div class="panel-body">
            
            <ul>
                <?php $__currentLoopData = $basic_shapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_dividers">Dividers</a>
        </h4>
    </div>
    <div id="acc_dividers" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $dividers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_abstract">Abstract</a>
        </h4>
    </div>
    <div id="acc_abstract" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $abstract_shapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_badges">Badges</a>
        </h4>
    </div>
    <div id="acc_badges" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_ecommerce">Ecommerce</a>
        </h4>
    </div>
    <div id="acc_ecommerce" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $ecommerce; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_arrow">Arrow</a>
        </h4>
    </div>							
    <div id="acc_arrow" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $arrow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_banners">Banners</a>
        </h4>
    </div>
    <div id="acc_banners" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_holiday">Holiday</a>
        </h4>
    </div>
    <div id="acc_holiday" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $holiday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_button">Button</a>
        </h4>
    </div>
    <div id="acc_button" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $button; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_social">Social</a>
        </h4>
    </div>
    <div id="acc_social" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $social; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_emoji">Emoji</a>
        </h4>
    </div>
    <div id="acc_emoji" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $emoji; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_object">Object</a>
        </h4>
    </div>
    <div id="acc_object" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $object; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_seasonal">Seasonal</a>
        </h4>
    </div>
    <div id="acc_seasonal" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $seasonal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="pg-element-svg"><img src="<?php echo e($img['src']); ?>" alt="<?php echo e($img['alt']); ?>"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/cardeditior/shape.blade.php ENDPATH**/ ?>