import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function VideoGallery({ academicYearVideos = [], flashNews = [] }) {
    return (
        <AppLayout flashNews={flashNews}>
            <Head title="Video Gallery — St. Mary's Convent School" />

            <SubpageHero 
                title="Video Gallery" 
                breadcrumbs={[{ name: 'Video Gallery', url: '/video-gallery' }]} 
            />

            <section className="py-5 bg-white">
                <div className="container py-3">
                    {academicYearVideos && academicYearVideos.length > 0 ? (
                        <div className="row g-4">
                            {academicYearVideos.map((yearGroup, index) => (
                                <div key={yearGroup.year_key || index} className="col-lg-4 col-md-6">
                                    <Link href={`/video-gallery/year/${yearGroup.year_key}`} className="text-decoration-none">
                                        <div className="card h-100 border-0 shadow-sm rounded-4 overflow-hidden gallery-album-card transition-all">
                                            <div className="position-relative overflow-hidden d-flex align-items-center justify-content-center" style={{ height: '240px', background: 'linear-gradient(145deg, #0d1b2a, #1b263b)' }}>
                                                {yearGroup.cover_url ? (
                                                    <img 
                                                        src={yearGroup.cover_url} 
                                                        alt={yearGroup.year_label} 
                                                        className="w-100 h-100 object-fit-cover transition-transform"
                                                    />
                                                ) : (
                                                    <div className="text-center text-white p-3">
                                                        <i className="fa-brands fa-youtube text-danger display-3 mb-2 d-block"></i>
                                                    </div>
                                                )}

                                                <div className="position-absolute top-0 end-0 m-3">
                                                    <span className="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm fs-6">
                                                        <i className="fa-solid fa-circle-play me-1"></i> {yearGroup.video_count || 0} Videos
                                                    </span>
                                                </div>

                                                <div className="position-absolute bottom-0 start-0 end-0 p-3 bg-dark bg-opacity-50 backdrop-blur text-white d-flex align-items-center justify-content-between">
                                                    <span className="fw-bold fs-5 serif">{yearGroup.year_label}</span>
                                                    <i className="fa-solid fa-arrow-right"></i>
                                                </div>
                                            </div>
                                            <div className="card-body p-4 text-center">
                                                <h5 className="card-title text-navy fw-bold mb-1">{yearGroup.year_label}</h5>
                                                <p className="card-text text-muted small mb-0">
                                                    Click to view all {yearGroup.video_count || 0} videos for this academic session.
                                                </p>
                                            </div>
                                        </div>
                                    </Link>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div className="text-center py-5 my-4">
                            <i className="fa-brands fa-youtube text-muted mb-3" style={{ fontSize: '64px' }}></i>
                            <h3 className="fw-bold text-navy">No videos in the gallery</h3>
                            <p className="text-muted">We haven't uploaded any video galleries yet. Please check back later.</p>
                        </div>
                    )}
                </div>
            </section>
        </AppLayout>
    );
}
