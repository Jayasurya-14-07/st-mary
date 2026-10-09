import { useEffect, useRef } from 'react';

export default function Navbar() {
    const navRef = useRef(null);

    useEffect(() => {
        const nav = navRef.current;
        if (nav) {
            const handleScroll = () => nav.classList.toggle('scrolled', window.scrollY > 20);
            window.addEventListener('scroll', handleScroll);
            return () => window.removeEventListener('scroll', handleScroll);
        }
    }, []);

    return (
        <>
            {/* Desktop & Main Navigation */}
            <nav className="navbar navbar-expand-lg sticky-top bg-white" id="mainNav" ref={navRef} style={{ zIndex: 1040 }}>
                <div className="container d-flex justify-content-between align-items-center">
                    <a className="navbar-brand py-0" href="#home">
                        <img src="/images/logo.png" alt="St. Mary's Convent School, Chhallan, Ramkot" style={{ height: '120px', objectFit: 'contain' }} />
                    </a>
                    <button className="navbar-toggler border-0 shadow-none d-lg-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#mobileOffcanvas" aria-controls="mobileOffcanvas">
                        <i className="fa-solid fa-bars fs-1" style={{ color: 'var(--navy)' }}></i>
                    </button>
                    <div className="collapse navbar-collapse d-none d-lg-flex" id="siteNav">
                        <ul className="navbar-nav ms-auto align-items-center">
                            <li className="nav-item"><a className="nav-link active" href="#home">Home</a></li>
                            <li className="nav-item dropdown">
                                <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">About Us</a>
                                <ul className="dropdown-menu">
                                    <li><a className="dropdown-item" href="#story">About the School</a></li>
                                    <li><a className="dropdown-item" href="#messages">Our Principals</a></li>
                                    <li><a className="dropdown-item" href="#messages">Leadership Team</a></li>
                                    <li><a className="dropdown-item" href="#messages">Our Staff</a></li>
                                </ul>
                            </li>
                            <li className="nav-item"><a className="nav-link" href="javascript:void(0);">Affiliation</a></li>
                            <li className="nav-item"><a className="nav-link" href="#clubs">Clubs</a></li>
                            <li className="nav-item"><a className="nav-link" href="javascript:void(0);">Sports</a></li>
                            <li className="nav-item"><a className="nav-link" href="javascript:void(0);">Facilities</a></li>
                            <li className="nav-item"><a className="nav-link" href="#news">News &amp; Events</a></li>
                            <li className="nav-item"><a className="nav-link" href="#gallery">Gallery</a></li>
                            <li className="nav-item ms-3 me-3">
                                <a className="btn btn-premium" href="javascript:void(0);">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            {/* Mobile Offcanvas Drawer */}
            <div className="offcanvas offcanvas-end" tabIndex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel"
                style={{ zIndex: 9999, backgroundColor: '#fff' }}>
                <div className="offcanvas-header border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                    <img src="/images/logo.png" alt="St. Mary's Convent School, Chhallan, Ramkot" style={{ height: '45px', objectFit: 'contain' }} />
                    <button type="button" className="btn-close shadow-none fs-5" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div className="offcanvas-body px-4 py-4">
                    <div className="d-lg-none mb-4 pb-4 border-bottom">
                        <a className="btn btn-premium w-100 py-3 d-flex justify-content-center" href="javascript:void(0);">Admission Enquiry</a>
                    </div>
                    <h6 className="text-uppercase text-muted fw-bold mb-3" style={{ letterSpacing: '0.1em', fontSize: '0.75rem' }}>Main Navigation</h6>
                    <ul className="navbar-nav flex-column mb-4 gap-2">
                        <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="#home" data-bs-dismiss="offcanvas">Home</a></li>
                        <li className="nav-item">
                            <a className="nav-link fw-bold text-dark fs-5 d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse" href="#mobileAboutDropdown" role="button">
                                About Us <i className="fa-solid fa-chevron-down fs-6"></i>
                            </a>
                            <div className="collapse ps-3 mt-1" id="mobileAboutDropdown">
                                <ul className="nav flex-column gap-1 border-start ps-2">
                                    <li className="nav-item"><a className="nav-link text-muted py-1" href="#story" data-bs-dismiss="offcanvas">About the School</a></li>
                                    <li className="nav-item"><a className="nav-link text-muted py-1" href="#messages" data-bs-dismiss="offcanvas">Our Principals</a></li>
                                    <li className="nav-item"><a className="nav-link text-muted py-1" href="#messages" data-bs-dismiss="offcanvas">Leadership Team</a></li>
                                    <li className="nav-item"><a className="nav-link text-muted py-1" href="#messages" data-bs-dismiss="offcanvas">Our Staff</a></li>
                                </ul>
                            </div>
                        </li>
                        <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="javascript:void(0);" data-bs-dismiss="offcanvas">Affiliation</a></li>
                        <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="#clubs" data-bs-dismiss="offcanvas">Clubs</a></li>
                        <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="javascript:void(0);" data-bs-dismiss="offcanvas">Sports</a></li>
                        <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="javascript:void(0);" data-bs-dismiss="offcanvas">Facilities</a></li>
                        <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="#news" data-bs-dismiss="offcanvas">News &amp; Events</a></li>
                        <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="#gallery" data-bs-dismiss="offcanvas">Gallery</a></li>
                        <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="#video-gallery" data-bs-dismiss="offcanvas">Video Gallery</a></li>
                        <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="javascript:void(0);" data-bs-dismiss="offcanvas">Contact</a></li>
                    </ul>
                </div>
            </div>
        </>
    );
}
