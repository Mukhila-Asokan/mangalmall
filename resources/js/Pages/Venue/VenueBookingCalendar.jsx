import React, { useState, useEffect } from "react";
import "./calendor.css"; // Import CSS for styling

const VenueBookingCalendar = () => {
  const [currentMonth, setCurrentMonth] = useState(new Date());
  const [showModal, setShowModal] = useState(false);
  const [selectedDate, setSelectedDate] = useState(null);
  const [isClosing, setIsClosing] = useState(false);

  // Example booked dates
  const bookedDates = {
    "2025-02-10": { type: "full", details: "Wedding Event - Full Day" },
    "2025-02-15": { type: "morning", details: "Business Meeting - Morning Slot" },
    "2025-02-20": { type: "evening", details: "Private Party - Evening Slot" },
    "2025-02-25": { type: "full", details: "Corporate Event - Full Day" }
  };

  const renderCalendar = () => {
    const firstDay = new Date(currentMonth.getFullYear(), currentMonth.getMonth(), 1).getDay();
    const totalDays = new Date(currentMonth.getFullYear(), currentMonth.getMonth() + 1, 0).getDate();
    let daysArray = [];

    for (let i = 0; i < firstDay; i++) {
      daysArray.push(<div key={`empty-${i}`} className="empty"></div>);
    }

    for (let day = 1; day <= totalDays; day++) {
      const dateKey = `${currentMonth.getFullYear()}-${String(currentMonth.getMonth() + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
      let bookingInfo = bookedDates[dateKey];

      daysArray.push(
        <div
          key={day}
          className={`day ${bookingInfo ? bookingInfo.type : ""}`}
          onClick={() => bookingInfo && handleDayClick(dateKey)}
        >
          {day}
          {bookingInfo && bookingInfo.type === "full" && <div className="full-booked"></div>}
          {bookingInfo && bookingInfo.type === "morning" && <div className="half-booked morning"></div>}
          {bookingInfo && bookingInfo.type === "evening" && <div className="half-booked evening"></div>}
        </div>
      );
    }

    return daysArray;
  };

  const handleDayClick = (date) => {
    setSelectedDate(bookedDates[date]);
    setShowModal(true);
    setIsClosing(false);
  };

  const handleCloseModal = () => {
    setIsClosing(true);
    setTimeout(() => {
      setShowModal(false);
      setSelectedDate(null);
    }, 300); // Delay removal to match animation duration
  };

  const handlePrevMonth = () => {
    setCurrentMonth(new Date(currentMonth.setMonth(currentMonth.getMonth() - 1)));
  };

  const handleNextMonth = () => {
    setCurrentMonth(new Date(currentMonth.setMonth(currentMonth.getMonth() + 1)));
  };

  return (
    <div className="calendar-container">
      <div className="calendar-header">
        <button onClick={handlePrevMonth}>❮</button>
        <h2>{currentMonth.toLocaleString("en-US", { month: "long", year: "numeric" })}</h2>
        <button onClick={handleNextMonth}>❯</button>
      </div>

      <div className="calendar-grid">
        {["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"].map((day) => (
          <div key={day} className="day-name">{day}</div>
        ))}
        {renderCalendar()}
      </div>

      {showModal && selectedDate && (
        <div className={`modal-overlay ${isClosing ? "closing" : ""}`} onClick={handleCloseModal}>
          <div className="modal-content" onClick={(e) => e.stopPropagation()}>
            <h3>Booking Details</h3>
            <p><strong>Type:</strong> {selectedDate.type === "full" ? "Full-Day Booking" : selectedDate.type === "morning" ? "Morning Slot" : "Evening Slot"}</p>
            <p><strong>Details:</strong> {selectedDate.details}</p>
            <button className="close-btn" onClick={handleCloseModal}>Close</button>
          </div>
        </div>
      )}
	  
	    {/* Legend Section */}
      <div className="legend">
        <hr />
        <h4>Color Legend</h4>
        
        <div className="legend-item"><div className="legend-color auspicious-date"></div> Auspicious Date  <div className="legend-color fully-booked"></div> Booked</div>
      
      </div>
	  
	  
	  
    </div>
  );
};

export default VenueBookingCalendar;
