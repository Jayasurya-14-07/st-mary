import { useMemo } from 'react';
import { Link } from '@inertiajs/react';

export default function NewsEventsSection({ newsEvents = [] }) {
    // Only latest 10 items
    const displayNews = useMemo(() => {
        return (newsEvents || []).slice(0, 10);
    }, [newsEvents]);

    // For seamless infinite loop with CSS @keyframes news-scroll (which shifts -50% - 12px),
    // duplicate items in pure React without manipulating innerHTML directly
    const marqueeCards = useMemo(() => {
        if (!displayNews || displayNews.length === 0) return [];
        let baseList = [...displayNews];
        while (baseList.length < 4) {
            baseList = [...baseList, ...displayNews];
        }
        return [...baseList, ...baseList];
    }, [displayNews]);

    return (
        <section className="section" id="news">
            <div className="container">
                <div className="row align-items-end mb-5 reveal">
                    <div className="col">
                        <div className="section-kicker">News &amp; Events</div>
                        <h2 className="section-title mb-0">What’s happening.</h2>
                    </div>
                    {displayNews && displayNews.length > 0 && (
                        <div className="col-auto">
                            <Link href="/news-events" className="btn btn-outline-premium">View All News &amp; Events</Link>
                        </div>
                    )}
                </div>

                {displayNews && displayNews.length > 0 ? (
                    <div className="news-marquee reveal">
                        <div className="news-track" id="newsTrack">
                            {marqueeCards.map((news, i) => (
                                <div key={`${news.id || i}-${i}`} className="news-card-wrapper">
                                    <article className="news-card">
                                        <div className="news-img position-relative">
                                            <img src={news.feature_image || news.img || '/images/news/news1.jpg'} alt={news.title} />
                                            <span className="news-category-badge">{news.tag_name || news.tag || 'News & Events'}</span>
                                            <span className="news-date-chip">{news.publish_date || '05 OCT'}</span>
                                        </div>
                                        <div className="news-body">
                                            <h4>{news.title}</h4>
                                            <p>{news.excerpt || news.desc}</p>
                                            <Link href={news.slug ? `/post/${news.slug}` : '/news-events'} className="fw-bold" style={{ color: 'var(--wine)' }}>
                                                Read More <i className="fa-solid fa-arrow-right ms-1"></i>
                                            </Link>
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
