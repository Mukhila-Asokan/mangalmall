import React, { useState, useEffect } from 'react';
import Slider from 'react-slick';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

const baseImageUrl = window.location.origin + "/public/storage/";
console.log(baseImageUrl);

const AdsSlider = () => {
    const [ads, setAds] = useState([]);
    const [loading, setLoading] = useState(true);

    // Fetch random ads from the backend
    useEffect(() => {
        const fetchAds = async () => {
            try {
                const response = await fetch('/home/ads/random');
                const data = await response.json();
                
                // Only update if data has changed
                if (JSON.stringify(data.ads) !== JSON.stringify(ads)) {
                    setAds(data.ads || []);
                }
            } catch (error) {
                console.error('Error fetching ads:', error);
            } finally {
                setLoading(false);
            }
        };
    
        if (ads.length === 0) {  // Prevent repeated fetch
            fetchAds();
        }
    }, []);
    
    // Slider settings
    const sliderSettings = {
        dots: true,
        infinite: true,
        speed: 1000, // Adjust speed to slow down transition
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000, // Each ad stays visible for 5 seconds
        pauseOnHover: true, // Pause slider when hovered
        fade: true, // Smooth fade transition
    };

    return (
        <aside className="widget widget-categories p-2">
            <div className="widget-title p-2 text-center">
                <h5 className="text-center mb-3">Sponsored Ads</h5>
            </div>
            <div style={{ height: "300px", overflow: "hidden" }}>
            {loading ? (
                <p>Loading ads...</p>
            ) : ads.length > 0 ? (
                <Slider {...sliderSettings}>
                    {ads.map((ad) => (
                        <div key={ad.id} className="card" style={{ height: "100%" }}>
                            <div className="card-header">
                            <h5 className="card-title mb-2">{ad.title}</h5></div>
                            <img
                                src={`${baseImageUrl}${ad.image}`} // FIXED: Corrected Image Path
                                className="card-img-top"
                                alt={ad.title}
                                style={{ width: "100%", height: "100%", objectFit: "cover" }}
                                onError={(e) => e.target.src = '/default-ad.jpg'} // Fallback image
                            />
                            <div className="card-body">                             
                               
                                <a
                                    href={ad.url}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="btn btn-primary btn-sm"
                                >
                                    Learn More
                                </a>
                            </div>
                        </div>
                    ))}
                </Slider>
                
            ) : (
                <p>No Ads found.</p>
            )}
           </div> 
        </aside>
        
    );
};

export default AdsSlider;
