</div>
    </div>
    <input id="csrf_token" type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
    <!-- Notification HTML -->
    <div class="mt_hide" id="notificationBox">
        <div class="mt_success_flex">
            <div class="mt_happy_img">
                <img src="" class="mt_notify_img">
            </div>
            <div class="mt_yeah">
            </div>
        </div>
    </div>

    </div>
    <script>window.websitelink = "<?= base_url() ?>";</script>
    <script>window.baseurl = "<?= base_url() ?>";</script>
	<script src="<?= base_url() ?>assets/editor_assets/js/jquery.nice-select.min.js"></script>
	<script src="<?= base_url() ?>assets/editor_assets/js/range.js"></script>
	<script src="<?= base_url() ?>assets/editor_assets/js/dropzone.min.js"></script>
	<script src="<?= base_url() ?>assets/editor_assets/js/spectrum.js"></script>
    <script src="<?= base_url() ?>assets/editor_assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/editor_assets/js/editor.js?q=<?= date('his') ?>"></script>
    <script src="<?= base_url() ?>assets/js/custom.js?q=<?= date('his') ?>"></script>
    <script src="<?= base_url() ?>assets/editor_assets/js/common.js?q=<?= date('his') ?>"></script>
    <script src="<?= base_url() ?>assets/editor_assets/js/custom.js?q=<?= date('his') ?>"></script>
    <?php if( $this->session->userdata('u_type') == 1 ){ ?>
        <script src="<?= base_url() ?>assets/js/page_js/admin.js?q=<?= date('his') ?>"></script>
    <?php } ?>
  </body>
</html>