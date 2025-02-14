<?php $__env->startSection('content'); ?>
<style type="text/css">
    
    .form-check-input[type=checkbox]
    {
        border:1px solid black;
    }

    .imageOutput img
    {
        width:200px;
        height:auto;
    }
</style>
 <link href="<?php echo e(asset('adminassets/libs/selectize/css/selectize.bootstrap3.css')); ?>" rel="stylesheet" type="text/css" />


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Venue</h4>
                       
                        <div class="text-end">
                         <a href = "<?php echo e(route('venue/index')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Venue List
                           </a>
                        </div>
                  
                          <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('venue.venue_add')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="col-12">

                                           <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Venue Details
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">

                          <div class="row">
                                  <div class="col-6">                    
                                          <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label required" for="venuetypename">Venue Name <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuename" name="venuename" class="form-control " placeholder="Enter the venue name" value = "<?php echo e(old('venuename')); ?>" #a32206>
                                                <?php $__errorArgs = ['venuename'];
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
                                            <label class="col-md-4 col-form-label" for="venueaddress">Venue Address <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                  

                                                 <textarea class="form-control" placeholder="Enter the venue Address" id="venueaddress" name = "venueaddress" style="height: 100px"><?php echo e(old('venueaddress')); ?></textarea>
                                                 <?php $__errorArgs = ['venueaddress'];
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
                                            <label class="col-md-4 col-form-label" for="venuearea">Area <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                  <select id="venuearea" name="venuearea"  placeholder="Enter the Area name" ></select>
                                                  <?php $__errorArgs = ['venuearea'];
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
                                            <label class="col-md-4 col-form-label" for="venuecity">City </label>
                                            <div class="col-md-8">
                                                <input type = "hidden" name = "locationid" id = "locationid" value = "" />
                                                  <input type="text" id="venuecity" name="venuecity" class="form-control" placeholder="Enter the city name" value = "<?php echo e(old('venuecity')); ?>" >
                                                  <?php $__errorArgs = ['venuecity'];
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
                                            <label class="col-md-4 col-form-label" for="venuestate">State</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuestate" name="venuestate" class="form-control" placeholder="Enter the state name" value = "<?php echo e(old('venuestate')); ?>" >
                                                  <?php $__errorArgs = ['venuestate'];
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
                                            <label class="col-md-4 col-form-label" for="venuepincode">Pincode</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuepincode" name="venuepincode" class="form-control" placeholder="Enter the pincode name" value = "<?php echo e(old('venuepincode')); ?>" >
                                                  <?php $__errorArgs = ['venuepincode'];
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

                                    <div class="mb-4 row">
                                            <label class="col-md-2 col-form-label" for="description">Description <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                  <textarea class="form-control" placeholder="Enter the Description" id="description" name = "description" style="height: 100px"><?php echo e(old('description')); ?></textarea>
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
                                            <label class="col-md-4 col-form-label" for="contactperson">Contact Person <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactperson" name="contactperson" class="form-control" placeholder="Enter the Contact person name" value = "<?php echo e(old('contactperson')); ?>" >
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
                                            <label class="col-md-4 col-form-label" for="contactmobile">Mobile No <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactmobile" name="contactmobile" class="form-control" placeholder="Enter the Contact Mobile No" value = "<?php echo e(old('contactmobile')); ?>" >
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
                                                  <input type="text" id="contacttelephone" name="contacttelephone" class="form-control" placeholder="Enter the Venue Telephone No" value = "<?php echo e(old('contacttelephone')); ?>" >
                                               
                                            </div>
                                        </div> 



                                        </div>
                                        <div class="col-6">

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactemail">Email Id</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactemail" name="contactemail" class="form-control" placeholder="Enter the Contact Email Id" value = "<?php echo e(old('contactemail')); ?>" >
                                                 
                                            </div>
                                        </div> 

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactemail">Website</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="websitename" name="websitename" class="form-control" placeholder="Enter the websitename" value = "<?php echo e(old('websitename')); ?>" >
                                                
                                            </div>
                                        </div> 

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="bookingprice">Booking Rate <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                            <input type="text" id="bookingprice" name="bookingprice" class="form-control" placeholder="Enter the Booking Price" value = "<?php echo e(old('bookingprice')); ?>" >
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

