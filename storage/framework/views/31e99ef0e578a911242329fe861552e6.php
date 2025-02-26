
<?php $__env->startSection('content'); ?>
<style type="text/css"></style>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                           <div class="text-end">
                         <a href = "<?php echo e(route('venue/index')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>List Venue
                           </a>
                        </div>
                        <div class="row">
                        <div class="col-8" id = "printableTable">


                        <table class="table table-bordered border-primary mb-0 font-weight-bold">
                        <tbody>
                            <tr>
                                <td><h4 class="header-title">Venue Type</h4></td>
                                <td colspan="2"><?php echo e($venuedetails->venuettype->venuetype_name); ?></td>
                            </tr>

                            <tr>
                                <td><h4 class="header-title">Name - <?php echo e($venuedetails->venuename); ?></h4></td>
                                <td colspan="2" class="text-center">
                                    <img src = "<?php echo e(url('/').Storage::url('/').$venuedetails->bannerimage); ?>" style="width:100px" /></td>
                            </tr>
                            <tr>
                                <td rowspan="4"><h4 class="header-title">Location</h4></td>
                                <td>Address</td>
                                <td><?php echo e($venuedetails->venueaddress); ?></td>
                            </tr>
                            <tr>
                                <td>Area</td>
                                <td><?php echo e($venuedetails->indianlocation->Areaname); ?></td>                              
                            </tr>
                            <tr>
                                <td>City & District</td>
                                <td><?php echo e($venuedetails->indianlocation->City); ?>, <?php echo e($venuedetails->indianlocation->District); ?></td>                              
                            </tr>
                               <tr>
                                <td>State</td>
                                <td><?php echo e($venuedetails->indianlocation->State); ?></td>                              
                            </tr>
                            <tr><td><h4 class="header-title">Description</h4></td>
                                <td colspan="2"><?php echo e($venuedetails->description); ?></td>
                            </tr>
                            <tr>
                                <td rowspan="5"><h4 class="header-title">Contact Details</h4></td>
                                <td>Contact Person</td>
                                <td><?php echo e($venuedetails->contactperson); ?></td>
                            </tr>
                            <tr>
                                <td>Mobile No</td>
                                <td><?php echo e($venuedetails->contactmobile); ?></td>                              
                            </tr>
                            <tr>
                                <td>Landline</td>
                                <td><?php echo e($venuedetails->contacttelephone); ?></td>                              
                            </tr>
                            <tr>
                                <td>Email Id</td>
                                <td><?php echo e($venuedetails->contactemail); ?></td>                              
                            </tr>
                            <tr>
                                <td>Website</td>
                                <td><?php echo e($venuedetails->websitename); ?></td>                              
                            </tr>
                            <tr>
                                <td><h4 class="header-title">Booking Rate</h4></td>
                                <td colspan="2"><?php echo e($venuedetails->bookingprice); ?></td>                              
                            </tr>
                            <tr>
                                <td><h4 class="header-title">Seating Capacity</h4></td>
                                <td colspan="2"><?php echo e($venuedetails->capacity); ?></td>                              
                            </tr>
                            <tr>
                                <td><h4 class="header-title">Budget Per Plate</h4></td>
                                <td colspan="2"><?php echo e($venuedetails->budgetperplate); ?></td>                              
                            </tr>
                            <tr>
                                <td><h4 class="header-title">Food Type</h4></td>
                                <td colspan="2"><?php echo e($venuedetails->food_type); ?></td>                              
                            </tr>
                             <tr>
                                <td><h4 class="header-title">Amenities</h4></td>
                                

                                <td colspan="2">
                                    <ul>

                                   <?PHP

                                    $amenitiesarray = json_decode($venuedetails->venueamenities, true); 
                                    

                                    foreach($venueamenities as $amenities):
                                        
                                        if(in_array($amenities->id, $amenitiesarray))
                                        {
                                            echo '<li>'.$amenities->amenities_name.'</li>';
                                        }
                                    endforeach;

                                ?>
                            </ul>


                                </td>
                            </tr>
                            <tr>
                                <td><h4 class="header-title">Features</h4></td>
                                <td colspan="2">
                                    <ul>

                                   <?PHP
                                    $venuedataarray = json_decode($venuedetails->venuedata, true); 
                                    $i=0;
                                     foreach($venuedatafield as $datafield):

                                        $value = $venuedatafielddetails->firstWhere('id',$venuedataarray[$i])->optionname ?? $venuedataarray[$i];
                                        
                                        echo '<li>'.$datafield->datafieldname.' - '.$value.' '.$datafield->datafieldnametype.'</li>';

                                      
                                      $i++;
                                    endforeach;

                                ?>
                            </ul>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                      </div>
                      <div class="col-4">

                            <a href = "<?php echo e(url('/admin/venue/'.$venuedetails->id.'/venueimage')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end" target="_new">
                                <span class="tf-icon mdi mdi-file-image me-1"></span>Venue Gallery
                           </a>

                           <a href = "<?php echo e(url('/admin/venue/'.$venuedetails->id.'/venuecontent')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end" target="_new">
                                <span class="tf-icon mdi mdi-note-text me-1"></span>Venue Content
                           </a>


                            <a href = "<?php echo e(url('/admin/venue/'.$venuedetails->id.'/webpage')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end" target="_new">
                                <span class="tf-icon mdi mdi-webpack me-1"></span>Webpage Design
                           </a>

                            <a href = "<?php echo e(url('/admin/venue/'.$venuedetails->id.'/bookingdetails')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-book-open me-1"></span>Booking Details
                           </a>

                         
                             <a href = "<?php echo e(url('/admin/venue/'.$venuedetails->id.'/edit')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-pencil me-1"></span>Edit
                               </a>



                     
                         <button class="btn btn-primary waves-effect waves-light mb-4 text-end" onclick="printTable();">
                                <span class="tf-icon mdi mdi-printer me-1"></span>Print
                           </button>
                            <a href = "<?php echo e(url('/admin/venue/'.$venuedetails->id.'/themebuilder')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-file me-1"></span>Theme Builder
                           </a>


                        
                      </div>
                    </div>
              




                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<script>
   
function printTable() {
    // Get the HTML of div
    var divElements = document.getElementById("printableTable").innerHTML;
    // Get the HTML of whole page
    var oldPage = document.body.innerHTML;

    // Reset the page's HTML with div's HTML only
    document.body.innerHTML =  divElements ;

    // Print Page
    window.print();

    // Restore orignal HTML
    document.body.innerHTML = oldPage;
}

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venues/detailview.blade.php ENDPATH**/ ?>