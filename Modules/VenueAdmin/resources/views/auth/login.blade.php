@extends('venueadmin::layouts.auth-layout')
@section('content')

@php 

$url = asset("venueasset/images/flower.png");

@endphp

<div class="col-xxl-4 col-lg-4" style="background-color: #f9efe1;">
                        <div class="position-relative rounded-3 overflow-hidden">
                            <div class="card bg-transparent mb-0">
                            <!-- Logo-->
                            <div class="auth-brand text-center">
                                <a href="#" class="logo-light">
                                    <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="logo" height="75">
                                </a>
                                <a href="#" class="logo-dark">
                                    <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="dark logo" height="75">
                                </a>
                            </div>
                            
              
              
              
              
                            <div class="card-body p-4">
                                <div class="w-100 text-center">
                                    <h4 class="pb-0 fw-bold">Welcome to Mangal Mall</h4>
                                    <p class="fw-semibold mb-4">Venue Admin</p>
                                </div>

                               <form name = "login" id="login_form" method = "post" action="{{ route('venue/logincheck') }}">
                                 @csrf

                                      <div class="mb-3">
        <label for="mobileno" class="form-label">Mobile No</label>
        <input type="text" class="form-control" id="mobileno" name="mobileno" aria-describedby="mobileno">

        
         @error('mobileno')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror

      </div>
    
      <div class="errormessage">
      </div>

      <div class="mb-3" style="display:none" id = "mobileotp">
        <label for="mobileno" class="form-label">OTP</label>
          <div class="input-group mb-3 otp-input-group">
              <input class="form-control mobileotp" type="text" name = "mobileotp[]" value="" placeholder="-" maxlength="1">
              <input class="form-control mobileotp" type="text" name = "mobileotp[]" value="" placeholder="-" maxlength="1">
              <input class="form-control mobileotp" type="text" name = "mobileotp[]" value="" placeholder="-" maxlength="1">
              <input class="form-control mobileotp" type="text" name = "mobileotp[]" value="" placeholder="-" maxlength="1">
          </div>
          @error('mobileotp')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          <a href="" class="font-14 font-color d-flex justify-content-center" id="resend_otp">Resend OTP</a>
      </div>

      <div class="infomessage">
      </div>

      
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check d-flex">
          <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
          <label class="form-check-label text-dark fs-3" for="flexCheckChecked">
            Remember this Device
          </label>
        </div>
      </div>
      <button href="#" class="btn btn-primary w-100 py-8 mb-4 rounded-2"  type ="button" id = "loginsubmit" >Get OTP</button>
      <button href="#" class="btn btn-primary w-100 py-8 mb-4 rounded-2"  type ="submit" id = "loginsignin" style="display: none;">Sign In</button>
      <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-medium">New to Mangal Mall?</p>
        <a class="text-primary fw-medium ms-2" href="{{ route('venueadmin/register') }}">Register Here</a>
      </div>
                                </form>
                            </div> <!-- end card-body -->
              
              
              
              
              
              
              
              
              
              
                        </div>
                        <!-- end card -->
                    </div>

            
            
            
            

                    </div> <!-- end col -->
          
          
          




@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
  

  $("#loginsubmit, #resend_otp").click(function(e) {
    e.preventDefault();
    var mobileno = $("#mobileno").val();

    $.ajax({
           type:'POST',
           url:"{{ route('mobileotp') }}",
           dataType: 'json',
           data:{ "_token": "{{ csrf_token() }}", "mobileno" :mobileno},
           success:function(response){
            console.log(response);
            if(response['status'] == 'failed')
            {
              $('.errormessage').html(' <div class="alert alert-danger">'+response['message']+'</div>');
            }
            else
            {
              $('.errormessage').css('display','none');
              $("#loginsubmit").css('display','none');
              $("#loginsignin").css('display','block');
              $("#mobileotp").css('display','block');
              $('.infomessage').html(' <div class="alert alert-info">'+response['message']+'</div>');
              
            }
         },
         error: function(response) {
            console.log(response);
  
             var errors = response.responseJSON.errors;

         }         
          
        });

  });

  $('#login_form').on('submit', function(e){
    let allFilled = $(".mobileotp").filter(function() {
        return $(this).val().trim() === "";
    }).length === 0;

    if(!allFilled){
      e.preventDefault();
      $("#loginsubmit").trigger('click');
    }
  })

</script>

@endpush