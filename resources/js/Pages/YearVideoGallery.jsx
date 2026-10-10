import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function YearVideoGallery({ yearLabel = '', yearKey = '', videos = { data: [], links: [] }, flashNews = [] }) {
    const videoList = videos.data || [];

    return (
        <AppLayout flashNews={flashNews}>
            <Head title={`${yearLabel} — Video Gallery — St. Mary's Convent School`} />

            <SubpageHero 
                title={yearLabel} 
                breadcrumbs={[
                    { name: 'Video Gallery', url: '/video-gallery' },
                    { name: yearLabel, url: `/video-gallery/year/${yearKey}` }
                ]} 
            />

            <section className="py-5 bg-white">
                <div className="container py-3">
                    {/* Header bar with Back button */}
                    <div className="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h2 className="section-title text-navy fs-3 mb-0">{yearLabel}</h2>
                            <p className="text-muted small mb-0">Browse videos from the {yearLabel} academic session</p>
                        </div>
                        <Link href="/video-gallery" className="btn btn-outline-navy btn-sm px-3 rounded-pill">
                            <i className="fa-solid fa-arrow-left me-2"></i> All Academic Years
                        </Link>
                    </div>

                    {videoList.length > 0 ? (
                        <>
                            {/* 4-column Video Grid */}
                            <div className="row g-4 mb-5">
                                {videoList.map((video, index) => (
                                    <div key={video.id || index} className="col-lg-3 col-md-6">
                                        <div className="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                                            {video.embedUrl ? (
                                                <div className="ratio ratio-16x9 rounded-top-4 overflow-hidden bg-dark">
                                                    <iframe
                                                        src={video.embedUrl}
                                                        title={video.title}
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowFullScreen
                                                        style={{ border: 0 }}
                                                    ></iframe>
                                                </div>
                                            ) : video.thumbnail ? (
                                                <div className="ratio ratio-16x9 rounded-top-4 overflow-hidden bg-dark position-relative">
                                                    <img 
                                                        src={video.thumbnail} 
                                                        alt={video.title} 
                                                        className="w-100 h-100 object-fit-cover"
                                                    />
                                                </div>
                                            ) : (
                                                <div className="ratio ratio-16x9 rounded-top-4 overflow-hidden position-relative d-flex align-items-center justify-content-center"
                                                    style={{ background: 'linear-gradient(145deg, #102b46, #173d5f)' }}>
                                                    <i className="fa-brands fa-youtube text-danger display-5"></i>
                                                </div>
                                            )}
                                            <div className="card-body p-3 d-flex flex-column justify-content-between">
                                                <h5 className="card-title text-dark fw-bold line-clamp-2 mb-2" style={{ fontSize: '0.92rem', lineHeight: '1.4' }}>
                                                    {video.title}
                                                </h5>
                                                {video.publish_date && (
                                                    <small className="text-muted" style={{ fontSize: '0.78rem' }}>
                                                        <i className="fa-regular fa-calendar me-1"></i> {video.publish_date}
                                                    </small>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>

                            {/* Pagination Links */}
                            {videos.links && videos.links.length > 3 && (
                                <nav className="d-flex justify-content-center mt-4" aria-label="Page navigation">
                                    <ul className="pagination pagination-md gap-1">
                                        {videos.links.map((link, idx) => {
                                            const cleanLabel = link.label
                                                .replace('&laquo; Previous', '‹ Prev')
                                                .replace('Next &raquo;', 'Next ›');

                                            return (
                                                <li 
                                                    key={idx} 
                                                    className={`page-item ${link.active ? 'active' : ''} ${!link.url ? 'disabled' : ''}`}
                                                >
                                                    {link.url ? (
                                                        <Link 
                                                            href={link.url} 
                                                            className={`page-link rounded-3 px-3 py-2 ${link.active ? 'bg-navy border-navy text-white' : 'text-navy'}`}
                                                            dangerouslySetInnerHTML={{ __html: cleanLabel }}
                                                        />
                                                    ) : (
                                                        <span 
                                                            className="page-link rounded-3 px-3 py-2 text-muted opacity-50"
                                                            dangerouslySetInnerHTML={{ __html: cleanLabel }}
                                                        />
                                                    )}
                                                </li>
                                            );
                                        })}
                                    </ul>
                                </nav>
                            )}
                        </>
                    ) : (
                        <div className="text-center py-5 my-4">
                            <i className="fa-solid fa-video-slash text-muted mb-3" style={{ fontSize: '64px' }}></i>
                            <h4 className="fw-bold text-navy">No Videos Found for {yearLabel}</h4>
                            <p className="text-muted">There are no videos published under this academic year yet.</p>
                            <Link href="/video-gallery" className="btn btn-navy px-4 rounded-pill mt-2">
                                Back to All Academic Years
                            </Link>
                        </div>
                    )}
                </div>
            </section>
        </AppLayout>
    );
}
