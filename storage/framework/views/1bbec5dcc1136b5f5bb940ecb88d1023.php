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
 <div class="col-12">
 
  <div class="card">
	<div class="card-header text-bg-primary">
	  <h4 class="mb-0 text-white">Fill up the form</h4>
	</div>
 
 
<form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('venueadmin/venueadd')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
    <div class="col-12 mt-5">
	

	
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
                                            <label class="col-md-4 col-form-label" for="venuetypename">Venue Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuename" name="venuename" class="form-control" placeholder="Enter the venue name" value = "<?php echo e(old('venuename')); ?>" required>
                                                <?php if($errors->has('venuename')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('venuename')); ?></div>
                                                
                                            <?php endif; ?>
                                            </div>

                                        </div>
                                         <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venueaddress">Venue Location</label>
                                            <div class="col-md-8">
                                                  

                                                 <textarea class="form-control" placeholder="Enter the venue location" id="venueaddress" name = "venueaddress" style="height: 100px"><?php echo e(old('venueaddress')); ?></textarea>
                                                  <?php if($errors->has('venueaddress')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('venuelocation')); ?></div>
                                                 <?php endif; ?>


                                            </div>

                                        </div>
                                          <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuearea">Area</label>
                                            <div class="col-md-8">
                                                  <select id="venuearea" name="venuearea"  placeholder="Enter the Area name" required></select>
                                                <?php if($errors->has('venuearea')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('venuearea')); ?></div>
                                                
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                   <div class="col-6">
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuecity">City</label>
                                            <div class="col-md-8">
                                                <input type = "hidden" name = "locationid" id = "locationid" value = "" />
                                                  <input type="text" id="venuecity" name="venuecity" class="form-control" placeholder="Enter the city name" value = "<?php echo e(old('venuecity')); ?>" required>
                                                <?php if($errors->has('venuecity')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('venuecity')); ?></div>
                                                
                                            <?php endif; ?>
                                            </div>
                                        </div>


                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuestate">State</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuestate" name="venuestate" class="form-control" placeholder="Enter the state name" value = "<?php echo e(old('venuestate')); ?>" required>
                                                <?php if($errors->has('venuestate')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('venuestate')); ?></div>              
                                            <?php endif; ?>
                                            </div>
                                        </div> 

                                         <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuepincode">Pincode</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuepincode" name="venuepincode" class="form-control" placeholder="Enter the pincode name" value = "<?php echo e(old('venuepincode')); ?>" required>
                                                <?php if($errors->has('venuepincode')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('venuepincode')); ?></div>              
                                            <?php endif; ?>
                                            </div>
                                        </div> 

                                    </div> 

                                      <div class="mb-4 row">
                                            <label class="col-md-2 col-form-label" for="description">Description</label>
                                            <div class="col-md-10">
                                                  <textarea class="form-control" placeholder="Enter the venue location" id="description" name = "description" style="height: 100px"><?php echo e(old('description')); ?></textarea>
                                                  <?php if($errors->has('description')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('description')); ?></div>
                                                 <?php endif; ?>
                                            </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                             <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactperson">Contact Person</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactperson" name="contactperson" class="form-control" placeholder="Enter the Contact person name" value = "<?php echo e(old('contactperson')); ?>" required>
                                                <?php if($errors->has('contactperson')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('contactperson')); ?></div>              
                                            <?php endif; ?>
                                            </div>
                                        </div> 
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactmobile">Mobile No</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactmobile" name="contactmobile" class="form-control" placeholder="Enter the Contact Mobile No" value = "<?php echo e(old('contactmobile')); ?>" required>
                                                <?php if($errors->has('contactmobile')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('contactmobile')); ?></div>              
                                            <?php endif; ?>
                                            </div>
                                        </div> 
                                        

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contacttelephone">Telephone No</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contacttelephone" name="contacttelephone" class="form-control" placeholder="Enter the Venue Telephone No" value = "<?php echo e(old('contacttelephone')); ?>" >
                                                <?php if($errors->has('contacttelephone')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('contacttelephone')); ?></div>              
                                            <?php endif; ?>
                                            </div>
                                        </div> 



                                        </div>
                                        <div class="col-6">

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactemail">Email Id</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="contactemail" name="contactemail" class="form-control" placeholder="Enter the Contact Email Id" value = "<?php echo e(old('contactemail')); ?>" >
                                                <?php if($errors->has('contactemail')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('contactemail')); ?></div>              
                                            <?php endif; ?>
                                            </div>
                                        </div> 

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="contactemail">Website</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="websitename" name="websitename" class="form-control" placeholder="Enter the websitename" value = "<?php echo e(old('websitename')); ?>" >
                                                <?php if($errors->has('websitename')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('websitename')); ?></div>              
                                            <?php endif; ?>
                                            </div>
                                        </div> 

                                        </div>
                                        </div>

