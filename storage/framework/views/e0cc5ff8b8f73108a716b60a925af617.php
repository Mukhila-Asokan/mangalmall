<?php $__env->startSection('content'); ?>
  <!--page header section start-->
 

             <div class="col-lg-9 col-md-9" >
             <h5 class="m-3">Welcome <?php echo e(ucwords(strtolower(Auth::user()->name))); ?></h5>

                   
				   <?php $prurl = "frontassets/img/herobg-5.png"; ?>
                <div class="page-header-section" style="background: url('<?php echo e(asset($prurl)); ?>')no-repeat center center / cover;height: 100px;">
                    <div class="row align-items-center">
                        <div class="col-md-7 col-lg-6">
                            <div class="page-header-content text-white">
                                <h1 class="text-white mb-2 p-4">Profile Dashboard</h1>
                                <p class="lead"></p>
                            </div>
                        </div>
                    </div>
                 </div>

            <hr>
            <div class="row mt-2">
            <div class="col-lg-2 col-md-2 mt-2">
              <div class="hexagon">
                  <div class="card-content">
                      <!-- Heading at the Top -->
                      <div class="mb-2 heading">Occasion</div>

                      <!-- Value at the Bottom -->
                      <div class="value">
                          <div class="card-text">0</div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-2 col-md-2 mt-2">
              <div class="hexagon">
                  <div class="card-content">
                      <!-- Heading at the Top -->
                      <div class="mb-2 heading">Guest</div>

                      <!-- Value at the Bottom -->
                      <div class="value">
                          <div class="card-text">0</div>
                      </div>
                  </div>
              </div>
          </div>
              
              
            <div class="col-lg-2 col-md-2 mt-2">
              <div class="hexagon">
                  <div class="card-content">
                      <!-- Heading at the Top -->
                      <div class="mb-2 heading">Card Design</div>

                      <!-- Value at the Bottom -->
                      <div class="value">
                          <div class="card-text">0</div>
                      </div>
                  </div>
              </div>
          </div>
          
            <div class="col-lg-2 col-md-2 mt-2">
              <div class="hexagon">
                  <div class="card-content">
                      <!-- Heading at the Top -->
                      <div class="mb-2 heading">Checklist Plan</div>

                      <!-- Value at the Bottom -->
                      <div class="value">
                          <div class="card-text">0</div>
                      </div>
                  </div>
              </div>
          </div>
            <div class="col-lg-2 col-md-2 mt-2">
                <div class="hexagon">
                    <div class="card-content">
                    <div class="mb-2 heading"> Budget</div>
                           <!-- Value at the Bottom -->
                      <div class="value">
                          <div class="card-text">0</div>
                      </div>
                            </div>
                            
                        </div>
             </div>
               
        
            <div class="col-lg-2 col-md-2 mt-2">
              <div class="hexagon">
                  <div class="card-content">
                      <!-- Heading at the Top -->
                      <div class="mb-2 heading">Total Blog</div>

                      <!-- Value at the Bottom -->
                      <div class="value">
                          <div class="card-text">0</div>
                      </div>
                  </div>
              </div>
          </div>

            </div>
            <hr>

                   

                    <div class="row mt-2">
                    <div class="col-lg-12 col-md-12" >
                  
                    <?php echo $__env->make('profile-layouts.blog', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                   
                   
              
                </div>
                	<div class="bg-flower-bot">
                      <img src="<?php echo e(asset('frontassets/img/flower.png')); ?>">
            </div>
				
            </div>
            <div class="col-lg-3 col-md-3 widget widget-categories">
                
                
  
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-12 col-xl-12">

        <div class="card" style="border-radius: 15px;">
          <div class="card-body text-center">
            <div class="mt-3 mb-4">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                class="rounded-circle img-fluid" style="width: 100px;" />
            </div>
            <h4 class="mb-2"><?php echo e(Auth::user()->name); ?></h4>
            <p class="text-muted mb-4">@Programmer <span class="mx-2">|</span> <a
                href="#!">reldelmercado.com</a></p>
            <div class="mb-4 pb-2">
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn primary-solid-btn">
                <i class="fab fa-facebook-f fa-lg"></i>
              </button>
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn primary-solid-btn">
                <i class="fab fa-twitter fa-lg"></i>
              </button>
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn primary-solid-btn">
                <i class="fab fa-skype fa-lg"></i>
              </button>
            </div>
            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn primary-solid-btn">
              Message now
            </button>
            <div class="d-flex justify-content-between text-center mt-5 mb-2">
              <div>
                <p class="mb-2 h5">8471</p>
                <p class="text-muted mb-0">Wallets Balance</p>
              </div>
              <div class="px-3">
                <p class="mb-2 h5">8512</p>
                <p class="text-muted mb-0">Income amounts</p>
              </div>
              <div>
                <p class="mb-2 h5">4751</p>
                <p class="text-muted mb-0">Total Transactions</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
 <br>
 <hr>     
            </div>
      



<?php $__env->stopSection(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/dashboard.blade.php ENDPATH**/ ?>