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
    const [searchSubtype, setSearchSubtype] = useState(filters?.searchSubtype || '');
    const [selectedAmenities, setSelectedAmenities] = useState(filters?.selectedAmenities || []);
    const [sortBy, setSortBy] = useState(filters?.sortBy || '');
    const [venueSubtypes, setVenueSubtypes] = useState([]);
    const [currentPage, setCurrentPage] = useState(1); // Default to page 1
    const [lastPage, setLastPage] = useState(1); // Default to 1 page available

      const { auth } = usePage().props; // Get auth data
      console.log('Auth data:', auth); 

    console.log(initialVenuelist['data']);
  
    useEffect(() => {
        setVenues(initialVenuelist['data']);
    }, [initialVenuelist]);

    const loadOptions = async (inputValue, callback) => {
        if (!inputValue) return callback([]);

        try {
            const response = await fetch(`${baseurl}/api/areas?query=${inputValue}`);
            const data = await response.json();

            const options = data.map((area) => ({
                value: area.id,
                label: `${area.Areaname}, ${area.City}`
            }));

            callback(options);
        } catch (error) {
            console.log("Error fetching areas:", error);
        }
    };

    const handleCheckboxChange = (event) => {
         const checked = event.target.checked;
		
        const value = event.target.value;
		
		setSelectedAmenities((prevSelected) => {
            console.log("Previous selected:", prevSelected); // Check previous state

            if (prevSelected.includes(value)) {
                console.log("Removing:", value);
                return prevSelected.filter((id) => id !== value); // Uncheck
            } else {
                console.log("Adding:", value);
                return [...prevSelected, value]; // Check
            }
        });
		
   };

    const handleFilterChange = async () => {
        console.log("Fetching venues with filters:", {
            searchArea,
            searchType,
            searchSubtype,
            selectedAmenities,
            sortBy,
            currentPage,
        });

        try {
            const queryParams = new URLSearchParams({
                searchArea: searchArea?.value || "",
                searchType,
                searchSubtype,
                selectedAmenities: selectedAmenities.join(","),
                sortBy,
                page: currentPage,
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
            handleFilterChange(); // Fetch new page data
        }
    };

    const handleReset = () => {
        console.log("Resetting all filters...");

        setSearchArea('');
        setSearchType('');
        setSearchSubtype('');
        setSelectedAmenities([]);
        setSortBy('');

        Inertia.get('/home/venuereact-search', {}, {
            preserveState: true,
            replace: true,
        });
    };

    useEffect(() => {
        if (searchType) {
            fetch(`/get-subtypes/${searchType}`)
                .then(response => response.json())
                .then(data => setVenueSubtypes(data))
                .catch(error => console.error("Error fetching subtypes:", error));
        } else {
            setVenueSubtypes([]);
        }
    }, [searchType]);

    return (
        <div className="mx-auto p-1" style={{ width: "100%" }}>
         
           <Head title="Venue Search" />
            <div className="mx-auto p-1" style={{ width: "100%" }}>
            <Head title="Venue Search" />

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
                    value={searchSubtype}                  

                    onChange={(e) => {
        console.log("setSearchSubtype:", e.target.value);
        setSearchSubtype(e.target.value);

          handleFilterChange();

    }}
                    className="aysncselecttag">
                    <option value="">Select Venue Subtype</option>
                    {venueSubtypes.map((subtype) => (
                                <option key={subtype.id} value={subtype.id}>
                                    {subtype.venuetype_name}
                                </option>
                            ))}
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
        </div>


        <div className="row pt-2 col-12">
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
                                                /* value={amenity.id}
                                                checked={selectedAmenities.includes(amenity.id)} */
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div className="row pt-2 col-12">
            <div className="col-md-2 col-lg-2">
       
        <button 
    onClick={() => {
        console.log("Button Clicked! Calling handleFilterChange...");
        handleFilterChange();
    }} 
    className="btn primary-solid-btn btn-block btn-not-rounded mt-3"
>
    Search
</button>

</div>

  <div className="col-md-2 col-lg-2">
       
        <button 
    onClick={() => {
        handleReset();
    }} 
    className="btn primary-solid-btn btn-block btn-not-rounded mt-3"
>
    Reset
</button>

</div>
</div>
            <div className="row grid grid-cols-1 gap-4 lg:grid-cols-3 md:grid-cols-2">
                {Array.isArray(venues) && venues.length > 0 ? (
                    venues.map((venue) => (
                        <div key={venue.id} className="col-md-6 col-lg-6 single-service-plane rounded white-bg shadow-sm p-5 mt-md-4 mt-lg-4">
                            <div className="features-box p-4">
                                <div className="features-box-icon">
                                    <img src={`${baseImageUrl}${venue.bannerimage}`} alt={venue.venuename} style={{ width: "100px" }} />
                                </div>
                                <div className="features-box-content">
                                    <h4 className="text-xl font-bold mt-2">{venue.venuename}</h4>
                                    <p>{venue.venueaddress}</p>
                                    <p>City {venue.description}</p>
                                    <p>{venue.description}</p>
                                    <div className="text-end">

                                     {auth.user ? (

                                        <Link href={`/home/venuesearch/${venue.id}/venuedetails`} className="text-blue-500">
                                            View Details
                                        </Link>
                                       ) : (
                                        
                                          <Link href={`/home/${venue.id}/venuedetails`} className="text-blue-500">
                                            View Details
                                        </Link>

                                         )}
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
            <div className="pagination-controls row">
                <button
                    onClick={() => handlePageChange(currentPage - 1)}
                    disabled={currentPage === 1}
                    className="col-md-1 btn primary-solid-btn btn-block btn-not-rounded mt-3"
                >
                   <FontAwesomeIcon icon={faArrowLeft} />
                </button>

                <span className="col-md-4 mt-3"> Page {currentPage} of {lastPage} </span>

                <button
                    onClick={() => handlePageChange(currentPage + 1)}
                    disabled={currentPage === lastPage}
                    className="col-md-1 btn primary-solid-btn btn-block btn-not-rounded mt-3"
                >
                    <FontAwesomeIcon icon={faArrowRight} />
                </button>
            </div>
        </div>

        </div>
    );
};

export default VenueSearch;

