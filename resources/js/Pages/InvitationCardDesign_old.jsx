import React, { useState, useEffect } from 'react';
import { usePage, Head, Link } from "@inertiajs/react";
import { Inertia } from '@inertiajs/inertia';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faArrowLeft, faArrowRight } from '@fortawesome/free-solid-svg-icons';

const baseImageUrl = window.location.origin + "/";
const baseurl = window.location.origin;
console.log(baseurl);

const InvitationCardDesign = ({ occasiontype = [], cardTemplates: initialInvitationCards = [], filters = {} }) => {
    const [invitationCards, setInvitationCards] = useState(initialInvitationCards['data'] || []);
    const [occasionType, setOccasionType] = useState(filters?.occasionType || '');
    const [sortBy, setSortBy] = useState(filters?.sortBy || '');
    const [currentPage, setCurrentPage] = useState(initialInvitationCards['current_page'] || 1);
    const [lastPage, setLastPage] = useState(initialInvitationCards['last_page'] || 1);

  /*  useEffect(() => {
        setInvitationCards(initialInvitationCards['data']);
        setCurrentPage(initialInvitationCards['current_page'] || 1);
        setLastPage(initialInvitationCards['last_page'] || 1);
        handleFilterChange();
    }, [initialInvitationCards]);*/

    useEffect(() => {
        console.log(initialInvitationCards['data']);
        setInvitationCards(initialInvitationCards['data']);
        setCurrentPage(initialInvitationCards['current_page'] || 1);
        setLastPage(initialInvitationCards['last_page'] || 1);
    }, [initialInvitationCards]);

    const handleFilterChange = async (page = 1) => {
        try {
            page = Number(page) || 1;
            const queryParams = new URLSearchParams({
                occasionType: occasionType || '',
                sortBy: sortBy || '',
                page: page.toString(), 
            });
            
            const response = await fetch(`/api/home/invitationcard-occasiontype?${queryParams.toString()}`);

          
            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                throw new Error("Invalid JSON response from server");
            }

           
            if (!response.ok) {
                throw new Error("Failed to fetch invitation cards");
            }

            const data = await response.json();
            
            setInvitationCards(data.invitationCards.data);
            setCurrentPage(data.current_page || 1);
            setLastPage(data.last_page || 1);
        } catch (error) {
            console.log("Error fetching invitation cards:", error);
            setInvitationCards([]);
        }
    };

    const handlePageChange = (newPage) => {
        console.log(newPage);
        if (newPage >= 1 && newPage <= lastPage) {
            console.log("Changing page to:", newPage);
            setCurrentPage(newPage);
            handleFilterChange(newPage);  
        } else {
            console.log("No more pages available.");
        }
    };
    

    const handleReset = () => {
        setOccasionType('');
        setSortBy('');
        setCurrentPage(1);
    
        Inertia.get('/api/home/invitationcard-search', {}, {
            preserveState: true,
            replace: true,
        });
    };

    return (
        <div className="mx-auto p-1" style={{ width: "100%" }}>
            <Head title="Invitation Card Design" />
            <div className="row pt-2 col-12" style={{ width: "100%" }}>
                <div className="col-lg-3 col-md-3">
                    <div className="form-group">
                        <select
                            value={occasionType}
                            onChange={(e) => setOccasionType(e.target.value)}
                            className="form-control"
                        >
                            <option value="">Select Occasion Type</option>
                            {occasiontype.map((type) => (
                                <option key={type.id} value={type.id}>
                                    {type.eventtypename}
                                </option>
                            ))}
                        </select>
                    </div>
                </div>
                <div className="col-lg-3 col-md-3">
                    <div className="form-group">
                        <select
                            value={sortBy}
                            onChange={(e) => setSortBy(e.target.value)}
                            className="form-control"
                        >
                            <option value="">Sort By</option>
                            <option value="new">New</option>
                            <option value="popularity">Popularity</option>
                            <option value="upto3">Up to 3</option>
                        </select>
                    </div>
                </div>
                <div className="col-md-2 col-lg-2">
                    <button 
                        onClick={handleFilterChange} 
                        className="btn primary-solid-btn btn-block btn-not-rounded"
                    >
                        Search
                    </button>
                </div>
                <div className="col-md-2 col-lg-2">
                    <button 
                        onClick={handleReset} 
                        className="btn primary-solid-btn btn-block btn-not-rounded"
                    >
                        Clear All
                    </button>
                </div>
            </div>
            <section className="bg-light py-3 py-md-5">
            <div className="container overflow-hidden">
            <div className="row gy-3 gy-md-2 bsb-project-1-grid">
                {Array.isArray(invitationCards) && invitationCards.length > 0 ? (
                    invitationCards.map((card) => (
                        <div key={card.id} className="col-12 col-md-6 col-lg-3 bsb-project-1-item">
                            	<figure className="rounded rounded-4 overflow-hidden bsb-overlay-hover">
          <a href="#!">
            <img className="img-fluid bsb-scale-up bsb-hover-scale"  src={`${baseImageUrl}${card.templateimage}`} alt={card.templatename} />
          </a>
          <figcaption>
            <h6 className="text-white bsb-hover-fadeInLeft">{card.templatename}</h6>
            <div className="text-white bsb-hover-fadeInRight"> <div className="d-flex justify-content-between align-items-center">
                <div className='ml-2'>
                    <i className="fa fa-heart"></i>
                </div>
                <div className='ml-2'>
                    <i className="fa fa-eye"></i>
                </div>
                <div className='ml-2'>
                    <i className="fa fa-edit"></i>
                </div>
                <div className='ml-2'>
                    <i className="fa fa-share"></i>
                </div>
                 </div></div>
          </figcaption>
        </figure></div>
                      
                    ))
                ) : (
                    <p>No invitation cards found.</p>
                )}
                </div>
                </div>
            </section>
            <div className="pagination-controls row mt-4" style={{ width: "100%" }}>
                <div className="col-md-2">
                    <button
                        onClick={() => handlePageChange(currentPage - 1)}
                        disabled={currentPage === 1}
                        className="col-1 btn primary-solid-btn btn-block btn-not-rounded mt-3"
                    >
                        <FontAwesomeIcon icon={faArrowLeft} />
                    </button>
                </div>
                <div className="col-md-8">
                    <span className=""> <h6 className="mt-3">Page {currentPage} of {lastPage} </h6></span>
                </div>
                <div className="col-md-2">
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

export default InvitationCardDesign;