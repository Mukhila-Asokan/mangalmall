@extends('admin.layouts.app-admin')
@section('content')
<style type="text/css"></style>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                           <div class="text-end">
                         <a href = "{{ route('venue/index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>List Venue
                           </a>
                        </div>
                        <div class="row">
                        <div class="col-8">


                       
                      </div>
                      <div class="col-4">

                            <a href = "{{ url('/admin/venue/'.$venuedetails->id.'/webpage') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-webpack me-1"></span>Webpage Design
                           </a>

                            <a href = "{{ url('/admin/venue/'.$venuedetails->id.'/bookingdetails') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-book-open me-1"></span>Booking Details
                           </a>

                         
                             <a href = "{{ url('/admin/venue/'.$venuedetails->id.'/edit') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-pencil me-1"></span>Edit
                               </a>



                     
                         <a href = "{{ route('venue/index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-printer me-1"></span>Print
                           </a>
                            <a href = "{{ url('/admin/venue/'.$venuedetails->id.'/themebuilder') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-file me-1"></span>Theme Builder
                           </a>


                        
                      </div>
                    </div>
              




                    </div>
                </div>
            </div>
        </div>
@endsection
