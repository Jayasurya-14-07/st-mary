import { Link } from '@inertiajs/react';

export default function Footer() {
    return (
        <footer>
            <div className="container">
                <div className="row g-4 justify-content-between">
                    {/* Column 1: Brand & About */}
                    <div className="col-lg-4 col-md-6">
                        <Link className="brand d-block mb-4" href="/">
                            <img src="/images/logo-wide-light.png" alt="St. Mary’s Convent School, Chhallan, Ramkot" style={{ maxWidth: '280px', height: 'auto' }} />
                        </Link>
                        <p style={{ fontSize: '0.95rem', lineHeight: '1.7', color: 'rgba(255,255,255,0.75)', maxWidth: '350px' }}>
                            <strong className="footer-motto">“Unit of Diocese of Jammu-Srinagar Education Society (DJSES)”</strong>
                        </p>
                    </div>

                    {/* Column 2: Explore Links */}
                    <div className="col-lg-2 col-md-6">
                        <h5>Explore</h5>
                        <Link href="/#story" className="footer-link">About the School</Link>
                        <Link href="/#messages" className="footer-link">Our Principals</Link>
                        <Link href="/#messages" className="footer-link">Our Staff</Link>
                        <Link href="/#clubs" className="footer-link">Student Life</Link>
                        <Link href="/facilities" className="footer-link">Academics</Link>
                        <Link href="/our-clubs" className="footer-link">Activities</Link>
                        <Link href="/gallery" className="footer-link">Achievements</Link>
                    </div>

                    {/* Column 3: Quick Links */}
                    <div className="col-lg-2 col-md-6">
                        <h5>Quick Links</h5>
                        <Link href="/#story" className="footer-link">About Us</Link>
                        <Link href="javascript:void(0);" className="footer-link">Affiliation</Link>
                        <Link href="/our-clubs" className="footer-link">Clubs</Link>
                        <Link href="javascript:void(0);" className="footer-link">Sports</Link>
                        <Link href="/facilities" className="footer-link">Facilities</Link>
                        <Link href="/news-events" className="footer-link">News &amp; Events</Link>
                        <Link href="/gallery" className="footer-link">Gallery</Link>
                        <Link href="/contact" className="footer-link">Contact Us</Link>
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
                        <div className="footer-contact-row align-items-center">
                            <i className="fa-solid fa-phone"></i>
                            <div>
                                <a href="tel:+918082171498" className="text-white-50 text-decoration-none">+91 8082171498</a>
                            </div>
                        </div>
                        <div className="footer-contact-row align-items-center">
                            <i className="fa-solid fa-envelope"></i>
                            <div>
                                <a href="mailto:school@smcsramkot.in" className="text-white-50 text-decoration-none">school@smcsramkot.in</a>
                            </div>
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
