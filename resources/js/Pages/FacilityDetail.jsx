import { useState, useEffect, useCallback } from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';
import BlockRenderer from '../Components/BlockRenderer';

export default function FacilityDetail({ facility = null, allFacilities = [], flashNews = [] }) {
    const [lightboxImage, setLightboxImage] = useState(null);

    const handleCloseLightbox = useCallback(() => {
        setLightboxImage(null);
    }, []);

    useEffect(() => {
        const handleKeyDown = (e) => {
            if (e.key === 'Escape') {
                handleCloseLightbox();
            }
        };

        if (lightboxImage) {
            window.addEventListener('keydown', handleKeyDown);
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }

        return () => {
            window.removeEventListener('keydown', handleKeyDown);
            document.body.style.overflow = '';
        };
    }, [lightboxImage, handleCloseLightbox]);

    // Delegated click handler to detect clicks on any image inside the content
    const handleContentImageClick = (e) => {
        let target = e.target;
        if (target.tagName !== 'IMG') {
            target = target.closest('img') || (target.closest('a') && target.closest('a').querySelector('img'));
        }

        if (target && target.tagName === 'IMG' && target.src) {
            e.preventDefault();
            e.stopPropagation();
            setLightboxImage({
                src: target.src,
                alt: target.alt || target.title || facility?.title || 'Facility Image',
            });
        }
    };

    if (!facility) {
        return (
            <AppLayout flashNews={flashNews}>
                <Head title="Facility Not Found — St. Mary's Convent School" />
                <SubpageHero title="Facility Not Found" breadcrumbs={[{ name: 'Facilities', url: '/facilities' }]} />
                <div className="container py-5 text-center my-5">
                    <i className="fa-solid fa-building-circle-exclamation text-navy mb-3 opacity-50" style={{ fontSize: '56px' }}></i>
                    <h3 className="fw-bold text-navy mb-2">Facility Not Found</h3>
                    <p className="text-muted mb-4">The facility you are looking for could not be found or is currently unavailable.</p>
                    <Link href="/facilities" className="btn btn-premium px-4 py-2">
                        <i className="fa-solid fa-arrow-left me-2"></i> View All Facilities
                    </Link>
                </div>
            </AppLayout>
        );
    }

    const isArrayContent = Array.isArray(facility.content);

    return (
        <AppLayout flashNews={flashNews}>
            <Head title={`${facility.title} — Facilities — St. Mary's Convent School`} />

            <SubpageHero
                title={facility.title}
                breadcrumbs={[
                    { name: 'Facilities', url: '/facilities' },
                    { name: facility.title }
                ]}
            />

            <section className="section py-5 bg-light-subtle">
                <div className="container py-2">
                    <div className="row g-4 g-lg-5">
                        {/* Main Facility Content Column */}
                        <div className="col-lg-8">
                            <div className="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 p-md-5">
                                {/* Title & Badge */}
                                <div className="d-flex align-items-center gap-2 mb-3">
                                    <span
                                        className="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2 fw-semibold text-uppercase"
                                        style={{ letterSpacing: '0.05em', fontSize: '0.75rem' }}
                                    >
                                        Facility
                                    </span>
                                </div>

                                <h2 className="display-6 fw-bold text-navy mb-4">
                                    {facility.title}
                                </h2>

                                {/* Feature Image (if present, click opens popup) */}
                                {facility.feature_image && (
                                    <div
                                        className="mb-4 rounded-4 overflow-hidden shadow-sm position-relative facility-image-wrapper"
                                        style={{ maxHeight: '450px', cursor: 'pointer' }}
                                        onClick={() => setLightboxImage({ src: facility.feature_image, alt: facility.title })}
                                    >
                                        <img
                                            src={facility.feature_image}
                                            alt={facility.title}
                                            className="w-100 h-100 object-fit-cover rounded-4 transition-all"
                                        />
                                        <div
                                            className="position-absolute bottom-0 end-0 m-3 px-3 py-1.5 rounded-pill text-white small d-flex align-items-center gap-1 shadow-sm"
                                            style={{ backgroundColor: 'rgba(16, 43, 70, 0.85)', backdropFilter: 'blur(4px)' }}
                                        >
                                            <i className="fa-solid fa-magnifying-glass-plus"></i> Click to enlarge
                                        </div>
                                    </div>
                                )}

                                {/* Detailed Content Only (Excerpt is omitted per user request) */}
                                <div
                                    className="facility-body mb-4"
                                    onClick={handleContentImageClick}
                                >
                                    {isArrayContent && facility.content.length > 0 ? (
                                        <BlockRenderer blocks={facility.content} />
                                    ) : facility.content && typeof facility.content === 'string' ? (
                                        <div
                                            className="content-text tiptap-content text-dark fs-6"
                                            style={{ lineHeight: '1.8' }}
                                            dangerouslySetInnerHTML={{ __html: facility.content }}
                                        />
                                    ) : (
                                        <p className="text-muted">No details have been added for this facility yet.</p>
                                    )}
                                </div>

                                {/* Bottom Navigation */}
                                <div className="pt-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3">
                                    <Link href="/facilities" className="btn btn-outline-premium">
                                        <i className="fa-solid fa-arrow-left me-2"></i> All Facilities
                                    </Link>
                                    <Link href="/admission" className="btn btn-premium">
                                        Admission Enquiry <i className="fa-solid fa-arrow-right ms-2"></i>
                                    </Link>
                                </div>
                            </div>
                        </div>

                        {/* Sidebar: All Facilities List & Quick Info */}
                        <div className="col-lg-4">
                            <div className="position-sticky" style={{ top: '100px' }}>
                                {/* Facilities Quick Navigation */}
                                {allFacilities && allFacilities.length > 0 && (
                                    <div className="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 mb-4">
                                        <h5 className="fw-bold text-navy mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                                            <i className="fa-solid fa-building-columns text-warning"></i>
                                            <span>Our Facilities</span>
                                        </h5>
                                        <div className="list-group list-group-flush">
                                            {allFacilities.map((item) => {
                                                const isActive = item.slug === facility.slug;
                                                return (
                                                    <Link
                                                        key={item.id}
                                                        href={`/facilities/${item.slug}`}
                                                        className={`list-group-item list-group-item-action border-0 px-3 py-2 rounded-3 mb-1 d-flex justify-content-between align-items-center transition-all ${isActive
                                                            ? 'text-white fw-bold shadow-sm'
                                                            : 'text-dark'
                                                            }`}
                                                        style={
                                                            isActive
                                                                ? { backgroundColor: '#102b46', borderColor: '#102b46' }
                                                                : {}
                                                        }
                                                    >
                                                        <span>{item.title}</span>
                                                        <i
                                                            className={`fa-solid fa-chevron-right small ${isActive ? 'text-white' : 'text-muted opacity-50'
                                                                }`}
                                                        ></i>
                                                    </Link>
                                                );
                                            })}
                                        </div>
                                    </div>
                                )}

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Lightbox / Popup Modal for all facility images */}
            {lightboxImage && (
                <div
                    className="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center p-3"
                    style={{
                        backgroundColor: 'rgba(7, 19, 31, 0.95)',
                        backdropFilter: 'blur(8px)',
                        zIndex: 99999,
                    }}
                    onClick={handleCloseLightbox}
                >
                    {/* Close Button */}
                    <button
                        type="button"
                        className="btn btn-link text-white position-absolute top-0 end-0 m-3 m-md-4 fs-2 text-decoration-none shadow-none z-3"
                        onClick={handleCloseLightbox}
                        aria-label="Close image popup"
                        style={{ opacity: 0.85 }}
                    >
                        <i className="fa-solid fa-xmark"></i>
                    </button>

                    {/* Image Container */}
                    <div
                        className="position-relative text-center d-flex flex-column align-items-center justify-content-center"
                        style={{ maxWidth: '92vw', maxHeight: '92vh' }}
                        onClick={(e) => e.stopPropagation()}
                    >
                        <img
                            src={lightboxImage.src}
                            alt={lightboxImage.alt || 'Facility Preview'}
                            className="img-fluid rounded-4 shadow-lg"
                            style={{
                                maxHeight: '82vh',
                                maxWidth: '90vw',
                                objectFit: 'contain',
                                background: '#07131f',
                            }}
                        />
                        {lightboxImage.alt && (
                            <div className="mt-3 text-white-50 small text-center px-3">
                                {lightboxImage.alt}
                            </div>
                        )}
                    </div>
                </div>
            )}

            <style>{`
                .facility-body img {
                    cursor: pointer !important;
                    transition: transform 0.25s ease, box-shadow 0.25s ease;
                    border-radius: 8px;
                }
                .facility-body img:hover {
                    transform: scale(1.02);
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.16);
                }
                .facility-image-wrapper:hover img {
                    transform: scale(1.02);
                }
            `}</style>
        </AppLayout>
    );
}
