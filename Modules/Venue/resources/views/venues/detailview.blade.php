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


                        <table class="table table-bordered border-primary mb-0 font-weight-bold">
                        <tbody>
                            <tr>
                                <td><h4 class="header-title">Venue Type</h4></td>
                                <td colspan="2">{{ $venuedetails->venuettype->venuetype_name }} -> {{ $venuedetails->venuetsubtype->venuetype_name }}</td>
                            </tr>

                            <tr>
                                <td><h4 class="header-title">Name - {{ $venuedetails->venuename}}</h4></td>
                                <td colspan="2" class="text-center">
                                    <img src = "{{ url('/').Storage::url('/').$venuedetails->bannerimage }}" style="width:100px" /></td>
                            </tr>
                            <tr>
                                <td rowspan="4"><h4 class="header-title">Location</h4></td>
                                <td>Address</td>
                                <td>{{ $venuedetails->venueaddress}}</td>
                            </tr>
                            <tr>
                                <td>Area</td>
                                <td>{{ $venuedetails->indianlocation->Areaname }}</td>                              
                            </tr>
                            <tr>
                                <td>City & District</td>
                                <td>{{ $venuedetails->indianlocation->City }}, {{ $venuedetails->indianlocation->District }}</td>                              
                            </tr>
                               <tr>
                                <td>State</td>
                                <td>{{ $venuedetails->indianlocation->State }}</td>                              
                            </tr>
                            <tr><td><h4 class="header-title">Description</h4></td>
                                <td colspan="2">{{ $venuedetails->description}}</td>
                            </tr>
                            <tr>
                                <td rowspan="5"><h4 class="header-title">Contact Details</h4></td>
                                <td>Contact Person</td>
                                <td>{{ $venuedetails->contactperson }}</td>
                            </tr>
                            <tr>
                                <td>Mobile No</td>
                                <td>{{ $venuedetails->contactmobile }}</td>                              
                            </tr>
                            <tr>
                                <td>Landline</td>
                                <td>{{ $venuedetails->contacttelephone }}</td>                              
                            </tr>
                            <tr>
                                <td>Email Id</td>
                                <td>{{ $venuedetails->contactemail }}</td>                              
                            </tr>
                            <tr>
                                <td>Website</td>
                                <td>{{ $venuedetails->websitename }}</td>                              
                            </tr>
                             <tr>
                                <td><h4 class="header-title">Amenities</h4></td>
                                

                                <td colspan="2">
                                    <ul>

                                   <?PHP

                                    $amenitiesarray = json_decode($venuedetails->venueamenities, true); 
                                    

                                    foreach($venueamenities as $amenities):
                                        
                                        if(in_array($amenities->id, $amenitiesarray))
                                        {
                                            echo '<li>'.$amenities->amenities_name.'</li>';
                                        }
                                    endforeach;

                                ?>
                            </ul>


                                </td>
                            </tr>
                            <tr>
                                <td><h4 class="header-title">Features</h4></td>
                                <td colspan="2">
                                    <ul>

                                   <?PHP
                                    $venuedataarray = json_decode($venuedetails->venuedata, true); 
                                    $i=0;
                                     foreach($venuedatafield as $datafield):

                                        $value = $venuedatafielddetails->firstWhere('id',$venuedataarray[$i])->optionname ?? $venuedataarray[$i];
                                        
                                        echo '<li>'.$datafield->datafieldname.' - '.$value.' '.$datafield->datafieldnametype.'</li>';

                                      
                                      $i++;
                                    endforeach;

                                ?>
                            </ul>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                      </div>
                      <div class="col-4">

                            <a href = "{{ url('/admin/venue/'.$venuedetails->id.'/webpage') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end" target="_new">
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
