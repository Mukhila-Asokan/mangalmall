import React, { useState } from "react";
//import "./Calendar.css";  Import CSS for styling

const Calendar = () => {
    const [currentDate, setCurrentDate] = useState(new Date());
    const [selectedDate, setSelectedDate] = useState(null);
    const [showPopup, setShowPopup] = useState(false);

    // Sample data for booked dates
    const bookedDates = {
        5: { morning: true, evening: false, details: "Morning booked for Event A" },
        10: { morning: false, evening: true, details: "Evening booked for Event B" },
        15: { morning: true, evening: true, details: "Fully booked for Event C" },
    };

    // Function to render the calendar grid
    const renderCalendar = () => {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const firstDayOfMonth = new Date(year, month, 1);
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const startingDay = firstDayOfMonth.getDay();

        const calendar = [];
        const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        // Add days of the week
        daysOfWeek.forEach((day) => {
            calendar.push(
                <div key={`day-${day}`} className="day-header">
                    {day}
                </div>
            );
        });

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < startingDay; i++) {
            calendar.push(<div key={`empty-${i}`} className="date-cell empty"></div>);
        }

        // Add dates to the calendar
        for (let i = 1; i <= daysInMonth; i++) {
            const isBooked = bookedDates[i];
            const isMorningBooked = isBooked?.morning;
            const isEveningBooked = isBooked?.evening;

            calendar.push(
                <div
                    key={`date-${i}`}
                    className={`date-cell ${isBooked ? "booked" : ""}`}
                    onClick={() => handleDateClick(i, isBooked)}
                >
                    {i}
                    {isBooked && (
                        <div className="booking-indicator">
                            {isMorningBooked && <div className="morning-booked"></div>}
                            {isEveningBooked && <div className="evening-booked"></div>}
                        </div>
                    )}
                </div>
            );
        }

        return calendar;
    };

    // Handle date click
    const handleDateClick = (date, isBooked) => {
        if (isBooked) {
            setSelectedDate({ date, details: isBooked.details });
            setShowPopup(true);
        }
    };

    // Handle month navigation
    const handleMonthChange = (direction) => {
        const newDate = new Date(currentDate);
        newDate.setMonth(currentDate.getMonth() + direction);
        setCurrentDate(newDate);
    };

    return (
        <div className="calendar-container">
            <div className="calendar-header">
                <button onClick={() => handleMonthChange(-1)}>&lt;</button>
                <h2>
                    {currentDate.toLocaleString("default", { month: "long" })} {currentDate.getFullYear()}
                </h2>
                <button onClick={() => handleMonthChange(1)}>&gt;</button>
            </div>
            <div className="calendar-grid">{renderCalendar()}</div>

            {/* Popup for booked dates */}
            {showPopup && (
                <div className="popup">
                    <div className="popup-content">
                        <h3>Booking Details</h3>
                        <p>{selectedDate.details}</p>
                        <button onClick={() => setShowPopup(false)}>Close</button>
                    </div>
                </div>
            )}
        </div>
    );
};

export default VenueBookingCalendar;