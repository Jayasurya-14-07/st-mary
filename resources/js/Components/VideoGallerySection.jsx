import { Link } from '@inertiajs/react';

export default function VideoGallerySection({ videos = [] }) {
    const hasVideos = videos && videos.length > 0;

    return (
        <section className="section section-soft" id="video-gallery">
            <div className="container">
                <div className="row align-items-center mb-5 reveal">
                    <div className="col-lg-7">
                        <div className="section-kicker">Campus Highlights &amp; Events</div>
                        <h2 className="section-title mb-0">Video Gallery</h2>
                        <div className="rule mt-3"></div>
                    </div>
                </div>

                {hasVideos ? (
                    <>
                        {/* Dynamic Videos Grid (up to 8 videos) */}
                        <div className="row g-4 mb-4 reveal">
                            {videos.slice(0, 8).map((video, index) => {
                                const videoId = video.videoId || video.id?.videoId || (typeof video.id === 'string' ? video.id : null);
                                const embedUrl = video.embedUrl || (videoId ? `https://www.youtube.com/embed/${videoId}` : null);

                                return (
                                    <div key={video.id || index} className="col-lg-3 col-md-6">
                                        {embedUrl ? (
                                            <div className="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm border bg-dark">
                                                <iframe
                                                    src={embedUrl}
                                                    title={video.title}
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowFullScreen
                                                    style={{ border: 0 }}
                                                ></iframe>
                                            </div>
                                        ) : video.thumbnail ? (
                                            <Link
                                                href="/video-gallery"
                                                className="d-block text-decoration-none"
                                            >
                                                <div className="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm border bg-dark position-relative">
                                                    <img 
                                                        src={video.thumbnail} 
                                                        alt={video.title} 
                                                        className="w-100 h-100 object-fit-cover"
                                                    />
                                                </div>
                                            </Link>
                                        ) : (
                                            <Link
                                                href="/video-gallery"
                                                className="d-block text-decoration-none"
                                            >
                                                <div className="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm border position-relative d-flex align-items-center justify-content-center"
                                                    style={{ background: 'linear-gradient(145deg, #102b46, #173d5f)' }}>
                                                    <div className="position-absolute text-center text-white p-3">
                                                        <i className="fa-brands fa-youtube text-danger display-5 mb-2 d-block"></i>
                                                        <span className="badge bg-danger px-3 py-2 rounded-pill fw-semibold">Watch Video</span>
                                                    </div>
                                                </div>
                                            </Link>
                                        )}
                                        <h5 className="mt-2 text-center text-dark fw-bold line-clamp-2" style={{ fontSize: '0.92rem', lineHeight: '1.4' }}>
                                            {video.title}
                                        </h5>
                                    </div>
                                );
                            })}
                        </div>

                        <div className="text-center mt-3">
                            <Link href="/video-gallery" className="btn btn-premium px-4">
                                View All <i className="fa-solid fa-arrow-right ms-2"></i>
                            </Link>
                        </div>
                    </>
                ) : (
                    <div className="text-center py-5 my-3 reveal">
                        <i className="fa-brands fa-youtube text-muted mb-3" style={{ fontSize: '56px' }}></i>
                        <h4 className="fw-bold text-navy mb-2">No videos in the gallery</h4>
                        <p className="text-muted small mb-0">Check back soon for campus highlights and video coverage.</p>
                    </div>
                )}
            </div>
        </section>
    );
}
