import React, { useState, useEffect } from "react";
import "./calendor.css"; // Import CSS for styling

const VenueBookingCalendar = () => {
  const [currentMonth, setCurrentMonth] = useState(new Date());
  const [currentYear, setCurrentYear] = useState(new Date());
  const [showModal, setShowModal] = useState(false);
  const [selectedDate, setSelectedDate] = useState(null);
  const [isClosing, setIsClosing] = useState(false);
  const [bookedDates, setBookings] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      const urlPath = window.location.pathname; 
      const segments = urlPath.split('/').filter(Boolean); 
      const id = segments[2];

      let selectedMonth = currentMonth.getMonth() + 1;
      let selectedYear = currentYear.getFullYear();
      
      console.log(selectedYear, 'selectedYear');
      console.log(selectedMonth, 'selectedMonth');
      
      const endpoint = `/admin/getBookings/${id}/${selectedMonth}/${selectedYear}`;
      try {
        const response = await fetch(endpoint, {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
              .querySelector('meta[name="csrf-token"]')
              ?.getAttribute("content"),
          },
        });

        const result = await response.json();

        if (response.ok) {
          console.log(result.bookings, 'result');
          setBookings(result.bookings || []);
        } else {
          setError(result.error || "Failed to fetch data");
        }
      } catch (error) {
        setError("Error fetching data: " + error.message);
      } finally {
        setLoading(false); // Stop loading once request is complete
      }
    };

    fetchData(); // Call function when the component mounts
  }, [currentMonth, currentYear]);


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
          onClick={() => handleDayClick(dateKey, bookingInfo)}
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
    setCurrentMonth((prevMonth) => {
      if (prevMonth.getMonth() === 0) {
        setCurrentYear((prevYear) => new Date(prevYear.getFullYear() - 1, 11)); 
        return new Date(prevMonth.getFullYear() - 1, 11);
      }
      return new Date(prevMonth.getFullYear(), prevMonth.getMonth() - 1);
    });
  };
  
  const handleNextMonth = () => {
    setCurrentMonth((prevMonth) => {
      if (prevMonth.getMonth() === 11) {
        setCurrentYear((prevYear) => new Date(prevYear.getFullYear() + 1, 0));
        return new Date(prevMonth.getFullYear() + 1, 0);
      }
      return new Date(prevMonth.getFullYear(), prevMonth.getMonth() + 1);
    });
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
