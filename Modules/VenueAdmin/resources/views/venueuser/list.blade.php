@extends('venueadmin::layouts.admin-layout')
@section('content')
 <div class="col-12">
 
  <div class="card">
	<div class="card-body p-4">
		<div class="col-12 text-end">
			<a href ="{{ route('venueadmin/create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
				<span class="tf-icon mdi mdi-plus me-1"></span><i class="bi bi-plus"></i> Add Venue
			</a>
		</div>
	  <div class="table-responsive mb-4 border rounded-1">
        <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
				  <tr>
						<th>#</th>
						<th>Venue Name</th>
						<th>Website Link</th>						
						<th>Venue Pricing</th>
						<th>Venue Booking</th>
						<!-- <th>Theme Builder</th> -->
						<th width="100px">Action</th>
				  </tr>
				  </thead>
				  <tbody>
				   @php $i=1; @endphp
				     @if(count($venues) > 0)
					@foreach($venues as $ven)
						 <tr>
                            <td>{{  $i++ }}</td>
							<td> {{ $ven->venuename }} </td>
							<td> {{ $ven->websitename }} </td>
							<td> <a href="{{ url('/venueadmin/venuepricing/'.$ven->id.'/add') }}" class="btn-primary btn" title="Pricing"><i class="ti ti-book action_icon"></i>
               Pricing </a> </td>
							<td><a href="{{ url('/venueadmin/venuebooking/'.$ven->id.'/add') }}" class="btn-success btn" title="Booking"><i class="ti ti-bookmark action_icon"></i>
               Booking </a>  </td>
							<!-- <td> <a href="{{ url('/venueadmin/themebuilder/'.$ven->id.'/edit') }}" class="btn-info btn" title="Theme"><i class="ti ti-wand action_icon"></i>
                Theme </a></td> -->
							<td>
                            <a href="{{ url('/venueadmin/viewvenue/'.$ven->id.'') }}" class="font-20 text-primary mleft-10"><i class="bi bi-eye"></i></a>
							<a href="{{ url('/venueadmin/editvenue/'.$ven->id.'') }}" class="font-20 text-warning mleft-10" title="Edit"><i class="bi bi-pencil-square"></i></a>
				
				</td>
						</tr>
					@endforeach
					@else                                     
							No Records Found
					@endif
				  </tbody>

	   </table>
	</div>
</div>
</div>
</div>
@endsection