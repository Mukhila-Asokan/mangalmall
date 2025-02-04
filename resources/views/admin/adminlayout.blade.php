@extends('admin.layouts.app-admin')

@routes  
@viteReactRefresh
@vite('resources/js/app.jsx')
@inertiaHead
<style type="text/css">
    
/* Calendar.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.calendar-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 350px;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.calendar-header button {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: #333;
}

.calendar-header button:hover {
    color: #007bff;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
}

.day-header {
    text-align: center;
    font-weight: bold;
    padding: 10px;
    background-color: #f1f1f1;
    border-radius: 5px;
}

.date-cell {
    text-align: center;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    position: relative;
}

.date-cell:hover {
    background-color: #007bff;
    color: #fff;
}

.date-cell.booked {
    background-color: #ffcccc;
    cursor: not-allowed;
}

.booking-indicator {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.morning-booked,
.evening-booked {
    width: 0;
    height: 0;
    border-style: solid;
}

.morning-booked {
    border-width: 0 0 20px 20px;
    border-color: transparent transparent #ff0000 transparent;
}

.evening-booked {
    border-width: 20px 20px 0 0;
    border-color: #ff0000 transparent transparent transparent;
}

.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.popup-content button {
    margin-top: 10px;
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.popup-content button:hover {
    background-color: #0056b3;
}
    
</style>
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
                        <div class="col-12">
                           

                            @inertia

               
                      </div>
                     
                    </div>
              




                    </div>
                </div>
            </div>
        </div>
@endsection
