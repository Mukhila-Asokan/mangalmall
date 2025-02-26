</div>
    </div>
  <input id="csrf_token" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <!-- Notification HTML -->
    <div class="mt_hide" id="notificationBox">
        <div class="mt_success_flex">
            <div class="mt_happy_img">
                <img src="" class="mt_notify_img">
            </div>
            <div class="mt_yeah">
            </div>
        </div>
    </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>window.websitelink = "<?php echo e(url('/')); ?>";</script>
    <script>window.baseurl = "<?php echo e(url('/')); ?>";</script>
	<script src="<?php echo e(asset('frontassets/editor_assets/js/jquery.nice-select.min.js')); ?>"></script>
	<script src="<?php echo e(asset('frontassets/editor_assets/js/range.js')); ?>"></script>
	<script src="<?php echo e(asset('frontassets/editor_assets/js/dropzone.min.js')); ?>"></script>
	<script src="<?php echo e(asset('frontassets/editor_assets/js/spectrum.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/editor_assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/editor_assets/js/editor.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/custom.js')); ?>"></script>
   

    <script src="<?php echo e(asset('frontassets/editor_assets/js/common.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/editor_assets/js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/page_js/admin.js')); ?>"></script>
  
  </body>
</html><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/editor/footer.blade.php ENDPATH**/ ?>