@extends('admin.layouts.app-admin')
@section('content')

<style type="text/css">
    .pointer {cursor: pointer;}

</style>

<!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">{!! $pagetitle !!}</h4>
                </div>
                <div class="col-lg-6">
                   <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Change Password</h4>
                        <p class="sub-header"> User can change the password in this page</p>

                          <div class="row">
                            <div class="col-12">
                                <div class="p-2">
                                    <form class="form-horizontal" role="form" method = "post" action="{{ route('admin.passwordupdate') }}">
                                        @csrf
                                        <div class="col-6">
                                        <div class="mb-2 row">
                                            <label class="col-md-4 col-form-label" for="oldpassword">Old Password</label>
                                            <div class="col-md-8">
                                                 <div class="input-group">
                                                    <div class="input-group-text pointer" id="toggleoldPassword" onclick="toggleOldPassword()"><i data-lucide ="eye" id="togOld"></i></div>
                                                <input type="password" id="oldpassword" name = "oldpassword" class="form-control" value="" required>
                                              </div>
                                                @if($errors->has('oldpassword'))
                                                <div class="text-danger">{{ $errors->first('oldpassword') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>
                                         <div class="mb-2 row">
                                            <label class="col-md-4 col-form-label" for="newpassword">New  Password</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <div class="input-group-text pointer" id="toggleNewPassword" onclick="toggleNewPassword()"><i data-lucide ="eye" id="togNew"></i></div>
                                                <input type="password" id="newpassword" name="newpassword" class="form-control" value="" required>
                                                </div>
                                                @if($errors->has('newpassword'))
                                                <div class="text-danger">{{ $errors->first('newpassword') }}</div>
                                            @endif
                                            </div>
                                             
                                        </div>
                                        <div class="mb-2 row">
                                            <label class="col-md-4 col-form-label" for="confirmpassword">Confirm Password</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <div class="input-group-text pointer" id="toggleConfirmPassword" onclick="toggleConfirmPassword()"><i data-lucide ="eye" id="togCon"></i></div>
                                                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" value="" required>
                                                 
                                                </div>
                                                @if($errors->has('confirmpassword'))
                                                <div class="text-danger">{{ $errors->first('confirmpassword') }}</div>
                                            @endif
                                            </div>
                                            

                                        </div>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                         </div>


                    </div>
                </div>
            </div>
        </div>


@endsection
@section('scripts')
 <script>



    function toggleOldPassword()
    {
        
        const togglePasswordold = document.querySelector('#toggleoldPassword');      
        const passwordold = document.querySelector('#oldpassword');
     
        togglePasswordold.addEventListener('click', () => {              

            const type1 = passwordold.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordold.setAttribute('type', type1);          
			  
        });   
    }


    function toggleNewPassword()
    {
       
        const togglePasswordnew = document.querySelector('#toggleNewPassword');
        const passwordnew = document.querySelector('#newpassword');
     			
        togglePasswordnew.addEventListener('click', () => {        
            const type2 = passwordnew.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordnew.setAttribute('type', type2);
         
			
        });

    }



    function toggleConfirmPassword()
    {
        
        const togglePasswordCon = document.querySelector('#toggleConfirmPassword');
        const passwordCon = document.querySelector('#confirmpassword');
      
        togglePasswordCon.addEventListener('click', () => {        
           const type = passwordCon.getAttribute('type') === 'password' ? 'text' : 'password';
           passwordCon.setAttribute('type', type);           
        });

    }




 </script>
@endsection