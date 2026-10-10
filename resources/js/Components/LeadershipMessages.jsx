import { useState, useMemo } from 'react';
import { Link } from '@inertiajs/react';

export default function LeadershipMessages({ leadershipMessages = [] }) {
    const defaultMessages = [
        {
            id: 'principal',
            slug: 'principal-message',
            position: 'Principal',
            name: 'Sr. Joy Maria DM',
            icon: 'fa-user-tie',
            feature_image: '/images/principal.jpg',
            subtext: 'St. Mary’s Convent School, Chhallan Ramkot',
            excerpt: '<p className="message-text">“Education is not merely the acquisition of knowledge; it is the formation of character, the awakening of potential, and the preparation for a meaningful life.”</p><p className="message-text">It gives me immense joy to welcome you to the official website of St. Mary’s Convent School, Chhallan Ramkot.</p><p className="message-text">Established in 2002, our school has grown with a clear vision of providing quality education rooted in values, discipline, compassion, and excellence. Over the years, St. Mary’s has become not merely a place of learning, but a nurturing home where young minds are guided to discover their talents, develop their confidence, and grow into responsible and caring individuals.</p>',
        },
        {
            id: 'management',
            slug: 'management-message',
            position: 'Management',
            name: 'Management Message',
            icon: 'fa-building-columns',
            feature_image: '/images/logo.png',
            subtext: 'Diocese of Jammu-Srinagar Education Society (DJSES)',
            excerpt: '<p className="message-text">“Our goal is to nurture intellectual curiosity, moral integrity, and leadership qualities in our students, preparing them to be compassionate global citizens.”</p><p className="message-text">The Management of St. Mary’s Convent School remains committed to upholding holistic education that balances academic vigor with strong moral values, discipline, and community service.</p><p className="message-text">Under the auspices of the Diocese of Jammu-Srinagar Education Society (DJSES), we continue to modernize facilities and foster an environment where every child feels valued, inspired, and empowered to excel.</p>',
        },
        {
            id: 'headboy',
            slug: 'head-boy-message',
            position: 'Head Boy',
            name: 'Utkarsh Singh',
            icon: 'fa-user-graduate',
            feature_image: '/images/head-boy.jpg',
            subtext: 'Student Leadership Council',
            excerpt: '<p className="message-text">My journey at St. Mary’s Convent School began in Nursery, when I was a quiet and hesitant little child, taking my first steps into the world of learning. Little did I know that this school would become so much more than a place of education. It would become a second home—a place where I would discover my strengths, overcome my fears, build lasting friendships, and gradually find my confidence.</p><p className="message-text">Over the years, I have grown alongside my school, both academically and personally. Every experience, whether a joyful achievement or a challenging moment, has taught me valuable lessons in patience, discipline, responsibility, and maturity.</p>',
        },
        {
            id: 'headgirl',
            slug: 'head-girl-message',
            position: 'Head Girl',
            name: 'Rimsha Verma',
            icon: 'fa-graduation-cap',
            feature_image: '/images/head-girl.jpg',
            subtext: 'Student Leadership Council',
            excerpt: '<p className="message-text">My journey at St. Mary’s Convent School began in Class I, and today, as I stand in Class X as the Head Girl, I feel incredibly grateful and proud.</p><p className="message-text">These ten years have been filled with learning, growth, friendship, achievements, and unforgettable memories. The school management and my teachers have taught me not only academics but also discipline, confidence, kindness, and responsibility.</p><p className="message-text">This school is the place where I have been encouraged to discover my strengths, learn from my mistakes, face challenges with courage, and always believe in myself.</p>',
        },
    ];

    const messagesList = useMemo(() => {
        return (leadershipMessages && leadershipMessages.length > 0) ? leadershipMessages : defaultMessages;
    }, [leadershipMessages]);

    const [activeTabKey, setActiveTabKey] = useState(() => {
        return messagesList[0]?.slug || messagesList[0]?.id || 'principal';
    });

    const currentMessage = useMemo(() => {
        return messagesList.find(m => (m.slug === activeTabKey || m.id === activeTabKey)) || messagesList[0];
    }, [messagesList, activeTabKey]);

    return (
        <section className="section-messages-full-width reveal" id="messages">
            <div className="container-fluid px-3 px-md-5">
                <div className="text-center mb-4 mb-md-5">
                    <div className="section-kicker">Words of Inspiration</div>
                    <h2 className="section-title text-white">Leadership Messages</h2>
                    <div className="rule mx-auto"></div>
                </div>

                {/* Dynamic Message Tabs */}
                <ul className="nav nav-pills custom-message-tabs justify-content-center mb-4 mb-md-5" id="messagesTab" role="tablist">
                    {messagesList.map((msg, index) => {
                        const tabKey = msg.slug || msg.id || index;
                        const isActive = currentMessage && (currentMessage.slug === tabKey || currentMessage.id === tabKey);
                        return (
                            <li key={tabKey} className="nav-item" role="presentation">
                                <button
                                    className={`nav-link ${isActive ? 'active' : ''}`}
                                    id={`${tabKey}-tab`}
                                    type="button"
                                    role="tab"
                                    onClick={() => setActiveTabKey(tabKey)}
                                >
                                    <i className={`fa-solid ${msg.icon || 'fa-user-tie'} me-2`}></i>
                                    {msg.position || msg.name}
                                </button>
                            </li>
                        );
                    })}
                </ul>

                {/* Tab Content */}
                <div className="tab-content container" id="messagesTabContent">
                    {currentMessage && (
                        <div className="tab-pane fade show active" role="tabpanel" tabIndex="0">
                            <div className="message-card">
                                <div className="row g-4 align-items-center">
                                    <div className="col-lg-4 text-center">
                                        <div className="message-photo-wrapper mx-auto">
                                            <img 
                                                src={currentMessage.feature_image || '/images/logo.png'} 
                                                alt={`${currentMessage.name} - ${currentMessage.position}`} 
                                                className={`message-photo ${currentMessage.feature_image?.includes('logo.png') ? 'p-2 bg-white' : ''}`} 
                                            />
                                        </div>
                                        <h4 className="message-author-name mt-3">{currentMessage.name}</h4>
                                        <div className="message-author-title">{currentMessage.position}</div>
                                    </div>
                                    <div className="col-lg-8">
                                        <div className="message-body">
                                            <i className="fa-solid fa-quote-left quote-icon mb-3"></i>
                                            {currentMessage.excerpt ? (
                                                <div 
                                                    className="tiptap-content text-white-50"
                                                    dangerouslySetInnerHTML={{ __html: currentMessage.excerpt }}
                                                />
                                            ) : (
                                                <p className="message-text">No excerpt available.</p>
                                            )}

                                            {currentMessage.subtext && (
                                                <div className="message-signature">
                                                    <span className="gold-line"></span>
                                                    <span>{currentMessage.subtext}</span>
                                                </div>
                                            )}

                                            <div>
                                                <Link 
                                                    href={`/leadership-message/${currentMessage.slug || 'principal-message'}`} 
                                                    className="message-read-more"
                                                >
                                                    Read More <i className="fa-solid fa-arrow-right"></i>
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </section>
    );
}
