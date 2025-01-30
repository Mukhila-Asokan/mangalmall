import React, { useState, useEffect } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from "@inertiajs/react"; 
import { route } from "ziggy-js";
import Select from "react-select"; 
import AsyncSelect from "react-select/async";


const baseImageUrl = window.location.origin + "/storage/";
const baseurl = window.location.origin;
console.log(baseurl);

const VenueSearch = ({ areas = [], venuetypes = [], venueamenities = [], venuelist = [], currentInstance = {}, filters = {} }) => {
const [searchArea, setSearchArea] = useState(filters?.searchArea || '');
//const [selectedArea, setSelectedArea] = useState(null);
const [searchType, setSearchType] = useState(filters?.searchType || '');
const [searchSubtype, setSearchSubtype] = useState(filters?.searchSubtype || '');
const [selectedAmenities, setSelectedAmenities] = useState(filters?.selectedAmenities || []);
const [sortBy, setSortBy] = useState(filters?.sortBy || '');
const [venueSubtypes, setVenueSubtypes] = useState([]);


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
        console.error("Error fetching areas:", error);
    }
};


  // Convert data for react-select format
    const areaOptions = areas.map((area) => ({
        value: area.id,
        label: `${area.Areaname}, ${area.City}`
    }));


    const handleCheckboxChange = (event) => {
        const value = event.target.value;
        if (selectedAmenities.includes(value)) {
            setSelectedAmenities(selectedAmenities.filter((id) => id !== value));
        } else {
            setSelectedAmenities([...selectedAmenities, value]);
        }
    };

 

console.log('React filters:', filters);
const handleFilterChange = () => {
     console.log(" handleFilterChange triggered!", {
        searchArea,
        searchType,
        searchSubtype,
        selectedAmenities,
        sortBy,
    });

    Inertia.get(`/home/venuereact-search`, {
        searchArea,
        searchType,
        searchSubtype,
        selectedAmenities,
        sortBy,
    }, {
        preserveState: true,
        replace: true,
          onSuccess: (page) => {
            console.log("New venues fetched:", page.props.venuelist);
            setVenues(page.props.venuelist);  // Update the state with new venue list
        }
    });
};


const handleReset = () => {
    console.log("Resetting all filters...");

    setSearchArea('');   
    setSearchType('');
    setSearchSubtype('');
    setSelectedAmenities([]);
    setSortBy('');

    // Optionally, trigger a search with empty filters
    Inertia.get('/home/venuereact-search', {
        searchArea: '',
        searchType: '',
        searchSubtype: '',
        selectedAmenities: [],
        sortBy: '',
    }, {
        preserveState: true,
        replace: true,
    });
};


     // Fetch subtypes when searchType changes
    useEffect(() => {
        if (searchType) {
            fetch(`/get-subtypes/${searchType}`) // 
                .then(response => response.json())
                .then(data => setVenueSubtypes(data))
                .catch(error => console.error("Error fetching subtypes:", error));
        } else {
            setVenueSubtypes([]); // Clear subtypes if no type is selected
        }
    }, [searchType]);

    return (
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
                                                value={amenity.id}
                                                checked={selectedAmenities.includes(amenity.id)}
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
                {venuelist.map((venue) => (
                  
                  <div key={venue.id} className="col-md-6 col-lg-6 single-service-plane rounded white-bg shadow-sm p-5 mt-md-4 mt-lg-4">
                <div className="features-box p-4">
                    <div className="features-box-icon">
                    {(() => {
                    const imageUrl = `${baseImageUrl}${venue.bannerimage}`; // ✅ Now inside the return block
                    return <img src={imageUrl} alt={venue.venuename} style={{ width: "100px" }} />;
                })()}
                </div>
                <div className="features-box-content">     
                        
                        <h4 className="text-xl font-bold mt-2">{venue.venuename}</h4>
                        <p>{venue.venueaddress}</p>
                         <p>City {venue.description}</p>
                        <p>{venue.description}</p>
                <div className="text-end">
                         <Link href={`/home/${venue.id}/venuedetails`} className="text-blue-500">
                             View Details
                         </Link>
                </div>
                    </div>
                </div>
                </div>
                ))}
            </div>
        </div>
    );
};

export default VenueSearch;