<input type="hidden" name="selectedid" id="selectedid" value="0">
<input type="hidden" name="statusselectedid" id="statusselectedid" value="0">

<!-- Info Alert Modal -->
<div id="info-alert-modal" class="modal fade statusModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="bx bxs-info-circle h1 text-info"></i>
                    <h4 class="mt-2">{{  $pagetitle ?? ' Home ' }}</h4>
                    <p class="mt-3">Do you really want to change the status ?</p>
                     <button type="button" class="btn btn-success my-2" id="confirmstatus">Yes </button>
                    <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">No </button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


  <!-- Danger Alert Modal -->
<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="bx bx-aperture h1 text-white"></i>
                    <h4 class="mt-2 text-white">Oh Snap!</h4>
                    <p class="mt-3 text-white">Do you really want to delete these record?</p>
                       <button type="button" class="btn btn-danger" id="confirmdelete">Delete</button>
                    <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    
  

</script>