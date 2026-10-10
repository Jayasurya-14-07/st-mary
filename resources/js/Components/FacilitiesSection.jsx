import { Link } from '@inertiajs/react';

export default function FacilitiesSection({ facilitiesSection = null, facilites = null }) {
    const data = facilitiesSection || facilites || {};

    const kicker = data.kicker || 'Facilities';
    const title = data.title || 'Facilities for Learning and Growth.';
    const excerpt = data.excerpt || 'St. Mary’s Convent School provides a safe, welcoming, and child-friendly learning environment with facilities that support the academic, physical, creative, and overall development of our students.';
    
    const defaultImages = [
        '/images/facilities/facilities1.jpg',
        '/images/facilities/facilities2.jpg',
        '/images/facilities/facilities3.jpg',
        '/images/facilities/facilities4.jpg',
    ];

    const images = (Array.isArray(data.images) && data.images.length >= 4) ? data.images : defaultImages;

    return (
        <section className="section section-soft py-4" id="facilities">
            <div className="container py-1">
                <div className="row g-4 align-items-center">
                    <div className="col-lg-5 reveal">
                        <div className="section-kicker mb-2 text-uppercase tracking-wider fw-semibold text-warning">{kicker}</div>
                        <h2 className="section-title fw-bold text-navy mb-3" style={{ fontSize: 'clamp(2.4rem, 3.8vw, 3.3rem)', lineHeight: '1.18', letterSpacing: '-0.02em' }}>
                            {title}
                        </h2>
                        {excerpt && (
                            <p className="text-secondary mb-4 fs-6" style={{ lineHeight: '1.7', color: '#4a5568' }}>
                                {excerpt}
                            </p>
                        )}
                        <Link href="/facilities" className="btn btn-outline-premium px-4 py-2">
                            Read More <i className="fa-solid fa-arrow-right ms-2"></i>
                        </Link>
                    </div>
                    <div className="col-lg-7 reveal">
                        <div className="row g-3">
                            <div className="col-7">
                                <div className="image-card rounded-4 overflow-hidden shadow-sm" style={{ height: '280px' }}>
                                    <img src={images[0] || defaultImages[0]} alt="Facility highlight 1" className="w-100 h-100 object-fit-cover" />
                                </div>
                            </div>
                            <div className="col-5">
                                <div className="image-card rounded-4 overflow-hidden shadow-sm" style={{ height: '280px' }}>
                                    <img src={images[1] || defaultImages[1]} alt="Facility highlight 2" className="w-100 h-100 object-fit-cover" />
                                </div>
                            </div>
                            <div className="col-5">
                                <div className="image-card rounded-4 overflow-hidden shadow-sm" style={{ height: '210px' }}>
                                    <img src={images[2] || defaultImages[2]} alt="Facility highlight 3" className="w-100 h-100 object-fit-cover" />
                                </div>
                            </div>
                            <div className="col-7">
                                <div className="image-card rounded-4 overflow-hidden shadow-sm" style={{ height: '210px' }}>
                                    <img src={images[3] || defaultImages[3]} alt="Facility highlight 4" className="w-100 h-100 object-fit-cover" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
