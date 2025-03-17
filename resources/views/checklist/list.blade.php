@extends('profile-layouts.profile')
@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        @include('profile-layouts.sticky')
        <div class="col-lg-11 col-md-11 stickymenucontent">  
           
           <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nunc lorem, tincidunt sed elementum vel, dictum a ante. Nulla et diam velit. Curabitur felis velit, sodales commodo vehicula id, elementum eget mauris. Fusce sed pellentesque augue. Sed euismod egestas nunc in iaculis. Cras eu molestie odio. Curabitur tortor ante, laoreet non odio facilisis, elementum hendrerit tortor. In tellus odio, lobortis et commodo sed, porta ac arcu. Phasellus quis nibh at lorem laoreet tempus. Aenean vitae vehicula risus. Quisque feugiat porta lacus sit amet egestas. Praesent placerat, magna sit amet bibendum sollicitudin, orci quam dictum risus, sit amet aliquam risus massa vitae odio. In auctor lorem dictum quam eleifend interdum. Duis id ante quis felis gravida rhoncus nec eget mi. Ut consequat purus quis mollis maximus.</p>

            <p>Proin at orci nibh. Nulla sed erat sapien. Cras tempus in est vitae eleifend. Suspendisse efficitur urna odio, vel cursus ante porta semper. Ut vitae tellus eu tellus sollicitudin tincidunt sit amet id nunc. Sed in sapien vitae risus malesuada ultricies vel consequat nisl. Phasellus venenatis metus purus.</p>
                 

        </div>
    </div>
</div>

<div class="col-lg-2 col-md-2">
    @include('profile-layouts.rightside')
</div>
@endsection