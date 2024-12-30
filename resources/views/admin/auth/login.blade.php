@extends('admin.layouts.auth-layout')
<style>
	.bg-login {
 
  background-size: 300px!important;
  background-repeat: no-repeat!important;
}
</style>
@section('content')

 <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block card shadow-lg rounded my-5 overflow-hidden">
                            <div class="row" style="background-color: #F4EAEB!important;">
                                <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center w-75 mx-auto auth-logo mb-4">
                                            <a href="#" class="logo-dark">
                                                <span><img src="{{ asset('adminassets/images/logo-dark.png') }}" alt="" height="75"></span>
                                            </a>

                                            <a href="#" class="logo-light">
                                                <span><img src="{{ asset('adminassets/images/logo-light.png') }}" alt="" height="75"></span>
                                            </a>
                                        </div>


                                        <h1 class="h5 mb-1">Welcome Back!</h1>

                                        <p class="text-muted mb-4">Enter your email address and password to access admin
                                            panel.</p>

                                        <form action="{{ route('admin.authcheck') }}" method="post">
                                        	@csrf


                                        @if(Session::has('error')) 
                                            <span style="color:red;">{{ Session::get('error') }}</span>
                                         @endif
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div style="color:red;">{{ $error }}</div>
                                             @endforeach
                                        @endif

                                            <div class="form-group mb-3">
                                                <label class="form-label" for="emailaddress">Email address</label>
                                                <input class="form-control" type="email" id="emailaddress" required="" value="" name="email"
                                                    placeholder="Enter your email">
                                            </div>

                                            <div class="form-group mb-3">
                                                <a href="pages-recoverpw.html"
                                                    class="text-muted float-end"><small></small></a>
                                                <label class="form-label" for="password">Password</label>
                                                <input class="form-control" type="password" required="" id="password" value="" name="password"
                                                    placeholder="Enter your password">
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="">
                                                    <input class="form-check-input" type="checkbox" id="checkbox-signin"
                                                        checked>
                                                    <label class="form-check-label ms-2" for="checkbox-signin">Remember
                                                        me</label>
                                                </div>
                                            </div>

                                            <div class="form-group mb-0 text-center">
                                                <button class="btn btn-primary w-100" type="submit"> Log In </button>
                                            </div>
                                        </form>



                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
@endsection