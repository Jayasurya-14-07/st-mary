export default function Footer() {
    return (
        <footer>
            <div className="container">
                <div className="row g-4 justify-content-between">
                    {/* Column 1: Brand & About */}
                    <div className="col-lg-4 col-md-6">
                        <a className="brand d-block mb-4" href="#home">
                            <img src="/images/logo-wide-light.png" alt="St. Mary’s Convent School, Chhallan, Ramkot" style={{ maxWidth: '280px', height: 'auto' }} />
                        </a>
                        <p style={{ fontSize: '0.95rem', lineHeight: '1.7', color: 'rgba(255,255,255,0.75)', maxWidth: '350px' }}>
                            <strong className="footer-motto">“Unit of Diocese of Jammu-Srinagar Education Society (DJSES)”</strong>
                        </p>
                    </div>

                    {/* Column 2: Explore Links */}
                    <div className="col-lg-2 col-md-6">
                        <h5>Explore</h5>
                        <a href="javascript:void(0);" className="footer-link">About the School</a>
                        <a href="javascript:void(0);" className="footer-link">Our Principals</a>
                        <a href="javascript:void(0);" className="footer-link">Our Staff</a>
                        <a href="javascript:void(0);" className="footer-link">Student Life</a>
                        <a href="javascript:void(0);" className="footer-link">Academics</a>
                        <a href="javascript:void(0);" className="footer-link">Activities</a>
                        <a href="javascript:void(0);" className="footer-link">Achievements</a>
                    </div>

                    {/* Column 3: Quick Links */}
                    <div className="col-lg-2 col-md-6">
                        <h5>Quick Links</h5>
                        <a href="javascript:void(0);" className="footer-link">About Us</a>
                        <a href="javascript:void(0);" className="footer-link">Affiliation</a>
                        <a href="javascript:void(0);" className="footer-link">Clubs</a>
                        <a href="javascript:void(0);" className="footer-link">Sports</a>
                        <a href="javascript:void(0);" className="footer-link">Facilities</a>
                        <a href="javascript:void(0);" className="footer-link">News &amp; Events</a>
                        <a href="javascript:void(0);" className="footer-link">Gallery</a>
                        <a href="javascript:void(0);" className="footer-link">Contact Us</a>
                    </div>

                    {/* Column 4: Address */}
                    <div className="col-lg-3 col-md-6">
                        <h5>Address</h5>
                        <div className="footer-contact-row">
                            <i className="fa-solid fa-location-dot"></i>
                            <div>St. Mary’s Convent School, Chhallan, Ramkot<br />
                                Vill. Chhallan, Ramkot, Teh. Ramkot,<br />
                                Dist. Kathua, J&amp;K (UT) – 184205</div>
                        </div>
                        <div className="footer-contact-row">
                            <i className="fa-solid fa-phone"></i>
                            <div>+91 8082171498</div>
                        </div>
                        <div className="footer-contact-row">
                            <i className="fa-solid fa-envelope"></i>
                            <div>smcsramkot@gmail.com</div>
                        </div>
                    </div>
                </div>

                {/* Footer Bottom */}
                <div className="footer-bottom d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <span>© {new Date().getFullYear()} St. Mary’s Convent School, Chhallan, Ramkot. All Rights Reserved.</span>
                    <span>Powered by <strong className="text-white">Bosco Soft Technologies Pvt Ltd</strong></span>
                </div>
            </div>
        </footer>
    );
}
