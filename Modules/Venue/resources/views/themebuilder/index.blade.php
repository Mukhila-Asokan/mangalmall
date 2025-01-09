@extends('admin.layouts.app-admin')
@section('content')

<!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">{!! $pagetitle !!}</h4>
                </div>
                <div class="col-lg-6">
                   <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $pageroot }}</a></li>
                        <li class="breadcrumb-item active">{!! $pagetitle !!}</li>
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
                        <h4 class="header-title mb-2">Venue Theme Builder</h4>


                      
                         
                        <div class="text-end">   
                        <a href = "{{ route('themebuilder/create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-plus me-1"></span>Add
                           </a>
                        </div>
                    

                         <div class="table-responsive">
                             
                            <table class="table mb-0 data-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Theme Name</th>
                                        <th>Theme Type</th>
                                        <th>Preview Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
@endsection
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/venue/themebuilder/') }}">  

@push('scripts')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
  $(function () {
        
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin/themebuilder') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'themename', name: 'themename'},
            {data: 'theme_type', name: 'theme_type'},
            {data: 'preview_image', name: 'preview_image'},           
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
        
  });
</script>
@endpush