<div class ="row">
    <div class="col-6">
             <div class="mb-4 row">
                  <label class="col-md-4 col-form-label" for="venuetypeid">Select Venue Type <span class="text-danger">*</span></label>
                   <div class="col-md-8">
                 <select class="form-select" id="venuetypeid" name="venuetypeid" aria-label="Floating label select example">
                                <option selected>Choose Venue Type</option>
                                <?php $__currentLoopData = $venuetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value = "<?php echo e($type->id); ?>" <?php echo e(old('venuetypeid') == $type->id ? 'selected' : ''); ?> ><?php echo e($type->venuetype_name); ?></option>
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
                  <label class="col-md-4 col-form-label" for="budgetperplate">Budget Per Plate </label>
                   <div class="col-md-8">
                 
                        <input type="text" id="budgetperplate" name="budgetperplate" class="form-control" placeholder="Enter the budget per plate" value = "<?php echo e(old('budgetperplate')); ?>" >
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
                 
                        <input type="text" id="capacity" name="capacity" class="form-control" placeholder="Enter the capacity" value = "<?php echo e(old('capacity')); ?>" >
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
                 
                        <select id="food_type" name="food_type" class="form-control" >
                            <option selected>Select Food Type</option>
                            <option value="Veg" <?php echo e(old('food_type') == 'Veg' ? 'selected' : ''); ?>>Veg</option>
                            <option value = "Non-Veg" <?php echo e(old('food_type') == 'Non-Veg' ? 'selected' : ''); ?>>Non-Veg</option>
                            <option value = "Both" <?php echo e(old('food_type') == 'Both' ? 'selected' : ''); ?>>Both (Veg & Non-Veg) </option>
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
</div></div>
      </div>
           </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">Select Amenities
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">


                                         
                                    <div class="col-6" style="margin-left: 30px;">
                                        
                                         <?php $__currentLoopData = $venueamenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <div class="mt-3">
                                             <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?php echo e($amenities->id); ?>" id="venueamenities" name="venueamenities[]">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                    <?php echo e($amenities->amenities_name); ?>

                                                </label>
                                             </div>
                                        </div>

                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div></div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                        Add Data Fields
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        
                                                    <?php $__currentLoopData = $venuedatafield; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datafield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($datafield->datafieldtype == "Text"): ?>
        <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="datafieldvalue<?php echo e($datafield->id); ?>"><?php echo e($datafield->datafieldname); ?></label>
            <div class="col-md-8">
                <input type="hidden" name="datafieldid[]" value="<?php echo e($datafield->id); ?>" />
                <input type="text" id="datafieldvalue<?php echo e($datafield->id); ?>" name="datafieldvalue[]" class="form-control" placeholder="Enter the <?php echo e($datafield->datafieldname); ?> value" value="<?php echo e(old('datafieldvalue.' . $loop->index)); ?>">
            </div>
        </div>

    <?php elseif($datafield->datafieldtype == "Select"): ?>
        <?php
            $data = $datafield->datafieldvalues;
            if($data!="") {
                $jsonData = json_decode($data, true);
            }
        ?>

        <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="datafieldvalue<?php echo e($datafield->id); ?>"><?php echo e($datafield->datafieldname); ?></label>
            <div class="col-md-8">
                <input type="hidden" name="datafieldid[]" value="<?php echo e($datafield->id); ?>" />
                <select class="form-select" id="datafieldvalue<?php echo e($datafield->id); ?>" name="datafieldvalue[]">
                    <option selected>Select this <?php echo e($datafield->datafieldname); ?></option>
                    <?php $__currentLoopData = $jsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item['id']); ?>" <?php if(old('datafieldvalue.' . $loop->parent->index) == $item['id']): ?> selected <?php endif; ?>><?php echo e($item['optionname']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

    <?php elseif($datafield->datafieldtype == "Textarea"): ?>
        <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="datafieldvalue<?php echo e($datafield->id); ?>"><?php echo e($datafield->datafieldname); ?></label>
            <div class="col-md-8">
                <input type="hidden" name="datafieldid[]" value="<?php echo e($datafield->id); ?>" />
                <textarea id="datafieldvalue<?php echo e($datafield->id); ?>" name="datafieldvalue[]" class="form-control" placeholder="Enter the <?php echo e($datafield->datafieldname); ?> value"><?php echo e(old('datafieldvalue.' . $loop->index)); ?></textarea>
            </div>
        </div>

    <?php elseif($datafield->datafieldtype == "Radio"): ?>
        <?php
            $data = $datafield->datafieldvalues;
            if($data!="") {
                $jsonData = json_decode($data, true);
            }
        ?>

        <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="datafieldvalue<?php echo e($datafield->id); ?>"><?php echo e($datafield->datafieldname); ?></label>
            <div class="col-md-8">
                <input type="hidden" name="datafieldid[]" value="<?php echo e($datafield->id); ?>" />
                <div class="form-check">
                    <?php $__currentLoopData = $jsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input class="form-check-input" type="radio" name="datafieldvalue[]" id="datafieldvalue<?php echo e($datafield->id); ?>" value="<?php echo e($item['id']); ?>" <?php if(old('datafieldvalue.' . $loop->parent->index) == $item['id']): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="datafieldvalue<?php echo e($datafield->id); ?>">
                            <?php echo e($item['optionname']); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                        Image <span class="text-danger">*</span>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                        <div class="mb-4 row">
                                         <label for="formFile" class="form-label">Image Uplaod</label>
                                        <input class="form-control imageUpload" type="file" id="formFile" name = "bannerimage">
                                        </div>

                                         <div id = "categoryiconimage" class="imageOutput"></div>

                                        <!--div class="mb-4 row">
                                            <label for="formFileMultiple" class="form-label">Gallery Image</label>
  <input class="form-control" type="file" id="formFileMultiple" multiple>
                                        </div-->




                                                    </div>
                                                </div>
                                            </div>
				
				<div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                                        Google Map
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                        <div class="mb-4 row">
                                         <label for="formFile" class="form-label">Google Map Location Code</label>
                                          
                                            <div class="col-md-10">
                                                  <textarea class="form-control" placeholder="Enter the venue location" id="googlemap" name = "googlemap" style="height: 100px"><?php echo e(old('googlemap')); ?></textarea>
                                              
                                            </div>
                                  

                                        </div>
								
										
                                    

                                                    </div>
                                                </div>
                                            </div>





                                        </div>









                                        <br><br>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Venue </button>
                                                </div>
                                            </div>
                                        </div>
										  </div>
        </div>   </div>
                                    </form>
                 
                </div>
