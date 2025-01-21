@extends('profile-layouts.profile')
@section('content')


<div class="col-lg-8 col-md-8">
                        <!-- Search widget-->
    <aside class="widget widget-search">
        <form>
            <input class="form-control" type="search" placeholder="Type Search Words">
            <button class="search-button" type="submit"><span class="ti-search"></span></button>
        </form>
    </aside>

    <hr>  
   
<div class="row white-bg shadow-sm p-5 mt-md-4 mt-lg-4">  
    <div class="col-11"> 
     
       <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Occasion</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>                                
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                    @foreach($useroccasion as $occasion)
                        <tr>
                            <td><p>{{ $i++ }}</p></td>
                            <td><p>{{ $occasion->occasiondate }}</p></td>
                            <td><p>{{ $occasion->Occasionname->eventtypename }}</p></td>
                            <td><p>{{ $occasion->notes }}</p></td>
                            <td><a href="#"><span class="ti-pencil"></span></a></td>
                        </tr>
                    @endforeach
            </tbody>
       </table>
   
    </div>
    <div class="col-1">
             <div class="text-end">
    <a type="button" class="btn primary-solid-btn" id="addoccasion" data-toggle="modal" data-target="#addoccasionpopup">Add</a></div>
    </div>
</div>
</div>





<div class="modal fade" id="addoccasionpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Occasion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method = "post" action = "{{ route('home/occasion/add')}}">
      <div class="modal-body">
           @csrf
            <div class="form-row">
            <div class="col-12">
                <div class="form-group">
                    <input type="Date" class="form-control" name="occasiondate" id="occasiondate" placeholder="Select Date" required="required">
                </div>
                <input type = "hidden" name = "userid" value = "{{ $userid }}" />
            </div>
            <div class="col-12">
                <div class="form-group">
                    <select class="form-control" name="occasiontype" id="occasiontype" required="required">
                        <option>Select Occasion</option>
                        @foreach($occasiontype as $typename)
                        <option value="{{ $typename->id }}" >{{ $typename->eventtypename }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <textarea name="message" id="message" class="form-control" rows="5" cols="25" placeholder="Notes"></textarea>
                </div>
            </div>
           
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn secondary-outline-btn" data-dismiss="modal">Close</button>
        <button type="submit" class="btn primary-solid-btn">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection