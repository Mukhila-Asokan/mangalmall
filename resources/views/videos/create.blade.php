@extends('profile-layouts.profile')
@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        @include('profile-layouts.invitationmenu')
        <div class="col-lg-11 col-md-11 stickymenucontent"> 

            <!--blog section start-->
    	<div id="video-creator"></div>

        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2">
    @include('profile-layouts.rightside')
</div>

@endsection