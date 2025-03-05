<style type="text/css">
textarea {
    width: 100%;
    height: 250px;
}
.ck-content
{
    height: 250px;
    overflow-y: auto;
    overflow-x: hidden;
}

</style>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<?php $__env->startSection('content'); ?>
<style type="text/css"></style>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-start">
                                <a href ="<?php echo e(route('venue/detailview', ['id' => $venue->id])); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-arrow-left me-1"></span>Back
                                </a>
                            </div>
                            <div class="col-6 text-end">
                                <a href = "<?php echo e(route('venue/index')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-eye me-1"></span>List Venue
                                </a>
                            </div>
                        </div>
                        <div class="row">
                      
                        <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('venue.content_add')); ?>">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="venue_id" value="<?php echo e($venue->id); ?>">
                        <div class="col-12">
                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="description">Description</label>
                            <div class="col-md-10">
                                <textarea id="editor" name="description" class="form-control" placeholder="Enter Description">
                                 <?php echo e($venuecontent->description ?? ''); ?>

                                </textarea>
                            </div>

                        </div>

                   

                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="key_features">Key Features</label>
                            <div class="col-md-10">
                                <textarea id="editorkey" name="key_features" class="form-control" placeholder="Enter Key Features">
                                 <?php echo e($venuecontent->key_features ?? ''); ?>

                                </textarea>
                            </div>

                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="ambience">Ambience</label>
                            <div class="col-md-10">
                                <textarea id="editorambience" name="ambience" class="form-control" placeholder="Enter Ambience">
                                 <?php echo e($venuecontent->ambience ?? ''); ?>

                                </textarea>
                            </div>

                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="event_sustability">Event Sustability</label>
                            <div class="col-md-10">
                                <textarea id="event_sustability" name="event_sustability" class="form-control" placeholder="Enter Sustability">
                                 <?php echo e($venuecontent->event_sustability ?? ''); ?>

                                </textarea>
                            </div>

                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="amenities">Amenities</label>
                            <div class="col-md-10">
                                <textarea id="editoramenities" name="amenities" class="form-control" placeholder="Enter Amenities">
                                 <?php echo e($venuecontent->amenities ?? ''); ?>

                                </textarea>
                            </div>

                        </div>

                        
                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="policy">Policy</label>
                            <div class="col-md-10">
                                <textarea id="editorpolicy" name="policy" class="form-control" placeholder="Enter Policy">
                                 <?php echo e($venuecontent->policy ?? ''); ?>

                                </textarea>
                            </div>

                        </div>


                        </div>

                        <br><br>
                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Content</button>
                            </div>
                        </div>



      
                        </form>

                        
                            
                      </div>
                    </div>
              




                    </div>
                </div>
            </div>
       
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

        ClassicEditor.create(document.querySelector('#editorkey')).catch(error => {
            console.error(error);
        });

        ClassicEditor.create(document.querySelector('#editorambience')).catch(error => {
            console.error(error);
        }); 
        ClassicEditor.create(document.querySelector('#event_sustability')).catch(error => {
            console.error(error);
        });

        ClassicEditor.create(document.querySelector('#editoramenities')).catch(error => {
            console.error(error);
        });
        ClassicEditor.create(document.querySelector('#editorpolicy')).catch(error => {
            console.error(error);
        });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venues/venuecontent.blade.php ENDPATH**/ ?>