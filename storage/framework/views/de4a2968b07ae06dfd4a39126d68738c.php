
<script type="text/javascript">
$(document).ready(function() {

        
    $('.deleteid').click(function() {
        var id = $(this).data("id");        
        $('#statusselectedid').val(id);
    });
    
    $('#confirmdelete').click(function() {
        var id = $('#statusselectedid').val(); 
        var redirecturl = $('#redirecturl').val();
        window.location = redirecturl+"/"+id+"/destroy";
    });
    
    $('#canceldelete').click(function() {
        $('#statusselectedid').val(0);
    });

    $('.statusid').click(function() { 
        
        var id = $(this).data("id"); 
        $('#statusselectedid').val(id);   
          
    });

    $('#confirmstatus').click(function() {       
        var id = $('#statusselectedid').val(); 
        var redirecturl = $('#redirecturl').val();       
        window.location = redirecturl+"/"+id+"/updatestatus";
    });

   
    $('button').click(function() { 

        var id = $('.statusid').data("id");      
        $('#selectedid').val(id);
    });


    

    $('#cancelstatus').click(function() {
        $('#selectedid').val(0);
    });
    
      $('#confirmapproval').click(function() {
        var id = $('#selectedid').val(); 
        var redirecturl = $('#redirecturl').val();       
        window.location = redirecturl+"/"+id+"/updateapporval";
    });

 $('#cancelapproval').click(function() {
        $('#selectedid').val(0);
    });

    $('.select2').select2({
        placeholder: "Select Menu"
    });
    
    
    
    $('.close').click(function() {
        $('#selectedid').val(0);
    });
});
</script> <?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/layouts/popupscripts.blade.php ENDPATH**/ ?>