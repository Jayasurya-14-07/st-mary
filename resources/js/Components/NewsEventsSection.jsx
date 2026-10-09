import { useEffect } from 'react';

export default function NewsEventsSection() {
    useEffect(() => {
        const newsTrack = document.getElementById('newsTrack');
        if (newsTrack && newsTrack.children.length > 0 && !newsTrack.dataset.duplicated) {
            newsTrack.dataset.duplicated = "true";
            newsTrack.innerHTML += newsTrack.innerHTML;
        }
    }, []);

    const defaultNews = [
        {
            img: '/images/news/news2.jpg',
            tag: 'Academic Session · April 2026',
            title: 'New Academic Year 2026–27',
            desc: 'St. Mary’s Convent School, Chhallan, Ramkot, welcomed students to the new academic year 2026–27 on 3 April 2026 with renewed enthusiasm, hope, and a commitment to learning, growth, and excellence.'
        },
        {
            img: '/images/news/news5.jpg',
            tag: 'Leadership · Student Council',
            title: 'Investiture Ceremony – Young Leaders Take Charge',
            desc: 'Senior Head Boy: Utkarsh Singh | Senior Head Girl: Rimsha Verma | Junior Head Boy: Dhroov Sharma | Junior Head Girl: Tejas Mahajan. Pledged to uphold discipline, integrity, and service.'
        },
        {
            img: '/images/gallery/gallery3.jpg',
            tag: 'Clubs & Co-Curricular',
            title: 'Clubs Inaugurated – Learning Beyond the Classroom',
            desc: 'Inaugurated a vibrant range of student clubs (Art, Eco, EVS & Science, Heritage, Language, Math, Sports, Value Education) to encourage creativity, curiosity, and leadership.'
        },
        {
            img: '/images/news/news7.jpg',
            tag: 'Special Observation · May 2026',
            title: 'Labour Day Observed with Gratitude & Respect',
            desc: 'Labour Day was observed with gratitude and appreciation for the dignity of work. Students were encouraged to recognise and respect the valuable contribution of every worker in society.'
        },
        {
            img: '/images/news/news6.jpg',
            tag: 'National Celebration · August 2026',
            title: 'Independence Day Celebrated with Patriotic Fervor',
            desc: 'Celebrated Independence Day with patriotic fervor through special assemblies, cultural programmes, patriotic songs, and activities inspiring love for the nation.'
        },
        {
            img: '/images/news/news5.jpg',
            tag: 'Exhibition · Student Talent',
            title: 'Independence Day Creative Exhibition',
            desc: 'Students presented a creative exhibition showcasing their artistic talents, ideas, and patriotic spirit, providing a platform to learn, create, and express.'
        },
        {
            img: '/images/news/news7.jpg',
            tag: 'Achievement · Cultural Item',
            title: 'First Prize in Inter-School Cultural Competition',
            desc: 'Our students brought laurels to the school at GHSS Ramkot, securing First Prize in the Cultural Item with outstanding creativity, confidence, and teamwork.'
        },
        {
            img: '/images/news/news8.jpg',
            tag: 'Achievement · Sports & Discipline',
            title: 'Second Prize in March Past Competition',
            desc: 'Our students secured Second Prize in March Past, demonstrating excellent discipline, coordination, teamwork, and school spirit. Congratulations to all!'
        },
        {
            img: '/images/news/news9.jpg',
            tag: 'Session Overview · 2026–27',
            title: 'A Year of Learning, Leadership & Achievement',
            desc: 'The academic year 2026–27 has begun with enthusiasm and purpose. Through learning, leadership, creativity, sports, and service, our students continue to discover their potential.'
        }
    ];

    return (
        <section className="section" id="news">
            <div className="container">
                <div className="row align-items-end mb-5 reveal">
                    <div className="col">
                        <div className="section-kicker">News &amp; Events</div>
                        <h2 className="section-title mb-0">What’s happening.</h2>
                    </div>
                    <div className="col-auto">
                        <a href="#news" className="btn btn-outline-premium">View all updates</a>
                    </div>
                </div>

                <div className="news-marquee reveal">
                    <div className="news-track" id="newsTrack">
                        {defaultNews.map((news, i) => (
                            <div key={i} className="news-card-wrapper">
                                <article className="news-card">
                                    <div className="news-img"><img src={news.img} alt={news.title} /></div>
                                    <div className="news-body">
                                        <div className="news-tag">{news.tag}</div>
                                        <h4>{news.title}</h4>
                                        <p>{news.desc}</p>
                                        <a href="#news" className="fw-bold" style={{ color: 'var(--wine)' }}>Read more <i className="fa-solid fa-arrow-right ms-1"></i></a>
                                    </div>
                                </article>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
}
