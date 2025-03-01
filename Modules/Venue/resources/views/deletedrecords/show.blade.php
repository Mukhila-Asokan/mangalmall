@extends('admin.layouts.app-admin')

@section('content')
<div class="row">
   
    <form action="{{ route('menus.bulkAction') }}" method="POST">
    @csrf
    
    <input type="hidden" name = "menuid" value = "{{ $deletedMenus->id ?? '' }}" />
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-2">List of Deleted {{ $deletedMenus->menuname ?? '' }} </h4>
               
                <div class="table-responsive">
                    
                        <table class="table table-bordered table-hover mb-4">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" id="select-all"></th>
                                <th class="text-center">#</th>
                                @foreach($columns as $column)
                                    <th class="text-center">{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                                @endforeach                             
                            </tr>
                        </thead>
                        <tbody>
                        @php
    $start = ($deletedRecords->currentPage() - 1) * $deletedRecords->perPage() + 1;
@endphp
                            @foreach($deletedRecords as $record)
                                <tr>
                                    <td class="text-center"><input type="checkbox" name="record_ids[]" value="{{ $record->id }}" class="record-checkbox"></td>
                                    <td class="text-center">{{ $start++ }}</td>
                                    @foreach($columns as $column)
                                        <td class="text-center">{{ $record->$column }}</td>
                                    @endforeach                                   
                                </tr>
                            @endforeach
                        </tbody>
                        </table>

                       
                    
                    <!-- Pagination links here -->

                    <div class="d-flex justify-content-center"> {{-- Center the pagination --}}
                            {{ $deletedRecords->appends(request()->query())->links('pagination::bootstrap-4') }}

                     </div>

                        
                </div>
            </div>
            <div class="d-flex justify-content-between m-5">
                            <button type="submit" name="action" value="restore" class="btn btn-success"><i class="fas fa-trash-restore"></i> Restore Selected</button>
                            <button type="submit" name="action" value="delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete Selected Permanently</button>
            </div>

            </form>
       
    </div>
</div>

<script>
  document.getElementById('select-all').addEventListener('change', function() {
    let checkboxes = document.querySelectorAll('.record-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});
</script>
@endsection