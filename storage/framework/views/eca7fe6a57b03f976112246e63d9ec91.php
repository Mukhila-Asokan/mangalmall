
<?php $__env->startSection('content'); ?>
<div class="mt-1 col-lg-10 col-md-10">
    <div id="all_contacts_container" class="content-section">

         <!--why choose us section start-->
         <section class="why-choose-us ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading mb-5">
                            <h2>Hello, Curious Minds!</h2>
                            <h6>Unveiling Ideas, Insights, and Inspiration</h6>
                        
                        </div>
                    </div>
                </div>
               
            </div>
        </section>


            <!--blog section start-->
        <section class="our-blog-section ptb-100 gray-light-bg">
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Create Slideshow Video')); ?></div>

                <div class="card-body">
                    <form id="imageUploadForm" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for="images">Choose Images:</label>
                            <input type="file" class="form-control" name="images[]" id="images" multiple required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Images</button>
                    </form>

                    <div id="imagePreview" class="mt-4" style="display: none;">
                        <h4>Uploaded Images:</h4>
                        <div id="uploadedImagesContainer" class="row"></div>
                    </div>

                    <form id="audioUploadForm" enctype="multipart/form-data" class="mt-4" style="display: none;">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for="audio">Choose Background Audio:</label>
                            <input type="file" class="form-control" name="audio" id="audio" accept="audio/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Audio</button>
                    </form>

                    <div id="audioPreview" class="mt-4" style="display: none;">
                        <h4>Uploaded Audio:</h4>
                        <audio id="audioPlayer" controls></audio>
                        <input type="hidden" id="audioId">
                    </div>

                    <button id="createVideoBtn" class="btn btn-success mt-4" style="display: none;">Create Video</button>

                    <div id="videoPreview" class="mt-4" style="display: none;">
                        <h4>Your Video:</h4>
                        <video id="videoPlayer" controls style="max-width: 100%;"></video>
                        <div class="mt-3">
                            <a id="downloadVideoBtn" class="btn btn-primary" download>Download Video</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </section>
             

       
    </div>
</div>
<div class="col-lg-2 col-md-2">
    <?php echo $__env->make('profile-layouts.rightside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function () {
        // Image upload handling
        $('#imageUploadForm').on('submit', function (e) {
            e.preventDefault();
            
            let formData = new FormData(this);
            
            $.ajax({
                url: "<?php echo e(route('images.upload')); ?>",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // Show loading indicator
                    $('#imageUploadForm button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...');
                    $('#imageUploadForm button').prop('disabled', true);
                },
                success: function (response) {
                    if (response.success) {
                        $('#uploadedImagesContainer').empty();
                        
                        response.images.forEach(function (image, index) {
                            $('#uploadedImagesContainer').append(`
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img src="${image.image_url}" alt="Uploaded Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="seconds_${image.id}">Duration (seconds):</label>
                                                <input type="number" id="seconds_${image.id}" class="form-control duration-input" data-image-id="${image.id}" placeholder="Enter seconds" min="1" value="3" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                        
                        // Show image preview and audio upload form
                        $('#imagePreview').show();
                        $('#audioUploadForm').show();
                    } else {
                        alert(response.error);
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    
                    for (let field in errors) {
                        errorMessage += errors[field][0] + '\n';
                    }
                    
                    alert(errorMessage || 'Image upload failed.');
                },
                complete: function() {
                    // Hide loading indicator
                    $('#imageUploadForm button').html('Upload Images');
                    $('#imageUploadForm button').prop('disabled', false);
                }
            });
        });
        
        // Audio upload handling
        $('#audioUploadForm').on('submit', function (e) {
            e.preventDefault();
            
            let formData = new FormData(this);
            
            $.ajax({
                url: "<?php echo e(route('audio.upload')); ?>",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // Show loading indicator
                    $('#audioUploadForm button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...');
                    $('#audioUploadForm button').prop('disabled', true);
                },
                success: function (response) {
                    if (response.success) {
                        // Display the audio player
                        $('#audioPlayer').attr('src', response.audio_url);
                        $('#audioId').val(response.audio_id);
                        $('#audioPreview').show();
                        
                        // Show create video button
                        $('#createVideoBtn').show();
                    } else {
                        alert(response.error);
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    
                    for (let field in errors) {
                        errorMessage += errors[field][0] + '\n';
                    }
                    
                    alert(errorMessage || 'Audio upload failed.');
                },
                complete: function() {
                    // Hide loading indicator
                    $('#audioUploadForm button').html('Upload Audio');
                    $('#audioUploadForm button').prop('disabled', false);
                }
            });
        });
        
        // Create video handling
        $('#createVideoBtn').on('click', function () {
            // Collect all image durations
            let images = [];
            $('.duration-input').each(function () {
                images.push({
                    id: $(this).data('image-id'),
                    duration: $(this).val()
                });
            });
            
            // Get audio id
            let audioId = $('#audioId').val();
            
            if (images.length === 0) {
                alert('Please upload images first.');
                return;
            }
            
            if (!audioId) {
                alert('Please upload audio first.');
                return;
            }
            
            $.ajax({
                url: "<?php echo e(route('video.create')); ?>",
                type: 'POST',
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    images: images,
                    audio_id: audioId
                },
                beforeSend: function() {
                    // Show loading indicator
                    $('#createVideoBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
                    $('#createVideoBtn').prop('disabled', true);
                },
                success: function (response) {
                    if (response.success) {
                        // Display the video player
                        $('#videoPlayer').attr('src', response.video_url);
                        $('#downloadVideoBtn').attr('href', response.video_url);
                        $('#videoPreview').show();
                    } else {
                        alert(response.error || 'Video creation failed.');
                    }
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.message 
                        ? xhr.responseJSON.message 
                        : 'Video creation failed.';
                    alert(errorMessage);
                },
                complete: function() {
                    // Hide loading indicator
                    $('#createVideoBtn').html('Create Video');
                    $('#createVideoBtn').prop('disabled', false);
                }
            });
        });
    });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/videos/index.blade.php ENDPATH**/ ?>