</div>
</div>
</div>
          

<?php 
    $areaContent = ''; 

    foreach ($arealocation as $key => $area) {
        $areaContent .= '{id: '.$area['id'].', title: "' . $area['Areaname'] . '"},'; 
    }

    // Remove the trailing comma
    $areaContent = rtrim($areaContent, ','); 

   
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
<script src="<?php echo e(asset('adminassets/libs/selectize/js/standalone/selectize.min.js')); ?>"></script>
<script type="text/javascript">
    
  

    $('#venuearea').selectize({
 
  valueField: 'id',
  labelField: 'title',
  searchField: 'title',
  options: [<?PHP echo $areaContent; ?> 
  ],
  create: false
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
           type:'POST',
           url:"<?php echo e(route('venue/create/ajaxcitylist')); ?>",
           dataType: 'json',
           data:{ "_token": "<?php echo e(csrf_token()); ?>", "area_id" :area_id},
           success:function(response){     
            var returnData = response;          
            $("#venuecity").val(returnData[0]['City']);
            $("#venuestate").val(returnData[0]['State']);
            $("#venuepincode").val(returnData[0]['Pincode']);
            $("#locationid").val(returnData[0]['id']);
                   
         }        
          
        });
           
     });



      /*$("#venuetypeid").change(function(e) {


      
        e.preventDefault();   
        var venuetypeid = $(this).val();

        $.ajax({
           type:'POST',
           url:"<?php echo e(route('venue/create/ajaxcvenuesubtypelist')); ?>",
           dataType: 'json',
           data:{ "_token": "<?php echo e(csrf_token()); ?>", "venuetypeid" :venuetypeid},
           success:function(response){  
            $("#venuesubtypeid").empty();   
            var returnData = response;   
            if(returnData.length>0)
            {
                let casestr = '<option>Select Venue Sub Type</option>';
                for(i=0;i<returnData.length;i++)
                {
                    casestr  += '<option value = "' + returnData[i]['id'] + ' ">' + returnData[i]['venuetype_name'] + '</option>';
                }
             console.log(casestr);       
           
             $("#venuesubtypeid").append(casestr);
            }
            else
            {
                alert("No Data")
            }
         }        
          
        });
           
     });*/







</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venues/create.blade.php ENDPATH**/ ?>