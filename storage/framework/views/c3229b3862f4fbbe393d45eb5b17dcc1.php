<?php $__env->startSection('content'); ?>


<div class="col-lg-10 col-md-10">
                        <!-- Search widget-->

 <div class="row">
        <?php echo $__env->make('profile-layouts.sticky', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="col-lg-11 col-md-11 stickymenucontent shadow-sm">

<div class="row p-5 mt-md-4 mt-lg-4">  
    <div class="col-11"> 
     
       <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Occasion</th>
                    <th>Place</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>                                
            </thead>
            <tbody>
                <?php
                    $i=1;
                ?>
                    <?php $__currentLoopData = $useroccasion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><p><?php echo e($i++); ?></p></td>
                            <td><p><?php echo e($occasion->occasiondate); ?></p></td>
                            <td><p><?php echo e($occasion->Occasionname->eventtypename); ?></p></td>
                            <td><p><?php echo e($occasion->occasion_place); ?></p></td>
                            <td><p><?php echo e($occasion->notes); ?></p></td>
                            <td><a href="#" id = "editoccasion" onclick = "editoccasion(<?php echo e($occasion->id); ?>)"><span class="ti-pencil"></span></a> <a href="#"><span class="ti-trash"></span></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
       </table>
   
    </div>
    <div class="col-1">
             <div class="text-end">
    <a type="button" class="btn primary-solid-btn" id="addoccasion" data-toggle="modal" data-target="#addoccasionpopup">Add</a></div>
    </div>
</div>
</div>
</div>
</div>
<div class="col-lg-2 col-md-2">

<?php echo $__env->make('profile-layouts.rightside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>



<div class="modal fade" id="addoccasionpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="homemodal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Occasion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method = "post" action = "<?php echo e(route('home/occasion/add')); ?>">
      <div class="modal-body">
           <?php echo csrf_field(); ?>
            <div class="form-row">
            <div class="col-12">
                <div class="form-group">
                    <input type="Date" class="form-control" name="occasiondate" id="occasiondate" placeholder="Select Date" required="required">
                </div>
                <input type = "hidden" name = "userid" value = "<?php echo e($userid); ?>" />
            </div>
            <div class="col-12">
                <div class="form-group">
                    <select class="form-control" name="occasiontype" id="occasiontype" required="required">
                        <option>Select Occasion</option>
                        <?php $__currentLoopData = $occasiontype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($typename->id); ?>" ><?php echo e($typename->eventtypename); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
			   <div class="col-12">
                <div class="form-group">
				  <input type="text" id="countryInput" placeholder="Select Occasion Place" name="occasion_place" class="form-control">                
                </div>
               
            </div>
            <div class="col-12">
                <div class="form-group">
                    <textarea name="message" id="message" class="form-control" rows="5" cols="25" placeholder="Notes"></textarea>
                </div>
            </div>
           
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn secondary-outline-btn" data-dismiss="modal">Close</button>
        <button type="submit" class="btn primary-solid-btn" id ="savebutton">Add</button>
        <button type="button" class="btn primary-solid-btn" id ="updateoccasion" style="display:none">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>

<?php

	$str = '[';
	foreach($areaname as $aname):
	 $str .= '"'.$aname->Areaname.'",' ; 

	endforeach;
	
	 $str = rtrim($str, ','); 
	 $str .= ']';
 
?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css"></script>
   <script>
        const countries =  <?PHP echo $str; ?>
        ;

        function autocomplete(inp, arr) {
            let currentFocus;
            
            inp.addEventListener("input", function(e) {
                let value = this.value.toLowerCase();
                let autocompleteList = document.querySelector('.autocomplete-items') || 
                                       createAutocompleteContainer(inp);
                
                // Clear previous matches
                autocompleteList.innerHTML = '';
                
                // Find matching countries
                let matches = arr.filter(country => 
                    country.toLowerCase().includes(value)
                );

                // Create suggestion items
                matches.forEach(country => {
                    let div = document.createElement("div");
                    div.innerHTML = country;
                    
                    div.addEventListener("click", function() {
                        inp.value = this.innerHTML;
                        autocompleteList.innerHTML = '';
                    });
                    
                    autocompleteList.appendChild(div);
                });
            });

            // Close suggestions when clicking outside
            document.addEventListener("click", function(e) {
                if (e.target !== inp) {
                    let autocompleteList = document.querySelector('.autocomplete-items');
                    if (autocompleteList) autocompleteList.innerHTML = '';
                }
            });

            function createAutocompleteContainer(inputElement) {
                let container = document.createElement('div');
                container.classList.add('autocomplete-items');
                inputElement.parentNode.appendChild(container);
                return container;
            }
        }

        // Initialize autocomplete
        autocomplete(document.getElementById("countryInput"), countries);
    </script>
	<script>
		function editoccasion(id)
		{
				alert(id);
        $.ajax({
            url: '/home/occasion/edit',
            method: 'POST',
            data: {  _token:$('meta[name="_token"]').attr('content'), id:id },		
            success: function(response) {
               console.log(response);
              
            }
        });
		}
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/occasion.blade.php ENDPATH**/ ?>