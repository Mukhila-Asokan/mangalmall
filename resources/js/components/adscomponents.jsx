import React, { useState, useEffect } from 'react';
import Slider from 'react-slick';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

const baseImageUrl = window.location.origin + "/storage/";
console.log(baseImageUrl);

const AdsSlider = () => {
    const [ads, setAds] = useState([]);
    const [loading, setLoading] = useState(true);

    // Fetch random ads from the backend
    useEffect(() => {
        const fetchAds = async () => {
            try {
                const response = await fetch('/home/ads/random'); // Replace with your API endpoint
                const data = await response.json();
                console.log("API Response:", data);
                
                if (data && data.ads) {
                    setAds(data.ads); // FIXED: Extract 'ads' array correctly
                } else {
                    setAds([]);
                }
            } catch (error) {
                console.error('Error fetching ads:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchAds();
    }, []);

    // Slider settings
    const sliderSettings = {
        dots: true,
        infinite: true,
        speed: 5000,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
    };

    return (
        <aside className="widget widget-categories shadow-lg p-2">
            <div className="widget-title p-2 text-center">
                <h5 className="text-center mb-3">Sponsored Ads</h5>
            </div>

            {loading ? (
                <p>Loading ads...</p>
            ) : ads.length > 0 ? (
                <Slider {...sliderSettings}>
                    {ads.map((ad) => (
                        <div key={ad.id} className="card">
                            <div className="card-header">
                            <h5 className="card-title mb-2">{ad.title}</h5></div>
                            <img
                                src={`${baseImageUrl}${ad.image}`} // FIXED: Corrected Image Path
                                className="card-img-top"
                                alt={ad.title}
                                style={{ height: '200px', objectFit: 'cover' }}
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
        </aside>
    );
};

export default AdsSlider;
