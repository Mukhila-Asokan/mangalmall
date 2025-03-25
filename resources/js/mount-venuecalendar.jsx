import React from 'react';
import { createRoot } from 'react-dom/client';
import VenueCalendarComponent from '@/components/venuecalendar';
import AdsSlider from './components/adscomponents';
import VideoCreator from './components/videomaking';

// Mount the component when the DOM is ready
if (document.getElementById('calendar-component')) {
    const root = createRoot(document.getElementById('calendar-component'));
    root.render(<VenueCalendarComponent />);
}

if (document.getElementById('adsslider-component')) {
    const root = createRoot(document.getElementById('adsslider-component'));
    root.render(<AdsSlider />);
}

if (document.getElementById('video-creator')) {
    const root = createRoot(document.getElementById('video-creator'));
    root.render(<VideoCreator />);
}