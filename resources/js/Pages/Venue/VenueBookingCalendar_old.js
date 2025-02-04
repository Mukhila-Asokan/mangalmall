import React, { useState } from 'react';
import { ChevronLeft, ChevronRight } from 'lucide-react';

const VenueBookingCalendar = () => {
  const [currentDate, setCurrentDate] = useState(() => {
    const today = new Date();
    return new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay());
  });

  // Generate week dates based on current date
  const generateWeekDates = () => {
    const dates = [];
    for (let i = 0; i < 7; i++) {
      const date = new Date(currentDate);
      date.setDate(currentDate.getDate() + i);
      dates.push(date);
    }
    return dates;
  };

  // Sample booking data - replace with your actual data
  const getBookingStatus = (date) => {
    const day = date.getDate();
    if (day % 2 === 0) {
      return { type: 'full' };
    } else if (day % 3 === 0) {
      return { type: 'half', period: 'morning' };
    }
    return null;
  };

  const handlePrevWeek = () => {
    const newDate = new Date(currentDate);
    newDate.setDate(currentDate.getDate() - 7);
    setCurrentDate(newDate);
  };

  const handleNextWeek = () => {
    const newDate = new Date(currentDate);
    newDate.setDate(currentDate.getDate() + 7);
    setCurrentDate(newDate);
  };

  const weekDates = generateWeekDates();

  return (
    <div className="w-full max-w-4xl mx-auto p-4">
      <div className="bg-white rounded-lg shadow">
        {/* Calendar Header with Navigation */}
        <div className="flex justify-between items-center p-4 border-b">
          <button 
            onClick={handlePrevWeek} 
            className="p-2 hover:bg-gray-100 rounded-full"
          >
            <ChevronLeft className="w-5 h-5" />
          </button>
          
          <h2 className="text-lg font-semibold">
            {currentDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' })}
          </h2>
          
          <button 
            onClick={handleNextWeek} 
            className="p-2 hover:bg-gray-100 rounded-full"
          >
            <ChevronRight className="w-5 h-5" />
          </button>
        </div>

        {/* Days of Week Header */}
        <div className="grid grid-cols-7 gap-px bg-gray-200 border-b">
          {['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].map(day => (
            <div key={day} className="p-2 text-center font-medium">
              {day}
            </div>
          ))}
        </div>

        {/* Calendar Grid */}
        <div className="grid grid-cols-7 gap-px bg-white">
          {weekDates.map((date, index) => {
            const booking = getBookingStatus(date);
            const isToday = new Date().toDateString() === date.toDateString();

            return (
              <div 
                key={index} 
                className={`min-h-[100px] relative border p-1 ${
                  isToday ? 'bg-blue-50' : ''
                }`}
              >
                <div className={`text-sm mb-2 ${
                  isToday ? 'font-bold text-blue-600' : ''
                }`}>
                  {date.getDate()}
                </div>
                
                {booking && (
                  <div className={`absolute inset-0 m-1 rounded ${
                    booking.type === 'full' 
                      ? 'bg-blue-500 opacity-50'
                      : booking.period === 'morning'
                        ? 'bg-gradient-to-b from-blue-500 to-transparent opacity-50'
                        : 'bg-gradient-to-t from-blue-500 to-transparent opacity-50'
                  }`} />
                )}
              </div>
            );
          })}
        </div>

        {/* Legend */}
        <div className="p-4 border-t flex gap-4 justify-center text-sm">
          <div className="flex items-center gap-2">
            <div className="w-4 h-4 bg-blue-500 opacity-50 rounded"></div>
            <span>Full Day Booking</span>
          </div>
          <div className="flex items-center gap-2">
            <div className="w-4 h-4 bg-gradient-to-b from-blue-500 to-transparent opacity-50 rounded"></div>
            <span>Morning Booking</span>
          </div>
          <div className="flex items-center gap-2">
            <div className="w-4 h-4 bg-gradient-to-t from-blue-500 to-transparent opacity-50 rounded"></div>
            <span>Evening Booking</span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default VenueBookingCalendar;
