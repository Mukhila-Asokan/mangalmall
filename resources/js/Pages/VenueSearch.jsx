import React, { useState, useEffect } from 'react';
import { usePage, Head, Link } from "@inertiajs/react";
import { Inertia } from '@inertiajs/inertia';
import Select from "react-select";
import AsyncSelect from "react-select/async";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faArrowLeft, faArrowRight } from '@fortawesome/free-solid-svg-icons';


const baseImageUrl = window.location.origin + "/storage/";
const baseurl = window.location.origin;
console.log(baseurl);


const VenueSearch = ({ areas = [], venuetypes = [], venueamenities = [], venuelist: initialVenuelist = [], currentInstance = {}, filters = {} }) => {
    const [venues, setVenues] = useState(initialVenuelist); // Manage venuelist as state
    const [searchArea, setSearchArea] = useState(filters?.searchArea || '');
    const [searchType, setSearchType] = useState(filters?.searchType || '');
   /* const [searchSubtype, setSearchSubtype] = useState(filters?.searchSubtype || '');*/
    const [selectedAmenities, setSelectedAmenities] = useState(filters?.selectedAmenities || []);
    const [sortBy, setSortBy] = useState(filters?.sortBy || '');
    const [capacity, setcapacity] = useState(filters?.capacity || '');
    const [amenities, setAmenities] = useState(filters?.venueamenities || '');
    /*const [venueSubtypes, setVenueSubtypes] = useState([]);*/
    const [currentPage, setCurrentPage] = useState(1); // Default to page 1
    const [lastPage, setLastPage] = useState(1); // Default to 1 page available
    const [budgetPerPlate, setBudgetPerPlate] = useState(filters?.budgetPerPlate || '');
    const [budgetPerDay, setBudgetPerDay] = useState(filters?.budgetPerDay || '');
    const  [ratings, setRatings] = useState(filters?.ratings || '');    
    const  [foodtype, setFoodtype] = useState(filters?.foodtype || '');

      const { auth } = usePage().props; // Get auth data
      console.log('Auth data:', auth); 

    console.log(initialVenuelist['data']);
  
    useEffect(() => {
        setVenues(initialVenuelist['data']);
        setCurrentPage(initialVenuelist['current_page'] || 1);
        setLastPage(initialVenuelist['last_page'] || 1);
    }, [initialVenuelist]);

    const loadOptions = async (inputValue, callback) => {
        if (!inputValue) return callback([]);

        try {
            const response = await fetch(`${baseurl}/api/areas?query=${inputValue}`);
            const data = await response.json();
            console.log("Fetched areas:", data);
            const options = data.map((area) => ({
                label: area.cityname, // Display name
                value: area.id // Internal value
            }));

            callback(options);
        } catch (error) {
            console.log("Error fetching areas:", error);
        }
    };

//     const handleCheckboxChange = (event) => {
//          const checked = event.target.checked;
		
//         const value = event.target.value;
		
// 		setSelectedAmenities((prevSelected) => {
//             console.log("Previous selected:", prevSelected); // Check previous state

//             if (prevSelected.includes(value)) {
//                 console.log("Removing:", value);
//                 return prevSelected.filter((id) => id !== value); // Uncheck
//             } else {
//                 console.log("Adding:", value);
//                 return [...prevSelected, value]; // Check
//             }
//         });
		
//    };

    const handleFilterChange = async (page = 1) => {
        console.log("Fetching venues with filters:", {
            searchArea,
            searchType,
            capacity,
            selectedValues,
            sortBy,
            currentPage,
        });

        try {
            const queryParams = new URLSearchParams({
                searchArea: searchArea?.value || "",
                searchType,
                capacity,
                selectedAmenities: selectedValues.map(item => item.value).join(','),
                sortBy,
                page,
            });

            console.log("Query Params:", queryParams.toString());

            const response = await fetch(`/api/venuereact-search?${queryParams}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            });

            console.log("API Response Status:", response.status);

            if (!response.ok) {
                throw new Error("Failed to fetch venues");
            }

            const data = await response.json();
            console.log("API Response Data:", data);

            if (data && data.venuelist && Array.isArray(data.venuelist.data)) {
                setVenues(data.venuelist.data);
            } else {
                console.log(data.venuelist.data);
                console.error("Invalid data format: data.data is not an array");
                setVenues([]);
            }

            setCurrentPage(data.current_page || 1);
            setLastPage(data.last_page || 1);
        } catch (error) {
            console.log("Error fetching venues:", error);
            setVenues([]);
        }
    };

    const handlePageChange = (newPage) => {
        if (newPage >= 1 && newPage <= lastPage) {
            setCurrentPage(newPage);
            handleFilterChange(newPage);  
        } else {
            console.log("No more pages available.");
        }
    };
    const handleReset = () => {
        console.log("Resetting all filters...");

        setSearchArea('');
        setSearchType('');
       
        setSelectedAmenities([]);
        setSortBy('');

        Inertia.get('/home/venuereact-search', {}, {
            preserveState: true,
            replace: true,
        });
    };


    const shareOnFacebook = () => {
        const url = window.location.href;
        const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
        window.open(facebookShareUrl, "_blank");
    };
    
    const shareOnTwitter = () => {
        const url = window.location.href;
        const twitterShareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}`;
        window.open(twitterShareUrl, "_blank");
    };
    
    const shareOnWhatsApp = () => {
        const url = window.location.href;
        const whatsappShareUrl = `https://wa.me/?text=${encodeURIComponent(url)}`;
        window.open(whatsappShareUrl, "_blank");
    };
    
    const shareOnLinkedIn = () => {
        const url = window.location.href;
        const linkedInShareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
        window.open(linkedInShareUrl, "_blank");
    };
    const MultiSelectDropdown = ({ options, selectedAmenities, setSelectedAmenities }) => {
        const handleChange = (selected) => {
            console.log("Selected:", selected);
            setSelectedAmenities(selected || []);
        };
    
        return (
            <Select
                isMulti
                options={options}
                value={selectedAmenities}
                onChange={handleChange}
                className="basic-multi-select aysncselecttag"
                classNamePrefix="select"
                placeholder="Select Amenities..."
            />
        );
    };

    const options = venueamenities.map((type) => ({
        value: type.id,
        label: type.amenities_name,
    }));
    const selectedValues = options.filter(option => amenities.includes(option.value));

    return (
        <div className="mx-auto p-1" style={{ width: "100%" }}>
         
           <Head title="Venue Search" />
            <div className="mx-auto p-1" style={{ width: "100%" }}>
            <Head title="Venue Search" />

            <h4>Filters</h4>
            <div className='border p-2'>
            <div className="row pt-2 col-12">
                <div className="col-lg-3 col-md-3">
                    <div className="form-group">
                <AsyncSelect
                    cacheOptions
                    loadOptions={loadOptions}
                    onChange={setSearchArea}
                    placeholder="Search an area..."
                    defaultOptions // Load initial options
                    className="aysncselecttag"
                />

                    
                </div>
            </div>

            <div className="col-lg-3 col-md-3">
                <div className="form-group">
                    <select
                        value={searchType}
                    onChange={(e) => {
            console.log("searchType changed:", e.target.value);
            setSearchType(e.target.value);
        }}
                        className="aysncselecttag" >
                        <option value="">Select Venue Type</option>
                        {venuetypes.map((type) => (
                            <option key={type.id} value={type.id}>
                                {type.venuetype_name}
                            </option>
                        ))}
                    </select>
                </div>
            </div>
            <div className="col-lg-3 col-md-3">
                <div className="form-group">
                    <select
                        value={capacity}                  

                        onChange={(e) => {
            console.log("capacity:", e.target.value);
            setcapacity(e.target.value);

            handleFilterChange();

        }}   className="aysncselecttag">
                        <option value="">Select capacity</option>
                        <option value="100">Upto 100</option>  
                        <option value="100-300">100 - 300</option>
                        <option value="300-600">300 - 600</option>
                        <option value="600-1000">600 - 1000</option>
                        <option value="1000">Above 1000</option>                   
                    </select>
                </div>
            </div>
            <div className="col-lg-3 col-md-3">
                <div className="form-group">

                    <select
                        value={sortBy}

                        onChange={(e) => {
            console.log("setSortBy changed:", e.target.value);
            setSortBy(e.target.value);
        }}
                        className="aysncselecttag" >
                        <option value="">Sort By</option>
                        <option value="price_asc">Price Low to High</option>
                        <option value="price_desc">Price High to Low</option>
                        <option value="featured">Featured</option>
                        <option value="alphabetical_asc">Alphabets A - Z</option>
                        <option value="alphabetical_desc">Alphabets Z - A</option>
                    </select>
                </div>
            </div>
        
            

                <div className="col-lg-3 col-md-3">
                <div className="form-group">

                    <select
                        value={budgetPerPlate}

                        onChange={(e) => {  }}
                        className="aysncselecttag" >
                        <option value="">Budget per Plate</option>
                        <option value="Upto 250">Upto 250</option>
                        <option value="251 - 500">251 - 500</option>
                        <option value="501 - 1000">501 - 1000</option>
                        <option value="Above 1000">Above 1000</option>
                    
                    </select>
                </div>
            </div>


            <div className="col-lg-3 col-md-3">
                <div className="form-group">

                    <select
                        value={budgetPerDay}

                        onChange={(e) => {  }}
                        className="aysncselecttag" >
                        <option value="">Budget per Day</option>
                        <option value="Upto 10000">Upto 10000</option>
                        <option value="10001 -20000">10001 -20000</option>
                        <option value="20001 - 50000">20001 - 50000</option>
                        <option value="Above 50000">Above 50000</option>
                    
                    </select>
                </div>
            </div>

            <div className="col-lg-3 col-md-3">
                <div className="form-group">

                    <select
                        value={ratings}

                        onChange={(e) => {  }}
                        className="aysncselecttag" >
                        <option value="">Ratings</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    
                    
                    </select>
                </div>
            </div>

            
            <div className="col-lg-3 col-md-3">
                <div className="form-group">
                    <select
                        value={foodtype}
                        onChange={(e) => {  }}
                        className="aysncselecttag">
                        <option value="">Food Type</option>
                        <option value="veg">Veg</option>
                        <option value="nonveg">Non-Veg</option>
                        <option value="both">Veg & Non-Veg</option>
                    </select>
                </div>
            </div>

            <div className="col-lg-6 col-md-6">
                <div className="form-group">
                    {/* <select
                        value={amenities}
                        onChange={(e) => {
                            console.log("amenities changed:", e.target.value);
                            setAmenities(e.target.value);
                        }}
                        className="selectpicker form-control aysncselecttag" >
                        <option value="">Select Amenities</option>
                        {venueamenities.map((type) => (
                            <option key={type.id} value={type.id}>
                                {type.amenities_name}
                            </option>
                        ))}
                    </select> */}
                    <MultiSelectDropdown
                    options={options}
                    selectedAmenities={selectedValues}
                    setSelectedAmenities={(selected) => setAmenities(selected.map(s => s.value))}
                />
                </div>
            </div>
            <div className="col-lg-3 col-md-2"></div>
            <div className="d-flex justify-content-between col-lg-3 col-md-3 form-group p-0 m-0">
                <button 
                    onClick={() => {
                        console.log("Button Clicked! Calling handleFilterChange...");
                        handleFilterChange();
                    }} 
                    className="btn primary-solid-btn btn-not-rounded h-75"
                >
                    Search
                </button>
                <button 
                    onClick={() => {
                        handleReset();
                    }} 
                    className="btn primary-solid-btn btn-not-rounded ml-3 h-75"
                >
                    Clear All
                </button>
            </div>

                </div>
        </div>
      
        {/* <div className="row pt-2 col-12">
            <div className="col-md-12 col-lg-12">

        

                <div id="accordion-one" className="accordion accordion-faq">
                    <div className="card mb-0 px-4">
                        <a className="card-header collapsed" data-toggle="collapse" href="#collapseTwo-one">
                            <h6 className="mb-0 d-inline-block">Filter</h6>
                        </a>
                        <div id="collapseTwo-one" className="collapse" data-parent="#accordion-one">
                            <div className="card-body">
                                <div className="row pt-2 col-12">
                                    {venueamenities.map((amenity) => (
                                        <div key={amenity.id} className="form-check col-4 pt-2">
                                            <input
                                                type="checkbox"
                                                className="form-check-input"
                                                value={amenity.id}
                                                checked={selectedAmenities.includes(amenity.id)}
												value={amenity.id.toString()} // Convert to string
										checked={selectedAmenities.includes(amenity.id.toString())}
                                                 onChange={(event) => {
        console.log("Amenity changed:", event.target.value);
        handleCheckboxChange(event);
    }}
                                            />
                                            <label className="form-check-label" htmlFor={`amenity-${amenity.id}`}>
                                                {amenity.amenities_name}
                                            </label>
                                        </div>
                                    ))}
                                </div>
                                <div className="row pt-5 col-12">
                                    
                                </div>    

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> */}

         {/* <div className="row pt-2 col-12">
            <div className="col-md-2 col-lg-2"> */}
       
        {/* <button 
    onClick={() => {
        console.log("Button Clicked! Calling handleFilterChange...");
        handleFilterChange();
    }} 
    className="btn primary-solid-btn btn-block btn-not-rounded mt-3"
>
    Search
</button> */}

{/* </div>

  <div className="col-md-2 col-lg-2"> */}
       
        {/* <button 
    onClick={() => {
        handleReset();
    }} 
    className="btn primary-solid-btn btn-block btn-not-rounded mt-3"
>
    Clear All
</button> */}

{/* </div>
</div> */}
<br  ></br>
            <div className="row grid grid-cols-1 gap-4 lg:grid-cols-3 md:grid-cols-2">
                {Array.isArray(venues) && venues.length > 0 ? (
                    venues.map((venue) => (
                        <div key={venue.id} className="col-md-4 mtb-2">
                            <div className="card rounded white-bg shadow-sm p-1">
                            {/* <div className="favorite-icon"> <i className="bi bi-heart"></i> </div>  */}
                            <div className="image-container"><img src={`${baseImageUrl}${venue.bannerimage}`} className="venue-img" alt={venue.venuename}/></div>
                            {/* <div className="label-container"> 
                                <span className="label-badge trusted single-service-plane">Trusted</span>  
                               
                            </div> */}
                            
                            <div className="card-body pb-0"> 
                                <h6 className="card-title mb-2">{venue.venuename}</h6>
                                <div className="card-text d-flex align-items-center">
                                <div style={{ verticalAlign: 'middle' }}>
                                    {venue.venueaddress.length > 45 
                                    ? venue.venueaddress.slice(0, 45) + "..." 
                                    : venue.venueaddress}
                                </div>

                                 </div>
                               
                                <div className='d-flex justify-content-between'>
                                <div className="d-inline-flex" style={{ verticalAlign: 'middle' }}>
                                    <div className="rating pl-2 pr-2 rounded ml-0 mt-2 mb-3" style={{ backgroundColor: '#58111A' }}>
                                        <span className="text-white ms-2">
                                            <i className="bi bi-star-fill" style={{ color: "gold" }}></i> {venue?.ratings_avg_rating ? parseFloat(venue.ratings_avg_rating).toFixed(1) : "0.0"}
                                        </span>
                                    </div>
                                    <span className="ml-1 mt-2 text-muted" style={{ fontSize: "13px" }}>
                                        ({venue?.ratings_count ?? 0})
                                    </span>
                                </div>

                                <div className="price d-flex flex-column">
                                    <div>Price Per Day</div>
                                    <div className="text-muted">₹ {venue.bookingprice}</div>
                                    </div>
                                </div>

                                <div className='d-flex justify-content-between'>                         
                            <div className="contact-info">
                                <div className="card-text d-inline-flex">
                                <div className="p-2"><i className="bi bi-person-fill text-primary" style={{ verticalAlign: 'middle' }}></i> <span style={{ verticalAlign: 'middle' }}>{venue.contactperson}</span> 
</div>
                                </div>
                            </div>
                            <div className="contact-info">
                            <div className="card-text d-inline-flex">
                                <div className='p-2'><i className="bi bi-telephone-fill text-primary" style={{ verticalAlign: 'middle' }}></i> <a href="tel:+1234567890" className="text-decoration-none"> <span style={{ verticalAlign: 'middle' }}> {venue.contactmobile}</span></a></div>
                            </div>
                        </div>  
                        </div> 
                        <hr></hr>

                        <div className="share-icons d-flex justify-content-between align-items-center mtb-1">
                            <div className='p-2'>
                                <a href="#" onClick={shareOnFacebook}>
                                    <i className="bi bi-facebook fs-5"></i>
                                </a>
                                <a href="#" onClick={shareOnTwitter}>
                                    <i className="bi bi-twitter fs-5"></i>
                                </a>
                                <a href="#" onClick={shareOnWhatsApp}>
                                    <i className="bi bi-whatsapp fs-5"></i>
                                </a>
                                <a href="#" onClick={shareOnLinkedIn}>
                                    <i className="bi bi-linkedin fs-5"></i>
                                </a>
                            </div>
                           
                            <a href={`/home/venuesearch/${venue.id}/venuedetails`} className="btn btn-primary btn-sm" target='_new'>
                                View Details
                            </a>
                         
                        </div>
                        </div>    
                            </div>
                        </div>
                    ))
                ) : (
                    <p>No venues found.</p>
                )}
            </div>

            {/* Pagination Buttons */}
           <hr />
            <div className="pagination-controls row mt-1" style={{ width: "50%", float: "right" }}>
                <div className="col-md-2">
                    <button
                        onClick={() => handlePageChange(currentPage - 1)}
                        disabled={currentPage === 1}
                        className="col-1 btn primary-solid-btn btn-not-rounded mt-3"
                    >
                        <FontAwesomeIcon icon={faArrowLeft} />
                    </button>
                </div>
                <div className="col-md-3 mt-2">
                    <span className=""> <p className="mt-3">Page {currentPage} of {lastPage} </p></span>
                </div>
                <div className="col-md-2">
                    <button
                        onClick={() => handlePageChange(currentPage + 1)}
                        disabled={currentPage === lastPage}
                        className="col-md-1 btn primary-solid-btn btn-not-rounded mt-3"
                    >
                        <FontAwesomeIcon icon={faArrowRight} />
                    </button>
                </div>
            </div>
            
        </div>

        </div>
    );
};

export default VenueSearch;