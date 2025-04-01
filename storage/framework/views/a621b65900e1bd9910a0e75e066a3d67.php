<?php use App\Models\UserChecklist; ?>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
.sortable-list {
    min-height: 200px; /* Ensures containers have enough space for drag and drop */
    background-color: #f1f1f1;
    border: 2px dashed #ddd;
    padding: 10px;
}

.checklist-item {   
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.ui-state-highlight {
    background-color:rgb(228, 204, 134);  /* Highlight placeholder when dragging */
    height: 50px;
    border: 2px dashed #666;
}


    </style>
<?php $__env->startSection('content'); ?>
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        <?php echo $__env->make('profile-layouts.sticky', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="col-lg-11 col-md-11 stickymenucontent">  
        <div class="container">
    
        <h4 class="text-center">Budget Board</h4>
       



    <div class = "row">

       
        <div class="col-md-12 mb-12">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <!-- Event Title + Add Budget Button -->
                  

                    <hr class="my-3">

                    <div class = "row">
                    <!-- Total Summary Section -->
<!-- Total Summary Section -->
<div class = "col-md-6 col-6">

    <h4 class="mt-5 mb-5 text-center"> <?php echo e($userOccasion->Occasionname->eventtypename); ?></h4>                       


    <div class="card p-4 mb-4 shadow-sm">
        <h4 class="text-center mb-3">Total Amount Summary</h4>
        <div class="d-flex justify-content-between p-2 bg-light rounded">
            <span class="fw-bold text-primary">
                <input type = "hidden"  id = "totalplanned-amount" value = "<?php echo e($planned_amount); ?>">  
                <input type = "hidden"  id = "totalcompleted-amount" value = "<?php echo e($completed_amount); ?>">
                Planned Amount: <span id="total-planned"><?php echo e($planned_amount); ?></span>
            </span>
            <span class="fw-bold text-success">
                Actual Amount: <span id="total-actual"><?php echo e($completed_amount); ?></span>
            </span>
        
        </div>
    
    </div>
    <div class ="text-end" style="float:right;">
      
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addbudgetModal">
            Add New
        </a>
    </div>
</div>
<!-- Chart Section -->
<div class = "col-md-6 col-6">
    <div class="card p-4 shadow-lg">
        <h4 class="text-center mb-3">Chart Summary</h4>
        <canvas id="amountChart" style="max-height: 250px; width: 100%;"></canvas>
    </div>
</div>
                    </div>
<hr class="my-3">



 <ul class="sortable-list list-unstyled">
    <?php $__currentLoopData = $budget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="checklist-item card p-3 mb-3 d-flex align-items-center shadow-lg position-relative" data-id="<?php echo e($bud->id); ?>">
    <div class="d-flex flex-column w-100">
    <div class="d-flex justify-content-between align-items-center">
        <span>
            <h5 class="text-primary">
                <strong>Budget Name:</strong> <?php echo e($bud->name ?? 'N/A'); ?>

            </h5>
        </span>

        <!-- Trash Icon for Delete -->
        <i class="fas fa-trash-alt text-danger delete-icon"
           data-id="<?php echo e($bud->id); ?>"
           data-name="<?php echo e($bud->name); ?>"
           style="cursor: pointer;"></i>
    </div>

    <hr class="my-2 w-100">

    <div class="d-flex justify-content-between align-items-center">
        <span>
            <strong>Planned Amount:</strong>
            <span id="planned-amount-<?php echo e($bud->id); ?>" class="planned-amount"><?php echo e($bud->planned_amount ?? '0'); ?></span>
        </span>

        <span>
            <strong>Actual Amount:</strong>
            <span id="actual-amount-<?php echo e($bud->id); ?>" class="actual-amount"><?php echo e($bud->completed_amount ?? '0'); ?></span>
        </span>

        <!-- Edit Icon (Shows on Hover) -->
        <i class="fas fa-edit edit-icon text-primary"
           data-bs-toggle="modal"
           data-bs-target="#editModal"
           data-id="<?php echo e($bud->id); ?>"
           data-planned="<?php echo e($bud->planned_amount); ?>"
           data-actual="<?php echo e($bud->completed_amount); ?>"
           style="cursor: pointer; display: none;"></i>
    </div>
</div>

    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
                  
                    
                </div>
            </div>
        </div>
       
    </div>


</div>
        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2">
    <?php echo $__env->make('profile-layouts.rightside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<!-- Add Checklist Modal -->
<div class="modal fade" id="addbudgetModal" aria-labelledby="addbudgetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addbudgetModalLabel">Add New Budget Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="document.getElementById('addBudgetForm').reset();"> X </button>
            </div>

            <div class="modal-body">
                <form id="addBudgetForm" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Checklist Item Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Budget Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="planned_amount" class="form-label">Budget Planned Amount</label>
                        <input type="text" class="form-control" id="planned_amount" name="planned_amount" required>
                    </div>

                    <!-- Hidden Occasion ID -->
                    <input type="hidden" name="useroccasion_id" value="<?php echo e($userOccasion->id ?? ''); ?>">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Item</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="document.getElementById('addBudgetForm').reset();">
    Cancel
</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Editing Amounts -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Amounts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="document.getElementById('editAmountForm').reset();"> X </button>
            </div>

            <div class="modal-body">
                <form id="editAmountForm" method="POST" action="<?php echo e(route('userbudget.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" id="edit-id">

                    <div class="mb-3">
                        <label for="edit-planned-amount" class="form-label">Planned Amount</label>
                        <input type="number" class="form-control" id="edit-planned-amount" name="planned_amount" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-actual-amount" class="form-label">Actual Amount</label>
                        <input type="number" class="form-control" id="edit-actual-amount" name="completed_amount" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Alert -->
<div id="success-alert" class="alert alert-success position-fixed bottom-0 end-0 m-3" 
     style="display: none;">
    Amounts updated successfully!
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {

    
    let amountChart;
        // Function to calculate totals
  
        function calculateTotals() {
    // Initialize totals
    let totalPlanned = 0;
    let totalActual = 0;

    // Sum up existing planned and actual amounts from the checklist
    document.querySelectorAll('.planned-amount').forEach(el => {
        totalPlanned += parseFloat(el.innerText) || 0;
    });

    document.querySelectorAll('.actual-amount').forEach(el => {
        totalActual += parseFloat(el.innerText) || 0;
    });

    // Read existing total amounts
    let totalplanned = parseFloat(document.getElementById('totalplanned-amount').value) || 0;
    let totalcompleted = parseFloat(document.getElementById('totalcompleted-amount').value) || 0;

    // Ensure calculated totals overwrite previous totals
    totalplanned = totalPlanned;
    totalcompleted = totalActual;

    // Display updated totals
    document.getElementById('totalplanned-amount').value = totalplanned.toFixed(2);
    document.getElementById('totalcompleted-amount').value = totalcompleted.toFixed(2);

    document.getElementById('total-planned').innerText = totalplanned.toFixed(2);
    document.getElementById('total-actual').innerText = totalcompleted.toFixed(2);

    // Update Chart
    updateChart(totalplanned, totalcompleted);
}


        calculateTotals(); // Initial Calculation

        // Show edit icon on hover
        const listItems = document.querySelectorAll('.checklist-item');
        listItems.forEach(item => {
            item.addEventListener('mouseover', () => {
                item.querySelector('.edit-icon').style.display = 'inline-block';
            });
            item.addEventListener('mouseleave', () => {
                item.querySelector('.edit-icon').style.display = 'none';
            });
        });




        document.querySelector('.sortable-list').addEventListener('mouseover', function(e) {
    if (e.target.classList.contains('checklist-item')) {
        const editIcon = e.target.querySelector('.edit-icon');
        if (editIcon) {
            editIcon.style.display = 'inline-block';
        }
    }
});

document.querySelector('.sortable-list').addEventListener('mouseleave', function(e) {
    if (e.target.classList.contains('checklist-item')) {
        const editIcon = e.target.querySelector('.edit-icon');
        if (editIcon) {
            editIcon.style.display = 'none';
        }
    }
});




        // Fill modal with values
        document.querySelectorAll('.edit-icon').forEach(icon => {
            icon.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const plannedAmount = this.getAttribute('data-planned');
                const actualAmount = this.getAttribute('data-actual');

                document.getElementById('edit-id').value = id;
                document.getElementById('edit-planned-amount').value = plannedAmount;
                document.getElementById('edit-actual-amount').value = actualAmount;
            });
        });

        // Form Submission Handling
        document.getElementById('editAmountForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const id = document.getElementById('edit-id').value;
            const plannedAmount = document.getElementById('edit-planned-amount').value;
            const actualAmount = document.getElementById('edit-actual-amount').value;

            fetch(`<?php echo e(route('userbudget.update')); ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    id: id,
                    planned_amount: plannedAmount,
                    completed_amount: actualAmount
                })
            })
            .then(response => response.json())
            .then(data => {


                totalplanned = document.getElementById('totalplanned-amount').value;
                totalcompleted = document.getElementById('totalcompleted-amount').value;

                  var newplannedamount = plannedAmount;
                  var newactualamount = actualAmount;

                  totalplanned = parseFloat(totalplanned);
                  totalcompleted = parseFloat(totalcompleted);
                
                totalplanned += parseFloat(newplannedamount);
                totalcompleted += parseFloat(newactualamount);
                document.getElementById('totalplanned-amount').value = totalplanned;
                document.getElementById('totalcompleted-amount').value = totalcompleted;

                document.getElementById('total-planned').innerText = totalplanned.toFixed(2);
                document.getElementById('total-actual').innerText = totalcompleted.toFixed(2);

                updateChart(totalplanned, totalcompleted);

                // Update values directly on the page
                document.getElementById(`planned-amount-${id}`).innerText = plannedAmount;
                document.getElementById(`actual-amount-${id}`).innerText = actualAmount;

                calculateTotals();

                Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Amounts updated successfully!',
                timer: 2000
            });

          
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                modal.hide();
                document.getElementById('editAmountForm').reset();
            })
            .catch(error => console.error('Error:', error));
        });



        document.getElementById('addBudgetForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("<?php echo e(route('userbudget.store')); ?>", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    var newamount = data.budget.planned_amount;

                      
                    totalplanned = document.getElementById('totalplanned-amount').value;
                    totalcompleted = document.getElementById('totalcompleted-amount').value; 
                    totalplanned = parseFloat(totalplanned);
                    totalcompleted = parseFloat(totalcompleted);
                    totalplanned += parseFloat(newamount);
                    updateChart(totalplanned, totalcompleted);
                    document.getElementById('totalplanned-amount').value = totalplanned;    
                    document.getElementById('total-planned').innerText = totalplanned.toFixed(2);

                    // Append the new item to the checklist
                    const newItem = `
                        <li class="checklist-item card p-3 mb-3 d-flex align-items-center shadow-lg position-relative" data-id="${data.budget.id}">
                            <div class="d-flex flex-column w-100">
                                <span>
                                    <h5 class="text-primary"><strong>Budget Name:</strong> ${data.budget.name}</h5>
                                </span>
                                <hr class="my-2 w-100">

                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        <strong>Planned Amount:</strong> 
                                        <span id="planned-amount-${data.budget.id}" class="planned-amount">${data.budget.planned_amount}</span>
                                    </span>

                                    <span>
                                        <strong>Actual Amount:</strong> 
                                        <span id="actual-amount-${data.budget.id}" class="actual-amount">0</span>
                                    </span>

                                    <i class="fas fa-edit edit-icon text-primary"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editModal"
                                       data-id="${data.budget.id}"
                                       data-planned="${data.budget.planned_amount}"
                                       data-actual="0"
                                       style="cursor: pointer; display: none;"></i>
                                </div>
                            </div>
                        </li>
                    `;

                    document.querySelector('.sortable-list').insertAdjacentHTML('beforeend', newItem);

                    // Update totals
                    calculateTotals();

                    // Display success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'New budget item added successfully!',
                        timer: 2000
                    }).then((result) => {
                        if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                            location.reload(); // Reloads the page
                        }
                    });

                  

                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addbudgetModal'));
                    modal.hide();

                    // Reset the form
                    document.getElementById('addBudgetForm').reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to add new budget item. Please try again.',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again later.',
                });
            });
        });




        // Handle Budget Deletion with SweetAlert Confirmation
    document.querySelector('.sortable-list').addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-icon')) {
            const budgetId = e.target.getAttribute('data-id');
            const budgetName = e.target.getAttribute('data-name');

            // SweetAlert Confirmation
            Swal.fire({
                title: `Are you sure you want to delete "${budgetName}"?`,
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX Request for Deletion
                    fetch(`<?php echo e(route('userbudget.destroy', '')); ?>/${budgetId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the deleted item from the DOM
                            e.target.closest('.checklist-item').remove();

                            // Update Totals and Chart
                            calculateTotals();

                            // Success Message
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: `The budget "${budgetName}" has been deleted.`,
                                timer: 2000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to delete the budget item.',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again later.',
                        });
                    });
                }
            });
        }
    });











      
        function updateChart(totalPlanned, totalActual) {
            const ctx = document.getElementById('amountChart').getContext('2d');

            if (amountChart) {
                amountChart.destroy();
            }

            amountChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Planned Amount', 'Actual Amount'],
                    datasets: [{
                        data: [totalPlanned, totalActual],
                        backgroundColor: ['#9e1b32', '#FFC72C'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }






    });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/userbudget/create.blade.php ENDPATH**/ ?>