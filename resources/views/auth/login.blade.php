@extends('layouts.guest')

@section('content')


    <section class="ptb-100 height-lg-100vh d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                    <div class="col-md-6 col-lg-5">
                        <div class="card login-signup-card shadow-lg mb-0">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-5">
                                    <h5 class="h3">Login</h5>
                                    <p class="text-muted mb-0">Sign in to your account to continue.</p>
                                </div>

                                <!--login form-->
                                <form class="login-signup-form">
                                    <div class="form-group">
                                        <label class="pb-1">Email Address</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-email color-primary"></span>
                                            </div>
                                            <input type="email" class="form-control" placeholder="name@domain.com" name = "email">
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label class="pb-1">Password</label>
                                            </div>
                                            <div class="col-auto">
                                                <a href="recover-account.html" class="form-text small text-muted">
                                                    Forgot password?
                                                </a>
                                            </div>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-lock color-primary"></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Enter your password" name ="password">
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <button class="btn btn-block primary-solid-btn border-radius mt-4 mb-3">
                                        Sign in
                                    </button>

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