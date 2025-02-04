@extends('admin.layouts.app-admin')

@routes  
@viteReactRefresh
@vite('resources/js/app.jsx')

<style type="text/css">
    
.calendar-container {
    width: 100%;
    max-width: 420px;
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin: auto;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 18px;
    font-weight: bold;
    padding: 10px 0;
}

.calendar-header button {
    background: none;
    border: none;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
    padding: 10px 0;
}

.day-name, .day {
    text-align: center;
    font-size: 14px;
    padding: 10px;
    border-radius: 5px;
}

.day {
    background-color: #fff;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    position: relative;
}

.day:hover {
    background-color: #f1f1f1;
}

/* Full Day Booking */
.full-booked {
    background-color: #ff4d4d;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border-radius: 5px;
}

/* Half Bookings */
.half-booked {
    width: 100%;
    height: 50%;
    position: absolute;
    left: 0;
}

.half-booked.morning {
    background-color: #ffcc00;
    top: 0;
    clip-path: polygon(0 0, 100% 0, 0 100%);
}

.half-booked.evening {
    background-color: #ffcc00;
    bottom: 0;
    clip-path: polygon(100% 100%, 0 100%, 100% 0);
}

/* Popup Styling */
.popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    z-index: 1000;
}

.popup-content {
    text-align: center;
}

.popup-content button {
    margin-top: 10px;
    padding: 8px 15px;
    background: #ff4d4d;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

    
</style>
@inertiaHead

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