<div class ="row">
    <div class="col-6">
             <div class="mb-4 row">
                  <label class="col-md-4 col-form-label" for="venuetypeid">Select Venue Type</label>
                   <div class="col-md-8">
                 <select class="form-select" id="venuetypeid" name="venuetypeid" aria-label="Floating label select example">
                                <option selected>Open this Venue Type</option>
                                <?php $__currentLoopData = $venuetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value = "<?php echo e($type->id); ?>"><?php echo e($type->venuetype_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                     <?php if($errors->has('venuetypeid')): ?>
                    <div class="text-danger"><?php echo e($errors->first('venuetypeid')); ?></div>
                    
                <?php endif; ?>
                </div>

             </div>   
</div>
    <div class="col-6">
           <div class="mb-4 row">
                  <label class="col-md-4 col-form-label" for="venuesubtypeid">Select Venue Subtype</label>
                   <div class="col-md-8">
                 <select class="form-select" id="venuesubtypeid" name="venuesubtypeid" aria-label="Floating label select example">
                    <option selected>Open this Venue Subtype</option>
                  </select>
                     <?php if($errors->has('venuesubtypeid')): ?>
                    <div class="text-danger"><?php echo e($errors->first('venuesubtypeid')); ?></div>
                    
                <?php endif; ?>
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
                                                <input type="hidden" name = "datafieldid[]" value = "<?php echo e($datafield->id); ?>" />
                                                  <input type="text" id="datafieldvalue<?php echo e($datafield->id); ?>" name="datafieldvalue[]" class="form-control" placeholder="Enter the <?php echo e($datafield->datafieldname); ?> value" value = "<?php echo e(old('datafieldvalue.$datafield->id')); ?>" >
                                             
                                            </div>
                                            </div>

                                             <?php elseif($datafield->datafieldtype == "Select"): ?>

                                             <?php
                                             $data = $datafield->datafieldvalues;

                                                if($data!="")
                                                {
                                                    $jsonData = json_decode($data, true); 
                                               
                                                ?>


                                                   <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="datafieldvalue"><?php echo e($datafield->datafieldname); ?></label>
                                            <div class="col-md-8">
                                                  <input type="hidden" name = "datafieldid[]" value = "<?php echo e($datafield->id); ?>" /> 
                                                  <select class="form-select" id="datafieldvalue<?php echo e($datafield->id); ?>" name="datafieldvalue[]">

                                                    <option selected>Select this <?php echo e($datafield->datafieldname); ?></option>

                                                     <?php $__currentLoopData = $jsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <option value="<?php echo e($item['id']); ?>"><?php echo e($item['optionname']); ?></option>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                  </select>


                                                
                                               
                                                </div>
                                            </div>
                                           <?php

                                            }
                                                
                                            ?>

                                            <?php elseif($datafield->datafieldtype == "Textarea"): ?>

                                             <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="extradatafield"><?php echo e($datafield->datafieldname); ?></label>
                                            <div class="col-md-8">
                                                 <input type="hidden" name = "datafieldid[]" value = "<?php echo e($datafield->id); ?>" />
                                                  <textarea id="datafieldvalue<?php echo e($datafield->id); ?>" name="datafieldvalue[]" class="form-control" placeholder="Enter the <?php echo e($datafield->datafieldname); ?> value"><?php echo e(old('datafieldvalue.$datafield->id')); ?></textarea>
                                             
                                            </div>
                                            </div>

                                            <?php elseif($datafield->datafieldtype == "Radio"): ?>

                                            <?php
                                             $data = $datafield->datafieldvalues;

                                                if($data!="")
                                                {
                                                    $jsonData = json_decode($data, true); 
                                               
                                                ?>

                                            <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="extradatafield"><?php echo e($datafield->datafieldname); ?></label>
                                            <div class="col-md-8">
                                                 <input type="hidden" name = "datafieldid[]" value = "<?php echo e($datafield->id); ?>" />
                                                 <div class="form-check">
                                                    <?php $__currentLoopData = $jsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <input class="form-check-input" type="radio" name="datafieldvalue[]" id="datafieldvalue<?php echo e($datafield->id); ?>" value = "<?php echo e($item['id']); ?>">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            <?php echo e($item['optionname']); ?>

                                                        </label>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 </div>
                                                
                                            </div>
                                             <?php

                                            }
                                                
                                            ?>

                                            <?php else: ?>
                                               
                                            <?php
                                             $data = $datafield->datafieldvalues;

                                                if($data!="")
                                                {
                                                    $jsonData = json_decode($data, true); 
                                               
                                                ?>

                                            <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="extradatafield"><?php echo e($datafield->datafieldname); ?></label>
                                            <div class="col-md-8">
                                                 <input type="hidden" name = "datafieldid[]" value = "<?php echo e($datafield->id); ?>" />
                                                 <div class="form-check">
                                                    <?php $__currentLoopData = $jsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                         <input class="form-check-input" type="checkbox" value="<?php echo e($item['id']); ?>" name = "datafieldvalue[]"id="datafieldvalue<?php echo e($datafield->id); ?>">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            <?php echo e($item['optionname']); ?>

                                                        </label>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                 
                                              
                                            </div>
                                             <?php

                                            }
                                                
                                            ?>

                                            <?php endif; ?>
                                        
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                        Image
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
                                                        Google Map & Budget
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                        <div class="mb-4 row">
                                         <label for="formFile" class="form-label">Google Map Location Code</label>
                                          
                                            <div class="col-md-10">
                                                  <textarea class="form-control" placeholder="Enter the venue location" id="googlemap" name = "googlemap" style="height: 100px"><?php echo e(old('googlemap')); ?></textarea>
                                                  <?php $__errorArgs = ['googlemap'];
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
									 <label for="formFile" class="form-label">Booking Rate</label>
									  
										<div class="col-md-10">
											  <input type="text" id="bookingprice" name="bookingprice" class="form-control" placeholder="Enter the Booking Price" value = "<?php echo e(old('bookingprice')); ?>" required>
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
        </div>
</div>
</form>
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



      $("#venuetypeid").change(function(e) {


      
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
           
     });

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('venueadmin::layouts.admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/venueuser/create.blade.php ENDPATH**/ ?>