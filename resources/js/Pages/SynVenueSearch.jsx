import React, { useState, useEffect } from 'react';
import { usePage, Head, Link } from "@inertiajs/react";
import { Inertia } from '@inertiajs/inertia';

// Syncfusion Components
import { DropDownListComponent } from '@syncfusion/ej2-react-dropdowns';
import { ButtonComponent } from '@syncfusion/ej2-react-buttons';
import { CheckBoxComponent } from '@syncfusion/ej2-react-buttons';
import { AccordionComponent, AccordionItemsDirective, AccordionItemDirective } from '@syncfusion/ej2-react-navigations';
import { GridComponent, ColumnsDirective, ColumnDirective, Page } from '@syncfusion/ej2-react-grids';
import { DialogComponent } from '@syncfusion/ej2-react-popups';

const baseImageUrl = window.location.origin + "/storage/";
const baseurl = window.location.origin;

const VenueSearch = ({ areas = [], venuetypes = [], venueamenities = [], venuelist: initialVenuelist = [], currentInstance = {}, filters = {} }) => {
    const [venues, setVenues] = useState(initialVenuelist['data'] || []);
    const [searchArea, setSearchArea] = useState(filters?.searchArea || '');
    const [searchType, setSearchType] = useState(filters?.searchType || '');
    const [searchSubtype, setSearchSubtype] = useState(filters?.searchSubtype || '');
    const [selectedAmenities, setSelectedAmenities] = useState(filters?.selectedAmenities || []);
    const [sortBy, setSortBy] = useState(filters?.sortBy || '');
    const [venueSubtypes, setVenueSubtypes] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [lastPage, setLastPage] = useState(1);
    const { auth } = usePage().props;

    // Syncfusion Grid Pagination
    const pageSettings = { pageSize: 10 };

    // Load areas for Async Dropdown
    const loadAreas = async (query) => {
        const response = await fetch(`${baseurl}/api/areas?query=${query}`);
        const data = await response.json();
        return data.map((area) => ({ value: area.id, text: `${area.Areaname}, ${area.City}` }));
    };

    // Handle filter changes
    const handleFilterChange = async () => {
        const queryParams = new URLSearchParams({
            searchArea: searchArea?.value || "",
            searchType,
            searchSubtype,
            selectedAmenities: selectedAmenities.join(","),
            sortBy,
            page: currentPage,
        });

        const response = await fetch(`/api/venuereact-search?${queryParams}`);
        const data = await response.json();

        if (data && data.venuelist && Array.isArray(data.venuelist.data)) {
            setVenues(data.venuelist.data);
            setCurrentPage(data.current_page || 1);
            setLastPage(data.last_page || 1);
        } else {
            setVenues([]);
        }
    };

    // Handle page change
    const handlePageChange = (newPage) => {
        if (newPage >= 1 && newPage <= lastPage) {
            setCurrentPage(newPage);
            handleFilterChange();
        }
    };

    // Reset filters
    const handleReset = () => {
        setSearchArea('');
        setSearchType('');
        setSearchSubtype('');
        setSelectedAmenities([]);
        setSortBy('');
        Inertia.get('/home/venuereact-search', {}, { preserveState: true, replace: true });
    };

    // Fetch venue subtypes
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

            {/* Search Filters */}
            <div className="row pt-2 col-12">
                <div className="col-lg-3 col-md-3">
                    <DropDownListComponent
                        placeholder="Search an area..."
                        dataSource={loadAreas}
                        change={(e) => setSearchArea(e.itemData)}
                        fields={{ value: 'value', text: 'text' }}
                    />
                </div>

                <div className="col-lg-3 col-md-3">
                    <DropDownListComponent
                        placeholder="Select Venue Type"
                        dataSource={venuetypes}
                        fields={{ value: 'id', text: 'venuetype_name' }}
                        change={(e) => setSearchType(e.itemData.id)}
                    />
                </div>

                <div className="col-lg-3 col-md-3">
                    <DropDownListComponent
                        placeholder="Select Venue Subtype"
                        dataSource={venueSubtypes}
                        fields={{ value: 'id', text: 'venuetype_name' }}
                        change={(e) => setSearchSubtype(e.itemData.id)}
                    />
                </div>

                <div className="col-lg-3 col-md-3">
                    <DropDownListComponent
                        placeholder="Sort By"
                        dataSource={[
                            { value: 'price_asc', text: 'Price Low to High' },
                            { value: 'price_desc', text: 'Price High to Low' },
                            { value: 'featured', text: 'Featured' },
                            { value: 'alphabetical_asc', text: 'Alphabets A - Z' },
                            { value: 'alphabetical_desc', text: 'Alphabets Z - A' },
                        ]}
                        fields={{ value: 'value', text: 'text' }}
                        change={(e) => setSortBy(e.itemData.value)}
                    />
                </div>
            </div>

            {/* Amenities Filter */}
            <div className="row pt-2 col-12">
                <div className="col-md-12 col-lg-12">
                    <AccordionComponent>
                        <AccordionItemsDirective>
                            <AccordionItemDirective header="Filter" content={
                                <div className="row pt-2 col-12">
                                    {venueamenities.map((amenity) => (
                                        <div key={amenity.id} className="form-check col-4 pt-2">
                                            <CheckBoxComponent
                                                label={amenity.amenities_name}
                                                checked={selectedAmenities.includes(amenity.id.toString())}
                                                change={(e) => {
                                                    const value = amenity.id.toString();
                                                    setSelectedAmenities((prev) =>
                                                        e.checked ? [...prev, value] : prev.filter((id) => id !== value)
                                                    );
                                                }}
                                            />
                                        </div>
                                    ))}
                                </div>
                            } />
                        </AccordionItemsDirective>
                    </AccordionComponent>
                </div>
            </div>

            {/* Search and Reset Buttons */}
            <div className="row pt-2 col-12">
                <div className="col-md-2 col-lg-2">
                    <ButtonComponent onClick={handleFilterChange} cssClass="e-primary">Search</ButtonComponent>
                </div>
                <div className="col-md-2 col-lg-2">
                    <ButtonComponent onClick={handleReset} cssClass="e-danger">Reset</ButtonComponent>
                </div>
            </div>

            {/* Venue List */}
            <GridComponent dataSource={venues} allowPaging={true} pageSettings={pageSettings}>
                <ColumnsDirective>
                    <ColumnDirective field="venuename" headerText="Venue Name" />
                    <ColumnDirective field="venueaddress" headerText="Address" />
                    <ColumnDirective field="description" headerText="Description" />
                    <ColumnDirective
                        headerText="Action"
                        template={(row) => (
                            <Link href={`/home/venuesearch/${row.id}/venuedetails`} className="text-blue-500">
                                View Details
                            </Link>
                        )}
                    />
                </ColumnsDirective>
            </GridComponent>

            {/* Pagination */}
            <div className="pagination-controls row">
                <ButtonComponent
                    onClick={() => handlePageChange(currentPage - 1)}
                    disabled={currentPage === 1}
                    cssClass="e-primary"
                >
                    Previous
                </ButtonComponent>
                <span className="col-md-4 mt-3"> Page {currentPage} of {lastPage} </span>
                <ButtonComponent
                    onClick={() => handlePageChange(currentPage + 1)}
                    disabled={currentPage === lastPage}
                    cssClass="e-primary"
                >
                    Next
                </ButtonComponent>
            </div>
        </div>
    );
};

export default VenueSearch;