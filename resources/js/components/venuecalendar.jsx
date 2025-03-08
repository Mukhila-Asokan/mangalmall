import React, { useState } from "react";
import "./calendor.css"; // Import CSS for styling

const VenueBookingCalendar = () => {
  const [currentMonth, setCurrentMonth] = useState(new Date());
  const [showModal, setShowModal] = useState(false);
  const [selectedDate, setSelectedDate] = useState(null);
  const [isClosing, setIsClosing] = useState(false);
  const [formData, setFormData] = useState({ name: "", phone: "", message: "", id: "" });

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

  const handleDayClick = (date, bookingInfo) => {
    setSelectedDate({ date, ...bookingInfo });
    setShowModal(true);
    setIsClosing(false);
  };

  const handleCloseModal = () => {
    setIsClosing(true);
    setTimeout(() => {
      setShowModal(false);
      setSelectedDate(null);
      setFormData({ name: "", phone: "", message: "", id: "" });
    }, 300);
  };

  const handlePrevMonth = () => {
    setCurrentMonth(new Date(currentMonth.setMonth(currentMonth.getMonth() - 1)));
  };

  const handleNextMonth = () => {
    setCurrentMonth(new Date(currentMonth.setMonth(currentMonth.getMonth() + 1)));
  };

  const handleInputChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  // const handleFormSubmit = (e) => {
  //   e.preventDefault();
  //   alert(`Enquiry Sent: ${formData.name}, ${formData.phone}, ${formData.message}`);
  //   handleCloseModal();
  // };

  const handleFormSubmit = async (e) => {
    e.preventDefault();
    const urlPath = window.location.pathname; 
    const segments = urlPath.split('/').filter(Boolean); 
    const id = segments[2]; // Extract venue ID from URL

    if (!selectedDate || !selectedDate.date) {
        console.log("No date selected!");
        return;
    }
    const updatedFormData = { 
        ...formData, 
        id, 
        date: selectedDate.date
    };

    console.log("Form Data Being Sent:", updatedFormData);

    const endpoint = `/home/submit-enquiry`;

    try {
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // If using Laravel
            },
            body: JSON.stringify(updatedFormData)
        });

        const result = await response.json();

        if (response.ok) {
            handleCloseModal();
        } else {
            console.log(`Error: ${result.error}`);
        }
    } catch (error) {
        console.error("Error submitting enquiry:", error);
    }
};


  return (
    <div className="calendar-container">
      <div className="calendar-header">
        <button onClick={handlePrevMonth}>❮</button>
        <h5>{currentMonth.toLocaleString("en-US", { month: "long", year: "numeric" })}</h5>
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
            <p><strong>Date:</strong> {selectedDate.date}</p>

            {selectedDate.details ? (
              <>
                <p><strong>Type:</strong> {selectedDate.type === "full" ? "Full-Day Booking" : selectedDate.type === "morning" ? "Morning Slot" : "Evening Slot"}</p>
                <p><strong>Details:</strong> {selectedDate.details}</p>
              </>
            ) : (
              <>
                <p><strong>This date is available!</strong></p>
                <form onSubmit={handleFormSubmit}>
                  <input
                    type="text"
                    name="name"
                    className="form-control mb-2"
                    placeholder="Your Name"
                    value={formData.name}
                    onChange={handleInputChange}
                    required
                  />
                  <input
                    type="text"
                    name="phone"
                    className="form-control mb-2"
                    placeholder="Your Mobile Number"
                    value={formData.phone}
                    onChange={handleInputChange}
                    required
                  />
                  <textarea
                    name="message"
                    placeholder="Your Message"
                    className="form-control mb-2"
                    value={formData.message}
                    onChange={handleInputChange}
                    required
                  />
                  <input
                    type="hidden"
                    name="venue_id"
                    value={formData.id}
                    required
                  />
                  <button type="submit" className="btn btn-primary">Send Enquiry</button>
                </form>
              </>
            )}

            <button className="close-btn" onClick={handleCloseModal}>Close</button>
          </div>
        </div>
      )}

      {/* Legend Section */}
      <div className="legend">
        <hr />
        <div className="legend-item">
          <div className="legend-color auspicious-date"></div> Auspicious Date  
          <div className="legend-color fully-booked"></div> Booked
        </div>
      </div>
	  
	  
	  
    </div>
  );
};

export default VenueBookingCalendar;
