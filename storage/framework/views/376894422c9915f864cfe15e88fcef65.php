

<?php $__env->startSection('content'); ?>
<style>     
        .step-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }
        .step-line {
            flex: 1;
            height: 4px;
            background-color:#40161C;
            margin: 0 10px;
            position: relative;
           /* top: -10px; */
        }
        .step-circle {
            width: 20px; height: 20px; border-radius: 50%;
            background: #40161C;
            color: #fff; font-weight: bold; font-size: 12px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }
        .step-circle:hover { transform: scale(1.1); }
        .active-step { background:  #40161C; }
        .step-content {
            padding: 25px; border-radius: 15px; background: #fff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .btn-custom { background-color: #6c63ff; color: white; font-weight: bold; }
        .btn-custom:hover { background-color: #554dbd; }
        textarea
        {
            height: 50px;
        }
    </style>


<div class="col-lg-8 col-md-8">
<aside class="widget widget-search">
        <form>
            <input class="form-control" type="search" placeholder="Type Search Words">
            <button class="search-button" type="submit"><span class="ti-search"></span></button>
        </form>
</aside>

<div class="container py-5">
        <h5 class="mb-4 text-center text-primary">Make a Website for Your Event</h5>
        <div class="step-header">
            <div class="step-circle" id="stepCircle1">1</div>            
            <div class="step-line"></div>
            <div class="step-circle" id="stepCircle2">2</div>
            <div class="step-line"></div>
            <div class="step-circle" id="stepCircle3">3</div>
        </div>

        <form id="wizardForm" method = 'post' action = "<?php echo e(route('user.webpage.store')); ?>">
        <?php echo csrf_field(); ?>
            <div class="step-content" id="step1">
            <div class="form-group">
            <label for="occasion_type"><h6> <span class="mdi mdi-seat"></span> Step 1: Choose Occasion Type</h6></label>
                <select class="form-control mb-3 has-value" name="occasion_type" id="occasion_type" required>
                    <option value="">Select Occasion</option>
                    <?php $__currentLoopData = $occasiontype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type->id); ?>" <?php echo e(old('occasion_type') == $type->id ? 'selected' : ''); ?>><?php echo e($type->eventtypename); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            </div>

            <div class="step-content d-none" id="step2">
                <h6> <span class="mdi mdi-file-document"></span> Step 2: Fill the forms</h6>
                <div id="datafield">

                </div>
            </div>

            <div class="step-content d-none" id="step3">
                <h4>Step 3: Review Information</h4>
                <p>Please review your entered details before submitting.</p>
            </div>

            <div class="mt-4 text-center">
                <button type="button" class="btn secondary-solid-btn" id="prevBtn"> Previous</button>
                <button type="button" class="btn primary-solid-btn" id="nextBtn">Next </button>
                <button type="submit" class="btn success-solid-btn d-none" id="submitBtn"> Submit</button>
            </div>
        </form>
    </div>


</div>
<div class="col-lg-2 col-md-2"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>

window.addEventListener('load', () => {
        // CKEditor Initialization Observer for dynamically loaded textareas
        const observer = new MutationObserver(() => {
            document.querySelectorAll('.textareadatafield').forEach((textarea) => {
                if (!textarea.classList.contains('ckeditor-applied')) {
                    ClassicEditor.create(textarea).then(editor => {
                        textarea.ckeditorInstance = editor;
                    }).catch(console.error);
                    textarea.classList.add('ckeditor-applied');
                }
            });
        });
        observer.observe(document.getElementById('datafield'), { childList: true, subtree: true });
    });






        let currentStep = 1;
        const totalSteps = 3;


        function showStep(step) {
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('d-none'));
            document.getElementById(`step${step}`).classList.remove('d-none');
            document.querySelectorAll('.step-circle').forEach(circle => circle.classList.remove('active-step'));
            document.getElementById(`stepCircle${step}`).classList.add('active-step');
            window.scrollTo({ top: 200, behavior: 'smooth' });
}

const nextButton = document.getElementById('nextBtn');
    nextButton.addEventListener('click', () => {
        if (currentStep === 2) {
            const requiredFields = document.querySelectorAll('#datafield .form-control');
            let allFilled = true;

            requiredFields.forEach(field => {
                let value = field.classList.contains('textareadatafield') && field.ckeditorInstance 
                    ? field.ckeditorInstance.getData().trim() 
                    : field.value.trim();

                if (!value) {
                    field.classList.add('is-invalid');
                    allFilled = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!allFilled) {
                alert('Please fill out all required fields before proceeding.');
                return;
            }
        }

        collectFormData(); 
        
        console.log('currentStep = ' + currentStep);

    if (currentStep === 2) {
        console.log('currentStep 3');
        displayReviewStep();
    }

        currentStep++;
        showStep(currentStep);
        toggleButtons();
    });


        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentStep > 1) currentStep--;
            showStep(currentStep);
            toggleButtons();
        });

        function toggleButtons() {
            document.getElementById('nextBtn').classList.toggle('d-none', currentStep === totalSteps);
            document.getElementById('submitBtn').classList.toggle('d-none', currentStep !== totalSteps);
            document.getElementById('prevBtn').classList.toggle('d-none', currentStep === 1);
        }

        showStep(currentStep);
        toggleButtons();

        
        const occasionTypeSelect = document.getElementById('occasion_type');
        const dataFieldContainer = document.getElementById('datafield');

        occasionTypeSelect.addEventListener('change', () => {
          
            occasionchange();

        });



        function occasionchange()
        {
            const selectedOccasionId = occasionTypeSelect.value;

           

if (selectedOccasionId) {
    fetch('/home/webpage/occasion/' + selectedOccasionId) 
        .then(response => response.json())
        .then(dataFields => {
            dataFieldContainer.innerHTML = ''; 

            console.log(dataFields);
              let fieldHtml = `<div class="row">`;
            if(dataFields.length > 0) {
                dataFields.forEach(dataField => {

                    if (dataField.datafieldtype === 'text') {    
                    fieldHtml += ` <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="data_fields[${dataField.id}]">${dataField.datafieldname}:</label>
                    `;

                  
                        fieldHtml += `<input type="text" name="data_fields[${dataField.id}]" id="data_fields[${dataField.id}]" class="form-control datafieldvalue">`;

                        fieldHtml += `</div></div>`;
                    } else{

                        fieldHtml += ` <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="data_fields[${dataField.id}]">${dataField.datafieldname}:</label>
                    `;
                        
                        fieldHtml += `<textarea name="data_fields[${dataField.id}]" id="data_fields[${dataField.id}]" class="form-control datafieldvalue textareadatafield">`;
                      
                        fieldHtml += `</textarea>`;
                        fieldHtml += `</div></div>`;
                    }
                    
                   
                });
            } else {
                fieldHtml += "<p>No data fields found for this occasion.</p>";
            }
            fieldHtml += `</div>`;
            dataFieldContainer.innerHTML += fieldHtml;
        })
        .catch(error => {
            console.error('Error fetching data fields:', error);
            dataFieldContainer.innerHTML = "<p>Error fetching data fields. Please try again.</p>";
        });
} else {
    dataFieldContainer.innerHTML = ''; // Clear if no occasion is selected
}


/*const observer = new MutationObserver(() => {
document.querySelectorAll('.textareadatafield').forEach((textarea) => {
if (!textarea.classList.contains('ckeditor-applied')) {
    ClassicEditor.create(textarea).catch(console.error);
    textarea.classList.add('ckeditor-applied');
}
});
});
observer.observe(document.getElementById('datafield'), { childList: true, subtree: true });*/


        }









        let formData = {};

function collectFormData() {
    console.log('collectFormData');
    // Collect inputs with labels
    document.querySelectorAll('.datafieldvalue').forEach(field => {
        let label = field.closest('.form-group')?.querySelector('label')?.innerText?.trim() || field.name;
        let value = field.classList.contains('textareadatafield') && field.ckeditorInstance 
            ? field.ckeditorInstance.getData().trim() 
            : field.value.trim();
        formData[label] = value;
    });
}
function displayReviewStep() {
    console.log('displayReviewStep');
    const reviewContainer = document.getElementById('step3');
    reviewContainer.innerHTML = '<h4>Step 3: Review Information</h4>';
    
    let tableHtml = `
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
    `;
    
    for (const [label, value] of Object.entries(formData)) {
        tableHtml += `
            <tr>
                <td><strong>${label}</strong></td>
                <td>${value || 'N/A'}</td>
            </tr>
        `;
    }

    tableHtml += `
            </tbody>
        </table>
        <p class="mt-3">If everything looks correct, click Submit.</p>
    `;

    reviewContainer.innerHTML += tableHtml;
}



    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/home/userwebpage.blade.php ENDPATH**/ ?>