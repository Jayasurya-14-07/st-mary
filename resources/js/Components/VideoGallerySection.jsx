export default function VideoGallerySection({ videos = [] }) {
    const defaultTitles = [
        "Teachers' Day Celebration",
        "80th Independence Day Celebration",
        "Eco Inventions & Green Intentions Exhibition",
        "Math Club Inauguration",
        "Inauguration of Sports Club",
        "Inter-House Cricket Tournament",
        "Essay Writing Competition",
        "Rakhi Making Competition",
    ];

    const displayVideos = Array.from({ length: 8 }, (_, i) => {
        const v = videos[i];
        if (v) {
            const videoId = v.id?.videoId || (typeof v.id === 'string' ? v.id : null);
            return {
                title: v.snippet?.title || defaultTitles[i],
                videoId: videoId,
                embedUrl: videoId ? `https://www.youtube.com/embed/${videoId}` : null
            };
        }
        return {
            title: defaultTitles[i],
            videoId: null,
            embedUrl: null
        };
    });

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

                {/* 8 Videos Grid (2 rows x 4 columns) */}
                <div className="row g-4 mb-4 reveal">
                    {displayVideos.map((video, index) => (
                        <div key={index} className="col-lg-3 col-md-6">
                            {video.embedUrl ? (
                                <div className="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm border bg-dark">
                                    <iframe
                                        src={video.embedUrl}
                                        title={video.title}
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowFullScreen
                                        style={{ border: 0 }}
                                    ></iframe>
                                </div>
                            ) : (
                                <a
                                    href="https://www.youtube.com/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="d-block text-decoration-none"
                                >
                                    <div className="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm border position-relative d-flex align-items-center justify-content-center"
                                         style={{ background: 'linear-gradient(145deg, #102b46, #173d5f)' }}>
                                        <div className="position-absolute text-center text-white p-3">
                                            <i className="fa-brands fa-youtube text-danger display-5 mb-2 d-block"></i>
                                            <span className="badge bg-danger px-3 py-2 rounded-pill fw-semibold">Watch Video</span>
                                        </div>
                                    </div>
                                </a>
                            )}
                            <h6 className="mt-2 text-center text-dark fw-bold" style={{ fontSize: '0.88rem', lineHeight: '1.4' }}>
                                {video.title}
                            </h6>
                        </div>
                    ))}
                </div>

                <div className="text-center mt-3">
                    <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" className="btn btn-premium px-4">
                        View All <i className="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </section>
    );
}
