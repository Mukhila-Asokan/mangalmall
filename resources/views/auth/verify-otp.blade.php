@extends('layouts.guest')


@section('content')
 <section class="ptb-100 height-lg-100vh d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                    <div class="col-md-6 col-lg-5">
                        <div class="card login-signup-card shadow-lg mb-0">
                            <div class="card-body px-md-5 py-5">
								  <div class="mb-5">
                                    <h5 class="h3">Verify Your Email</h5>
                                    <p class="text-muted mb-0">Registration</p>
                                </div>
  
    <form method="POST" action="{{ route('otp.verify.submit') }}">
        @csrf
        <div class="form-group">
            <label for="otp">Enter OTP</label>
            <input type="text" name="otp" id="otp" class="form-control" required>
            @error('otp')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-block primary-solid-btn border-radius mt-4 mb-3">Verify</button>
    </form>
</div>
                            <div class="card-footer bg-transparent px-md-5"><small>Not registered?</small>
                                <a href="{{ route('register') }}" class="small"> Create account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
