@extends('profile-layouts.profile')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
    #view_guests_table thead tr:nth-child(2) th {
        padding: 5px;
    }

    #view_guests_table thead select {
        width: 100%;
    }

    .dataTables_wrapper .dataTables_paginate {
        float: right;
        margin-top: 10px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 2px 10px;
        margin: 2px;
        border: 1px solid #e0e0e0;
        background-color: #fff;
        color: #333;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #58111A;
        color: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #58111A;
        color: white !important;
        border-color: #58111A;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    #view_guests_table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #dee2e6; /* Light grey border */
        border-radius: 10px; /* Rounded corners */
        overflow: hidden; /* Prevent border from breaking */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
    }

    /* Table Header */
    #view_guests_table thead th {
        background-color: #f8f9fa; /* Light grey background */
        border-bottom: 2px solid #dee2e6;
        padding: 10px;
        text-align: left;
        font-weight: bold;
        padding: 15px 10px; /* Top and bottom: 15px, Left and right: 10px */
        background-color: #f8f9fa;
        text-align: left;
        font-weight: bold;
        vertical-align: middle; /* Align text vertically */
    }

    /* Table Body */
    #view_guests_table tbody tr {
        border-bottom: 1px solid #dee2e6;
        transition: all 0.2s ease-in-out;
    }

    /* Hover Effect */
    #view_guests_table tbody tr:hover {
        background-color: #E5E4E2; /* Light blue on hover */
    }

    /* Last Row */
    #view_guests_table tbody tr:last-child {
        border-bottom: none;
    }

    /* Table Cells */
    #view_guests_table tbody td {
        padding: 10px 15px;
    }

    #view_guests_table thead th {
        vertical-align: middle;
        padding: 5px 10px;
    }

    /* Adjust the select dropdown */
    #view_guests_table thead select {
        width: 100%;
        height: 30px;
        padding: 5px;
        margin-top: 5px; /* Add small gap */
        border: 1px solid #ced4da;
        border-radius: 5px;
        outline: none;
        margin-top: 8px; /* Add gap between text and dropdown */
    }

    /* Align dropdown with text */
    #view_guests_table thead .d-flex {
        align-items: center;
    }
    .dataTables_filter {
        margin-bottom: 15px; /* Adjust the value based on your need */
    }
    .dataTables_filter label, .dataTables_length label{
        font-size: 14px;
    }
</style>
@section('content')
    <div class="mt-1 col-lg-10 col-md-10">
        @csrf
        <div class="card p-3 m-3  border-0">
            <div class="card-header pb-1 pr-3">
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <span class="font-20 font-color font-weight-bold">Guest Groups</span>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <button id="printDataBtn" class="font-14 btn btn-primary waves-effect waves-light ml-1" onclick="printTable();">
                            <span><i class="bi bi-printer"></i> Print</span>
                        </button>                    
                    </div>
                    <div class="breadcrumb-bar py-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="custom-breadcrumb">
                                        <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0 pl-0">
                                            <li class="list-inline-item breadcrumb-item"><a href="{{ route('guest.index', ['user_id' => auth()->user()->id]) }}">All Guests</a></li>
                                            <li class="list-inline-item breadcrumb-item active"><a>View Details</a></li>                                            
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <table class="table p-0" id="view_guests_table">
                <thead>
                    <tr>
                        <th style="width: 12%;" class="font-color font-16"> Guest Name </th>
                        <th style="width: 15%;" class="font-color font-16"> Guest Mobile </th>
                        <th style="width: 25%;" class="font-color font-16"></th>
                        <th style="width: 30%;" class="font-color font-16"></th>
                        <th style="width: 15%;" class="font-color font-16"> Caretaker Mobile </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guests as $key => $user)
                        <tr>
                            <td style="width: 12%;" class="font-14"> {{ $user->name }} </td>
                            <td style="width: 15%;" class="font-14"> {{ $user->mobile_number }} </td>
                            <td style="width: 25%;" class="font-14"> 
                                {{ $user->groups->map(fn($group) => $group->group->group_name ?? '')->implode(', ') }}
                            </td>
                            <td style="width: 30%;" class="font-14"> {{ $user->guestCaretaker->caretaker->name ?? '' }} </td>
                            <td style="width: 15%;" class="font-14"> {{ $user->guestCaretaker->caretaker->mobile_number ?? '' }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-2 col-md-2">
        @include('profile-layouts.rightside')
    </div> 
@endsection
<script>
    function printTable() {
        // var contentToPrint = document.querySelector('#view_guests_table');
        // console.log(contentToPrint.innerHTML);
        // var printWindow = window.open('', '_blank');
        // printWindow.document.write("<html><head><title>Print</title></head><body>");
        // printWindow.document.write(contentToPrint.innerHTML);
        // printWindow.document.write('</body></html>');
        // printWindow.document.close();
        // printWindow.print();
        var contentToPrint = document.querySelector('#view_guests_table');
        contentToPrint.querySelector('thead').style.display = 'table-header-group';

        var printWindow = window.open('');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Print Guests Table</title>
                    <style>
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }
                        th, td {
                            border: 1px solid #ddd;
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                        tr:hover {
                            background-color: #f5f5f5;
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        Mangal Mall Guest Groups Report
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Guest Name</th>
                                <th>Guest Mobile</th>
                                <th>Group Name</th>
                                <th>Caretaker Name</th>
                                <th>Caretaker Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${contentToPrint.querySelector('tbody').innerHTML}
                        </tbody>
                    </table>
                    <div class="footer">
                        Generated on: ${new Date().toLocaleDateString()} | Mangal Mall Pvt Ltd
                    </div>
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
</script>
@push('scripts')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#view_guests_table').DataTable({
            autoWidth: false, // Disable auto width
            ordering: false,
            scrollX: true,
            scrollY: true,
            responsive: true,
            language: {
                paginate: {
                    first: '<<',
                    previous: '<i class="fas fa-chevron-left"></i>',
                    next: '<i class="fas fa-chevron-right"></i>',
                    last: '>>'
                }
            },
            initComplete: function () {
                this.api().columns([2, 3]).every(function () {
                    var column = this;
                    var selectOption = (this.index() === 2) ? 'Group Name' : 'Caretaker Name';

                    // Create div and select element
                    var selectWrapper = $('<div class="d-flex"><label class="w-100 mt-2">' + selectOption + '</label><select class="form-control mb-2"><option value="" selected>All</option></select></div>');
                    var selectElement = selectWrapper.find('select');

                    // Append select to the correct column
                    selectWrapper.appendTo($('thead tr:eq(0) th').eq(this.index()));

                    // Add "All" option and handle filtering
                    selectElement.on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? val : '', false, true).draw();
                    });

                    // Collect unique values (including comma-separated ones)
                    var uniqueData = new Set();

                    column.data().unique().sort().each(function (d, j) {
                        if(d != ''){
                            if (d.includes(',')) {
                                d.split(',').forEach(function (item) {
                                    uniqueData.add(item.trim());
                                });
                            } else {
                                uniqueData.add(d);
                            }
                        }
                    });

                    // Append unique options to the select dropdown
                    uniqueData.forEach(function (value) {
                        selectElement.append('<option value="' + value + '">' + value + '</option>');
                    });
                });
                setTimeout(() => {
                    table.columns.adjust();
                }, 100);
            }
        });
    });
</script>
@endpush
