import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function Facilities({ facilities = [], facilitiesSection = null, flashNews = [] }) {
    const kicker = facilitiesSection?.kicker || 'Campus Life & Infrastructure';
    const title = facilitiesSection?.title || 'Our Facilities';
    const excerpt = facilitiesSection?.excerpt || '';

    return (
        <AppLayout flashNews={flashNews}>
            <Head title="Facilities — St. Mary's Convent School" />

            <SubpageHero
                title="Facilities"
                breadcrumbs={[{ name: 'Facilities', url: '/facilities' }]}
            />

            <section className="section py-5 bg-white">
                <div className="container py-2">
                    {/* Header */}
                    <div className="row align-items-center mb-5">
                        <div className="col-lg-8">
                            <div className="section-kicker text-uppercase tracking-wider fw-semibold text-warning mb-2">
                                {kicker}
                            </div>
                            <h2 className="section-title fw-bold text-navy mb-2" style={{ fontSize: 'clamp(2rem, 3.2vw, 2.7rem)' }}>
                                {title}
                            </h2>
                            {excerpt && (
                                <p className="text-secondary fs-6 mb-0 mt-2" style={{ lineHeight: '1.7', maxWidth: '750px' }}>
                                    {excerpt}
                                </p>
                            )}
                            <div className="rule mt-3"></div>
                        </div>
                    </div>

                    {/* Facilities Image & Title Grid */}
                    {facilities && facilities.length > 0 ? (
                        <div className="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">
                            {facilities.map((facility, index) => {
                                const cardImg = facility.display_image || facility.feature_image || `/images/facilities/facilities${(index % 4) + 1}.jpg`;
                                return (
                                    <div key={facility.id || index} className="col">
                                        <Link
                                            href={`/facilities/${facility.slug}`}
                                            className="text-decoration-none d-block h-100 text-white"
                                        >
                                            <div
                                                className="facility-card position-relative overflow-hidden rounded-4 shadow-sm h-100"
                                                style={{
                                                    height: '300px',
                                                    backgroundColor: '#102b46',
                                                }}
                                            >
                                                {/* Background Image */}
                                                <img
                                                    src={cardImg}
                                                    alt={facility.title}
                                                    className="w-100 h-100 object-fit-cover facility-card-img"
                                                    style={{
                                                        transition: 'transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1)',
                                                    }}
                                                />

                                                {/* Dark Gradient Overlay with Title */}
                                                <div
                                                    className="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4"
                                                    style={{
                                                        background: 'linear-gradient(to top, rgba(16, 43, 70, 0.95) 0%, rgba(16, 43, 70, 0.45) 55%, transparent 100%)',
                                                    }}
                                                >
                                                    <div className="d-flex align-items-end justify-content-between gap-2">
                                                        <div>
                                                            <span
                                                                className="badge bg-warning text-dark px-2.5 py-1 rounded-pill small fw-semibold text-uppercase mb-2 d-inline-block"
                                                                style={{ fontSize: '0.68rem', letterSpacing: '0.06em' }}
                                                            >
                                                                Facility
                                                            </span>
                                                            <h4
                                                                className="serif text-white mb-0 fw-bold fs-5"
                                                                style={{ textShadow: '0 2px 4px rgba(0,0,0,0.5)', lineHeight: '1.3' }}
                                                            >
                                                                {facility.title}
                                                            </h4>
                                                        </div>
                                                        <div
                                                            className="facility-arrow-btn rounded-circle d-flex align-items-center justify-content-center text-white flex-shrink-0"
                                                            style={{
                                                                width: '42px',
                                                                height: '42px',
                                                                backgroundColor: 'rgba(255, 255, 255, 0.22)',
                                                                backdropFilter: 'blur(6px)',
                                                                transition: 'all 0.3s ease',
                                                            }}
                                                        >
                                                            <i className="fa-solid fa-arrow-right small"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </Link>
                                    </div>
                                );
                            })}
                        </div>
                    ) : (
                        <div className="text-center py-5 bg-white rounded-4 shadow-sm my-3">
                            <i className="fa-solid fa-building-circle-exclamation text-navy mb-3 opacity-50" style={{ fontSize: '56px' }}></i>
                            <h3 className="fw-bold text-navy mb-2">No Facilities Found</h3>
                            <p className="text-muted mb-0">We haven't added any facility records yet. Please check back later.</p>
                        </div>
                    )}
                </div>
            </section>

            <style>{`
                .facility-card:hover .facility-card-img {
                    transform: scale(1.08);
                }
                .facility-card:hover .facility-arrow-btn {
                    background-color: var(--gold, #d4af37) !important;
                    color: #102b46 !important;
                    transform: translateX(4px);
                }
            `}</style>
        </AppLayout>
    );
}
