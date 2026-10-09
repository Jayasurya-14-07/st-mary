import { useEffect } from 'react';

export default function NewsEventsSection({ newsEvents = [] }) {
    const displayNews = newsEvents || [];

    useEffect(() => {
        const newsTrack = document.getElementById('newsTrack');
        if (newsTrack && newsTrack.children.length > 0 && !newsTrack.dataset.duplicated) {
            newsTrack.dataset.duplicated = "true";
            newsTrack.innerHTML += newsTrack.innerHTML;
        }
    }, [displayNews]);

    return (
        <section className="section" id="news">
            <div className="container">
                <div className="row align-items-end mb-5 reveal">
                    <div className="col">
                        <div className="section-kicker">News &amp; Events</div>
                        <h2 className="section-title mb-0">What’s happening.</h2>
                    </div>
                    {displayNews && displayNews.length > 3 && (
                        <div className="col-auto">
                            <a href="/news-events" className="btn btn-outline-premium">View All News &amp; Events</a>
                        </div>
                    )}
                </div>

                {displayNews && displayNews.length > 0 ? (
                    <div className="news-marquee reveal">
                        <div className="news-track" id="newsTrack">
                            {displayNews.map((news, i) => (
                                <div key={i} className="news-card-wrapper">
                                    <article className="news-card">
                                        <div className="news-img position-relative">
                                            <img src={news.feature_image || news.img || '/images/news/news1.jpg'} alt={news.title} />
                                            <span className="news-category-badge">{news.tag_name || news.tag || 'News & Events'}</span>
                                            <span className="news-date-chip">{news.publish_date || '05 OCT'}</span>
                                        </div>
                                        <div className="news-body">
                                            <h4>{news.title}</h4>
                                            <p>{news.excerpt || news.desc}</p>
                                            <a href={news.slug ? `/post/${news.slug}` : '/news-events'} className="fw-bold" style={{ color: 'var(--wine)' }}>
                                                Read More <i className="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            ))}
                        </div>
                    </div>
                ) : (
                    <div className="text-center py-5 reveal">
                        <i className="fa-solid fa-newspaper fs-1 text-muted mb-3 d-block"></i>
                        <h4 className="text-navy fw-bold">No News &amp; Events</h4>
                    </div>
                )}
            </div>
        </section>
    );
}
