import React, { useState } from 'react';
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/react"; 

const VenueSearch = ({ areas, venuetypes, venueamenities, venuelist, currentInstance, filters }) => {
    const [searchArea, setSearchArea] = useState(filters.searchArea || '');
    const [searchType, setSearchType] = useState(filters.searchType || '');
    const [searchSubtype, setSearchSubtype] = useState(filters.searchSubtype || '');
    const [selectedAmenities, setSelectedAmenities] = useState(filters.selectedAmenities || []);
    const [sortBy, setSortBy] = useState(filters.sortBy || '');

    const handleFilterChange = () => {
        Inertia.get(route('venue.search'), {
            searchArea,
            searchType,
            searchSubtype,
            selectedAmenities,
            sortBy,
        }, {
            preserveState: true,
            replace: true,
        });
    };

    return (
        <div className="container mx-auto p-4">
            <Head title="Venue Search" />

            <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <select
                    value={searchArea}
                    onChange={(e) => setSearchArea(e.target.value)}
                    className="p-2 border rounded"
                >
                    <option value="">Select Area</option>
                    {areas.map((area) => (
                        <option key={area.id} value={area.id}>
                            {area.Arename}
                        </option>
                    ))}
                </select>

                <select
                    value={searchType}
                    onChange={(e) => setSearchType(e.target.value)}
                    className="p-2 border rounded"
                >
                    <option value="">Select Venue Type</option>
                    {venuetypes.map((type) => (
                        <option key={type.id} value={type.id}>
                            {type.venuetype_name}
                        </option>
                    ))}
                </select>

                <select
                    value={searchSubtype}
                    onChange={(e) => setSearchSubtype(e.target.value)}
                    className="p-2 border rounded"
                >
                    <option value="">Select Venue Subtype</option>
                    {venuetypes
                        .find((type) => type.id === searchType)
                        ?.subtypes?.map((subtype) => (
                            <option key={subtype.id} value={subtype.id}>
                                {subtype.subtype_name}
                            </option>
                        ))}
                </select>

                <select
                    value={sortBy}
                    onChange={(e) => setSortBy(e.target.value)}
                    className="p-2 border rounded"
                >
                    <option value="">Sort By</option>
                    <option value="price_asc">Price Low to High</option>
                    <option value="price_desc">Price High to Low</option>
                    <option value="featured">Featured</option>
                    <option value="alphabetical_asc">Alphabets A - Z</option>
                    <option value="alphabetical_desc">Alphabets Z - A</option>
                </select>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                {venuelist.map((venue) => (
                    <div key={venue.id} className="bg-white shadow-sm p-4 rounded">
                        <img src={venue.bannerimage} alt={venue.venuename} className="w-full h-48 object-cover" />
                        <h2 className="text-xl font-bold mt-2">{venue.venuename}</h2>
                        <p>{venue.venueaddress}</p>
                        <p>{venue.description}</p>
                        <Link href={route('venue.details', venue.id)} className="text-blue-500">
                            View Details
                        </Link>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default VenueSearch;