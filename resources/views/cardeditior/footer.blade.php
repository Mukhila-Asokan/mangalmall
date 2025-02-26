<div class="mangalmall-loader">
    <div class="mangalmall-loader-btn">
        <span>
            Loading 
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" width="31px" height="31px" viewBox="0 0 100 100">
            <g>
                <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#fff" stroke-width="12"></path>
                <path d="M49 3L49 27L61 15L49 3" fill="#fff"></path>
                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
            </g>
        </svg>
    </div>
</div>

<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
<input type="hidden" id="template_id" value="{{ $template_id }}">
<input type="hidden" id="campaign_id" value="{{ $campaign_id ?? '' }}">
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
<script>window.Modernizr || document.write('<script src="js/modernizr.min.js"><\/script>')</script>
<!-- <script src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script> -->
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/aligning_guidelines.min.js') }}"></script>
<script src="{{ asset('assets/js/centering_guidelines.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.toaster.js') }}"></script>
<script src="{{ asset('assets/js/color-name-hue.js') }}"></script>
<script>var admin = true;</script>
<script src="{{ asset('assets/js/fabric.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/coloris.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="{{ asset('assets/js/canvas-custom.js') }}?q={{ time() }}"></script>
<script src="{{ asset('assets/js/editor-custom.js') }}?q={{ time() }}"></script>
<span id="pg_ajax_url" data-ajax_url="{{ url('/') }}"></span>
<script>
/**
 * Color Switcher
 */
const elements = document.getElementsByClassName('pg_colormode_checkbox');
for (let i = 0; i < elements.length; i++) {
    const element = elements[i];
    // Perform actions on the element
    let drag_style = "{{ asset('assets/css/dark-style.css') }}?q=1";
    element.addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('drag_mode').href = drag_style;
            localStorage.setItem('drag_mode_onoff', 1);
        } else {
            document.getElementById('drag_mode').href = '#';
            localStorage.setItem('drag_mode_onoff', 0);
        }
    });
    const checkmode = localStorage.getItem('drag_mode_onoff');
    if (checkmode == 1) {
        document.getElementById('drag_mode').href = drag_style;
        elements[0].checked = true;
    } else {
        document.getElementById('drag_mode').href = '#';
        elements[0].checked = false;
    }
}
</script>


<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>