import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function Error({ status = 404, flashNews = [] }) {
    const title = status === 404 ? '404 - Page Not Found' : `Error ${status}`;
    const description = status === 404
        ? "The page you are looking for might have been removed, had its name changed, or is temporarily unavailable."
        : "An unexpected error occurred. Please try again later.";

    return (
        <AppLayout flashNews={flashNews}>
            <Head title={`${title} — St. Mary's Convent School`} />

            <SubpageHero 
                title={title} 
                breadcrumbs={[{ name: 'Error', url: '#' }]} 
            />

            <section className="section py-5 bg-light-subtle text-center">
                <div className="container py-4">
                    <div className="row justify-content-center">
                        <div className="col-lg-8 col-md-10">
                            <div className="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                                <div className="mb-4">
                                    <div className="display-1 fw-bold text-navy mb-2" style={{ fontSize: 'clamp(5rem, 10vw, 8rem)', letterSpacing: '-0.03em' }}>
                                        {status}
                                    </div>
                                    <div className="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold text-uppercase tracking-wider mb-3" style={{ fontSize: '0.85rem' }}>
                                        <i className="fa-solid fa-triangle-exclamation me-2"></i> Page Not Found
                                    </div>
                                    <h2 className="section-title text-navy fs-2 fw-bold mb-3">
                                        Oops! We couldn't find that page.
                                    </h2>
                                    <p className="text-muted fs-6 mb-4 mx-auto" style={{ maxWidth: '560px', lineHeight: '1.7' }}>
                                        {description}
                                    </p>
                                </div>

                                <div className="d-flex flex-wrap justify-content-center gap-3 mb-5">
                                    <Link href="/" className="btn btn-premium px-4 py-3 rounded-pill fw-bold">
                                        <i className="fa-solid fa-house me-2"></i> Back to Homepage
                                    </Link>
                                    <Link href="/contact" className="btn btn-outline-premium px-4 py-3 rounded-pill fw-bold">
                                        <i className="fa-solid fa-headset me-2"></i> Contact Helpline
                                    </Link>
                                </div>

                                <div className="border-top pt-4 text-start">
                                    <h6 className="fw-bold text-navy mb-3 text-uppercase tracking-wider" style={{ fontSize: '0.8rem' }}>
                                        Useful Links
                                    </h6>
                                    <div className="row g-2">
                                        <div className="col-6 col-md-3">
                                            <Link href="/" className="text-navy text-decoration-none small hover-gold d-block py-1">
                                                <i className="fa-solid fa-chevron-right me-2 fs-6 text-warning"></i>Home
                                            </Link>
                                        </div>
                                        <div className="col-6 col-md-3">
                                            <Link href="/facilities" className="text-navy text-decoration-none small hover-gold d-block py-1">
                                                <i className="fa-solid fa-chevron-right me-2 fs-6 text-warning"></i>Facilities
                                            </Link>
                                        </div>
                                        <div className="col-6 col-md-3">
                                            <Link href="/news-events" className="text-navy text-decoration-none small hover-gold d-block py-1">
                                                <i className="fa-solid fa-chevron-right me-2 fs-6 text-warning"></i>News & Events
                                            </Link>
                                        </div>
                                        <div className="col-6 col-md-3">
                                            <Link href="/gallery" className="text-navy text-decoration-none small hover-gold d-block py-1">
                                                <i className="fa-solid fa-chevron-right me-2 fs-6 text-warning"></i>Gallery
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </AppLayout>
    );
}
