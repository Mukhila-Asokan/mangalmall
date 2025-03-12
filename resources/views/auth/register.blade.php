@extends('layouts.guest')

@section('content')

<section class="ptb-100 height-lg-100vh d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center pt-5 pt-sm-5 pt-md-5 pt-lg-0">
            <div class="col-md-6 col-lg-5">
                <div class="card login-signup-card shadow-lg mb-0">
                    <div class="card-body px-md-5 py-5">
                        <div class="mb-5">
                            <h5 class="h3">Create account</h5>
                        </div>
                        <form class="login-signup-form" method="POST" action="{{ route('register/add') }}">
                            @csrf

                            @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                     @endif

                            <div class="form-group">
                                <label class="pb-1">Your Name</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-user color-primary"></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter your name" name="name" value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="pb-1">Email Address</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-email color-primary"></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="name@address.com" name="email" value="{{ old('email') }}" required>
                                </div>
                                    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
                            </div>
                            <div class="form-group">
                                <label class="pb-1">Password</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-lock color-primary"></span>
                                    </div>
                                    <input type="password"  id="password" class="form-control" placeholder="Enter your password" name="password" required>
                                    <div class="input-group-append">
                                                <span class="input-group-text" id="togglePassword" onclick="togglePassword()" style="cursor: pointer;">
                                                    <i class="fas fa-eye" id="eye-icon"></i>
                                                </span>
                                            </div>
                                </div>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label class="pb-1">Confirm Password </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-lock color-primary"></span>
                                    </div>
                                      <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password" required>
                                </div>
                               @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            

                            <div class="my-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="check-terms" name="terms" checked>
                                    <label class="custom-control-label" for="check-terms">I agree to the <a href="#">terms and conditions</a></label>
                                </div>
                            </div>
                            <button class="btn btn-block primary-solid-btn border-radius mt-4 mb-3">
                                Sign up
                            </button>
                        </form>
						</div>
                    </div>
                    <div class="card-footer px-md-5 bg-transparent border-top">
                        <small>Already have an account?</small>
                        <a href="{{ route('login') }}" class="small">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')    
<script>
   
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash"); // Eye slash icon
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye"); // Regular eye icon
        }
    }
</script>
@endpush