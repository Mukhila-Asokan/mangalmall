
<?php $__env->startSection('content'); ?>
<style type="text/css"></style>
<!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0"><?php echo $pagetitle; ?></h4>
                </div>
                <div class="col-lg-6">
                   <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Venue</a></li>
                        <li class="breadcrumb-item active">Venue Detailed View</li>
                    </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

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
                        <div class="col-8">


                        <table class="table table-bordered border-primary mb-0 font-weight-bold">
                        <tbody>
                            <tr>
                                <td><h4 class="header-title">Venue Type</h4></td>
                                <td colspan="2"><?php echo e($venuedetails->venuettype->venuetype_name); ?> -> <?php echo e($venuedetails->venuetsubtype->venuetype_name); ?></td>
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
                         
                         <a href = "<?php echo e(url('/admin/venue/'.$venuedetails->id.'/edit')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-pencil me-1"></span>Edit
                           </a>



                     
                         <a href = "<?php echo e(route('venue/index')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-printer me-1"></span>Print
                           </a>
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

<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venues/detailview.blade.php ENDPATH**/ ?>