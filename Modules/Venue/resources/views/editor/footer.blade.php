</div>
    </div>
  <input id="csrf_token" type="hidden" name="_token" value="{{ csrf_token() }}">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>window.websitelink = "{{ url('/') }}";</script>
    <script>window.baseurl = "{{ url('/') }}";</script>
	<script src="{{ asset('adminassets/editor_assets/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('adminassets/editor_assets/js/range.js') }}"></script>
	<script src="{{ asset('adminassets/editor_assets/js/dropzone.min.js') }}"></script>
	<script src="{{ asset('adminassets/editor_assets/js/spectrum.js') }}"></script>
    <script src="{{ asset('adminassets/editor_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminassets/editor_assets/js/editor.js') }}"></script>
    <script src="{{ asset('adminassets/js/custom.js') }}"></script>
   

    <script src="{{ asset('adminassets/editor_assets/js/common.js') }}"></script>
    <script src="{{ asset('adminassets/editor_assets/js/custom.js') }}"></script>
    <script src="{{ asset('adminassets/js/page_js/admin.js') }}"></script>
  
  </body>
</html>