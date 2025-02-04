import React, { useState, useEffect } from "react";
import { ChevronLeft, ChevronRight } from "lucide-react";

const VenueBookingCalendar = () => {
  const { pagetitle, username, pageroot, venuebooking, venue, page } = usePage().props;
  const [currentMonth, setCurrentMonth] = useState(new Date());
  const [bookings, setBookings] = useState([]);
console.log(username); 
  useEffect(() => {
    fetchBookings();
  }, [currentMonth]);

  const fetchBookings = async () => {
    try {
      const response = await fetch(`/api/bookings?month=${currentMonth.getMonth() + 1}`);
      const data = await response.json();
      setBookings(data);
    } catch (error) {
      console.error("Error fetching bookings:", error);
    }
  };

  const getDaysInMonth = () => {
    const year = currentMonth.getFullYear();
    const month = currentMonth.getMonth();
    return new Date(year, month + 1, 0).getDate();
  };

  const getBookingStatus = (day) => {
    const dateStr = `${currentMonth.getFullYear()}-${currentMonth.getMonth() + 1}-${day}`;
    return bookings.find((b) => b.date === dateStr);
  };

  const handlePrevMonth = () => {
    setCurrentMonth(new Date(currentMonth.setMonth(currentMonth.getMonth() - 1)));
  };

  const handleNextMonth = () => {
    setCurrentMonth(new Date(currentMonth.setMonth(currentMonth.getMonth() + 1)));
  };

  const daysInMonth = getDaysInMonth();
  const firstDayOfMonth = new Date(currentMonth.getFullYear(), currentMonth.getMonth(), 1).getDay();

  return (
    <div className="w-full max-w-2xl mx-auto p-4 bg-white rounded-lg shadow-md">
      {/* Calendar Header */}
      <div className="flex justify-between items-center p-4">
        <button onClick={handlePrevMonth} className="p-2 hover:bg-gray-100 rounded-full">
          <ChevronLeft className="w-6 h-6" />
        </button>
        <h2 className="text-lg font-bold">
          {currentMonth.toLocaleDateString("en-US", { month: "long", year: "numeric" })}
        </h2>
        <button onClick={handleNextMonth} className="p-2 hover:bg-gray-100 rounded-full">
          <ChevronRight className="w-6 h-6" />
        </button>
      </div>

      {/* Days of the Week Header */}
      <div className="grid grid-cols-7 gap-1 p-2 text-center font-medium text-gray-700">
        {["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"].map((day) => (
          <div key={day}>{day}</div>
        ))}
      </div>

      {/* Calendar Grid */}
      <div className="grid grid-cols-7 gap-1">
        {/* Empty Days at Start */}
        {Array(firstDayOfMonth).fill(null).map((_, index) => (
          <div key={`empty-${index}`} className="h-12"></div>
        ))}

        {/* Days of the Month */}
        {Array(daysInMonth)
          .fill(null)
          .map((_, day) => {
            const dayNumber = day + 1;
            const booking = getBookingStatus(dayNumber);
            const isBooked = booking ? booking.status : null;
            const isHalfDay = booking?.type === "half";

            return (
              <div
                key={dayNumber}
                className={`h-12 flex items-center justify-center border cursor-pointer
                  ${isBooked ? (isHalfDay ? "bg-yellow-300" : "bg-red-500 text-white") : "hover:bg-gray-100"}
                `}
              >
                {dayNumber}
              </div>
            );
          })}
      </div>

      {/* Booking Legend */}
      <div className="flex justify-between mt-4 text-sm">
        <div className="flex items-center">
          <div className="w-4 h-4 bg-red-500 mr-2"></div> Full-Day Booked
        </div>
        <div className="flex items-center">
          <div className="w-4 h-4 bg-yellow-300 mr-2"></div> Half-Day Booked
        </div>
        <div className="flex items-center">
          <div className="w-4 h-4 border mr-2"></div> Available
        </div>
      </div>
    </div>
  );
};

export default VenueBookingCalendar;
