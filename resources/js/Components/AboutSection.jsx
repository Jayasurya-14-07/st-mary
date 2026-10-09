export default function AboutSection({ aboutus = null }) {
    const imageUrl = aboutus?.feature_image
        ? (aboutus.feature_image.startsWith('http') || aboutus.feature_image.startsWith('/')
            ? aboutus.feature_image
            : `/storage/${aboutus.feature_image}`)
        : '/images/about.jpg';

    const readMoreLink = aboutus?.link_url || (aboutus?.slug ? `/${aboutus.slug}` : '#');
    const rawExcerpt = aboutus?.excerpt || aboutus?.description || '';
    const cleanExcerpt = typeof rawExcerpt === 'string' ? rawExcerpt.replace(/<[^>]*>?/gm, '').trim() : '';

    return (
        <section className="section section-soft" id="story">
            <div className="container">
                <div className="row g-5 align-items-center">
                    <div className="col-lg-6 reveal">
                        <div className="image-card">
                            <img src={imageUrl} alt={aboutus?.title || "St. Mary's Convent School, Chhallan, Ramkot building"} />
                        </div>
                    </div>
                    <div className="col-lg-6 reveal">
                        <h2 className="section-title">About Us</h2>
                        <div style={{ color: 'var(--navy)' }}>Unit of Diocese of Jammu-Srinagar Education Society (DJSES)</div>
                        <div className="rule"></div>
                        <p className="section-copy">
                            {cleanExcerpt ? (
                                cleanExcerpt
                            ) : (
                                <>
                                    St. Mary’s Convent School, Chhallan, Ramkot, is an English-medium, co-educational secondary school, affiliated to the Jammu and Kashmir Board of School Education (JKBOSE). The school was established in 2002 by the Catholic Education Society of the Jammu–Srinagar Diocese.
                                </>
                            )}
                        </p>
                        {readMoreLink && readMoreLink !== '#' && (
                            <a href={readMoreLink} className="btn-gallery-view mt-3 d-inline-block">
                                Read More <i className="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        )}
                    </div>
                </div>
            </div>
        </section>
    );
}
