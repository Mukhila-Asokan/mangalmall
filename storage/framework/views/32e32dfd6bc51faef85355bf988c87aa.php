

<?php $__env->startSection('content'); ?>

<?php 

	$bannerurl =  url('/').Storage::url('/').$venuedetail->bannerimage;

?>
  <!--page header section start-->
        <section class="page-header-section ptb-100 gradient-overly-right" 
        style="background: url('<?php echo e($bannerurl); ?>')no-repeat center center / cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 col-lg-6">
                        <div class="page-header-content text-white">
                            <h1 class="text-white mb-2"><?php echo e($venuedetail->venuename); ?></h1>
                            <p class="lead"><?php echo e($venuedetail->description); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--page header section end-->



<!--breadcrumb bar start-->
<div class="breadcrumb-bar py-3 gray-light-bg border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="custom-breadcrumb">
                    <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0 pl-0">
                        <li class="list-inline-item breadcrumb-item"><a href="#">Home</a></li>
                        <li class="list-inline-item breadcrumb-item"><a href="<?php echo e(route('venuereact.search')); ?>">Venue </a></li>
                        <li class="list-inline-item breadcrumb-item active"><?php echo e($venuedetail->venuename); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumb bar end-->

  <div class="module ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">

                    	  <!-- Post-->
                        <article class="post">
                            <div class="post-preview"><img src="<?php echo e($bannerurl); ?>" alt="article" class="img-fluid" style="max-height:300px"/></div>
                            <div class="post-wrapper">
                                <div class="post-header">
                                    <h1 class="post-title"><?php echo e($venuedetail->venuename); ?></h1>                                    
                                </div>
                                <div class="post-content">
                               
                                        <p><?php echo e($venuedetail->description ?? ''); ?></p><br>
                                        
                                        <p><?php echo e($venuedetail->address  ?? ''); ?></p><br>

                                        <?php echo e($venuedetail->venuecontent->first()->description  ?? ''); ?>


                                        <?php echo purify($venuedetail->venuecontent->first()->description); ?>

                                    

                                   
                                </div>
                                <div class="post-footer">
                                    <div class="post-tags"><a href="#">Venue </a><a href="#">City</a><a href="#">State</a></div>
                                </div>
                            </div>
                        </article>
               </div> 
                  <div class="col-lg-4 col-md-4">
                        <div class="sidebar-right pl-4">
                        	 <aside class="widget widget-categories">
                                <div class="widget-title">
                                    <h6>Contact Details</h6>
                                </div>
                                <ul>
                                    <li>Contact Person - <?php echo e($venuedetail->contactperson); ?></li>
                                    <li>Contact Mobile - <?php echo e($venuedetail->contactmobile); ?></li>
                                    <li>Office Number - <?php echo e($venuedetail->contacttelephone); ?></li>
                                    <li>Email - <?php echo e($venuedetail->contactemail); ?></li>
                                    <li>Website - <?php echo e($venuedetail->websitename); ?></li>
                                    
                                </ul>
                            </aside>
                            <br>
                            <aside class="widget widget-categories">
                                <div class="widget-title">
                                    <h6>Amenities</h6>
                                </div>
                                <ul>
                                	<?PHP

                                    $amenitiesarray = json_decode($venuedetail->venueamenities, true); 
                                    

                                    foreach($venueamenities as $amenities):
                                        
                                        if(in_array($amenities->id, $amenitiesarray))
                                        {
                                            echo '<li>'.$amenities->amenities_name.'</li>';
                                        }
                                    endforeach;

                                ?>
                                    
                                </ul>
                            </aside>
                            <br>
                             <aside class="widget widget-categories">
                                <div class="widget-title">
                                    <h6>Features</h6>
                                </div>
                                <ul>
                                    <?PHP
                                    $venuedataarray = json_decode($venuedetail->venuedata, true); 
                                    $i=0;
                                     foreach($venuedatafield as $datafield):

                                        $value = $venuedatafielddetails->firstWhere('id',$venuedataarray[$i])->optionname ?? $venuedataarray[$i];
                                        
                                        echo '<li>'.$datafield->datafieldname.' - '.$value.' '.$datafield->datafieldnametype.'</li>';

                                      
                                      $i++;
                                    endforeach;

                                ?>
                                    
                                </ul>
                            </aside>
                        </div>
                   </div>	

             </div>  
        </div> 
    </div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/home/venuedetail.blade.php ENDPATH**/ ?>