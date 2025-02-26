

<?php $__env->startSection('content'); ?>

<style type="text/css">
    .form-check-input[type=checkbox] {
        border: 1px solid black;
    }

    .imageOutput img {
        width: 200px;
        height: auto;
    }

    #venuearea-selectized {
        width: 100% !important;
        border: none !important;
    }
</style>

<link href="<?php echo e(asset('adminassets/libs/selectize/css/selectize.bootstrap3.css')); ?>" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Edit Venue</h4>

                <div class="text-end">
                    <a href="<?php echo e(route('venue/index')); ?>" class="btn btn-primary">
                        <span class="tf-icon mdi mdi-eye me-1"></span> Venue List
                    </a>
                </div>
                <br>
                <form action="<?php echo e(route('venue.update', $venue->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- Venue Details -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="true">
                                    Venue Details
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-4">
                                                <label class="form-label">Venue Name</label>
                                                <input type="text" name="venuename" class="form-control" value="<?php echo e($venue->venuename); ?>" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Venue Location</label>
                                                <textarea name="venueaddress" class="form-control" required><?php echo e($venue->venueaddress); ?></textarea>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Area</label>
                                                <select id="venuearea" name="venuearea" placeholder="Enter the Area name" class="form-control">
                                                    <option value="<?php echo e($venue->locationid); ?>"><?php echo e($venue->area->areaname ?? ''); ?></option>
                                                </select>
                                                <input type="hidden" name="locationid" id="locationid" value="<?php echo e($venue->locationid); ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-4">
                                                <label class="form-label">City</label>
                                                <input type="text" name="venuecity" id = "venuecity" class="form-control" value="<?php echo e($venue->city->cityname ?? ''); ?>" >
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">State</label>
                                                <input type="text" name="venuestate" id = "venuestate"  class="form-control" value="<?php echo e($venue->state->statname  ?? ''); ?>" >
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Pincode</label>
                                                <input type="text" name="venuepincode" id = "venuepincode" class="form-control" value="<?php echo e($venue->indianlocation->pincode ?? ''); ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label class="col-md-2 col-form-label" for="description">Description</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" placeholder="Enter the description about venue" id="description" name="description" style="height: 100px"><?php echo e($venue->description); ?></textarea>
                                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="contactperson">Contact Person</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="contactperson" name="contactperson" class="form-control" placeholder="Enter the Contact person name" value="<?php echo e($venue->contactperson); ?>" required>
                                                    <?php $__errorArgs = ['contactperson'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="contactmobile">Mobile No</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="contactmobile" name="contactmobile" class="form-control" placeholder="Enter the Contact Mobile No" value="<?php echo e($venue->contactmobile); ?>" required>
                                                    <?php $__errorArgs = ['contactmobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="contacttelephone">Telephone No</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="contacttelephone" name="contacttelephone" class="form-control" placeholder="Enter the Venue Telephone No" value="<?php echo e($venue->contacttelephone); ?>">
                                                    <?php $__errorArgs = ['contacttelephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="contactemail">Email Id</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="contactemail" name="contactemail" class="form-control" placeholder="Enter the Contact Email Id" value="<?php echo e($venue->contactemail); ?>">
                                                    <?php $__errorArgs = ['contactemail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="websitename">Website</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="websitename" name="websitename" class="form-control" placeholder="Enter the website name" value="<?php echo e($venue->websitename); ?>">
                                                    <?php $__errorArgs = ['websitename'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                                <div class="mb-4 row">
                                                    <label class="col-md-4 col-form-label" for="bookingprice">Booking Rate <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="bookingprice" name="bookingprice" class="form-control" placeholder="Enter the Booking Price" value="<?php echo e(old('bookingprice', $venue->bookingprice)); ?>">
                                                        <?php $__errorArgs = ['bookingprice'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="text-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="venuetypeid">Select Venue Type <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                <select class="form-select" id="venuetypeid" name="venuetypeid" aria-label="Floating label select example">
                                                    <option value="">Choose Venue Type</option>
                                                    <?php $__currentLoopData = $venuetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($type->id); ?>" <?php echo e(old('venuetypeid', $venue->venuetypeid) == $type->id ? 'selected' : ''); ?>>
                                                            <?php echo e($type->venuetype_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                    <?php $__errorArgs = ['venuetypeid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="budgetperplate">Budget Per Plate</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="budgetperplate" name="budgetperplate" class="form-control" placeholder="Enter the budget per plate" value="<?php echo e(old('budgetperplate', $venue->budgetperplate)); ?>">
                                                    <?php $__errorArgs = ['budgetperplate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="capacity">Seating Capacity <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" id="capacity" name="capacity" class="form-control" placeholder="Enter the capacity" value="<?php echo e(old('capacity', $venue->capacity)); ?>">
                                                    <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="mb-4 row">
                                                <label class="col-md-4 col-form-label" for="food_type">Food Type <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <select id="food_type" name="food_type" class="form-control">
                                                        <option>Select Food Type</option>
                                                        <option value="Veg" <?php echo e(old('food_type', $venue->food_type) == 'Veg' ? 'selected' : ''); ?>>Veg</option>
                                                        <option value="Non-Veg" <?php echo e(old('food_type', $venue->food_type) == 'Non-Veg' ? 'selected' : ''); ?>>Non-Veg</option>
                                                        <option value="Both" <?php echo e(old('food_type', $venue->food_type) == 'Both' ? 'selected' : ''); ?>>Both (Veg & Non-Veg)</option>
                                                    </select>
                                                    <?php $__errorArgs = ['food_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Select Amenities -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo">
                                    Select Amenities
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="col-6" style="margin-left: 30px;">
                                        <?php $__currentLoopData = $venueamenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="venueamenities[]"
                                                value="<?php echo e($amenity->id); ?>" 
                                                <?php echo e(in_array($amenity->id, json_decode($venue->venueamenities, true) ?? []) ? 'checked' : ''); ?>>
                                            <label class="form-check-label"><?php echo e($amenity->amenities_name); ?></label>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Data Fields -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree">
                                    Add Data Fields
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="row">
                                        <?php
                                            $venueDataArray = json_decode($venue->venuedata, true); // Convert JSON to array
                                        ?>
                                        <?php $__currentLoopData = $venuedatafield; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $datafield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-6">
                                            <div class="mb-4">
                                                <label class="col-md-4 col-form-label"><?php echo e($datafield->datafieldname); ?></label>
                                                <div class="col-md-8">
                                                    <input type="text" name="datafieldvalue[<?php echo e($datafield->id); ?>]" class="form-control"
                                                        value="<?php echo e($venueDataArray[$index] ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFour">
                                    Image Upload
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="mb-4">
                                        <label class="form-label">Upload Banner Image</label>
                                        <input class="form-control" type="file" name="bannerimage">
                                        <?php if($venue->bannerimage): ?>
                                        <div class="imageOutput mt-2">
                                            <img src="<?php echo e(asset('storage/' . $venue->bannerimage)); ?>" alt="Venue Banner">
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Google Map & Budget -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFive">
                                    Google Map
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="mb-4">
                                        <label class="form-label">Google Map Location Code</label>
                                        <textarea name="googlemap" class="form-control"><?php echo e($venue->googlemap); ?></textarea>
                                    </div>                                  
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Update Venue</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php
    $areaOptions = $arealocation->map(function($area) {
        return [
            'id' => $area->id,
            'title' => $area->areaname  // or $area->Areaname depending on your attribute name
        ];
    });
?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">

    $images = $('#categoryiconimage')
    $(".imageUpload").change(function(event){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            $.each(input.files, function() {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $images.html('<img src="'+ e.target.result+'" />')
                }
                reader.readAsDataURL(this);
            });
        }
    }

</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
/*
    var areaOptions = <?php echo json_encode($areaOptions); ?>;
    $('#venuearea').selectize({
        valueField: 'id',
        labelField: 'title',
        searchField: 'title',
        options: areaOptions,
        create: false
    });*/


    $('#venuearea').select2({
    placeholder: 'Search for an area',
    allowClear: true,
    ajax: {
        url: "<?php echo e(route('venue/create/ajaxarealist')); ?>", // Route to fetch data
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term, // Send search term to backend
            };
        },
        processResults: function (data) {
            console.log(data.results); // Debug API response
            return {
                results: data.results // Use 'results' key from API response
            };
        },
        cache: true,
    },
    minimumInputLength: 1,
});




    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });

    $("#venuearea").change(function(e) {
        e.preventDefault();
        var area_id = $(this).val();

        $.ajax({
            type: 'POST',
            url: "<?php echo e(route('venue/create/ajaxcitylist')); ?>",
            dataType: 'json',
            data: { "_token": "<?php echo e(csrf_token()); ?>", "area_id": area_id },
            success: function(response) {
                var returnData = response;              
                
                $("#venuecity").val(returnData['city']);
                $("#venuestate").val(returnData['state']);
                $("#venuedistrict").val(returnData['district']);
                $("#venuepincode").val(returnData['pincode']);
                $("#locationid").val(returnData['id']);
            }
        });
    });

    $("#venuetypeid").change(function(e) {
        e.preventDefault();
        var venuetypeid = $(this).val();

        $.ajax({
            type: 'POST',
            url: "<?php echo e(route('venue/create/ajaxcvenuesubtypelist')); ?>",
            dataType: 'json',
            data: { "_token": "<?php echo e(csrf_token()); ?>", "venuetypeid": venuetypeid },
            success: function(response) {
                $("#venuesubtypeid").empty();
                var returnData = response;
                if (returnData.length > 0) {
                    let casestr = '<option>Select Venue Sub Type</option>';
                    for (i = 0; i < returnData.length; i++) {
                        casestr += '<option value="' + returnData[i]['id'] + '">' + returnData[i]['venuetype_name'] + '</option>';
                    }
                    $("#venuesubtypeid").append(casestr);
                } else {
                    alert("No Data");
                }
            }
        });
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venues/edit.blade.php ENDPATH**/ ?>