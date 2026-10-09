import { useState } from 'react';

export default function LeadershipMessages() {
    const [activeTab, setActiveTab] = useState('principal');

    const tabs = [
        { id: 'principal', icon: 'fa-user-tie', label: 'Principal' },
        { id: 'management', icon: 'fa-building-columns', label: 'Management' },
        { id: 'headboy', icon: 'fa-user-graduate', label: 'Head Boy' },
        { id: 'headgirl', icon: 'fa-graduation-cap', label: 'Head Girl' },
    ];

    return (
        <section className="section-messages-full-width reveal" id="messages">
            <div className="container-fluid px-3 px-md-5">
                <div className="text-center mb-4 mb-md-5">
                    <div className="section-kicker">Words of Inspiration</div>
                    <h2 className="section-title text-white">Leadership Messages</h2>
                    <div className="rule mx-auto"></div>
                </div>

                <ul className="nav nav-pills custom-message-tabs justify-content-center mb-4 mb-md-5" id="messagesTab" role="tablist">
                    {tabs.map((tab) => (
                        <li key={tab.id} className="nav-item" role="presentation">
                            <button
                                className={`nav-link ${activeTab === tab.id ? 'active' : ''}`}
                                id={`${tab.id}-tab`}
                                type="button"
                                role="tab"
                                onClick={() => setActiveTab(tab.id)}
                            >
                                <i className={`fa-solid ${tab.icon} me-2`}></i>{tab.label}
                            </button>
                        </li>
                    ))}
                </ul>

                <div className="tab-content container" id="messagesTabContent">
                    {/* Principal */}
                    <div className={`tab-pane fade ${activeTab === 'principal' ? 'show active' : 'd-none'}`} id="principal-pane" role="tabpanel" tabIndex="0">
                        <div className="message-card">
                            <div className="row g-4 align-items-center">
                                <div className="col-lg-4 text-center">
                                    <div className="message-photo-wrapper mx-auto">
                                        <img src="/images/principal.jpg" alt="Sr. Joy Maria DM - Principal" className="message-photo" />
                                    </div>
                                    <h4 className="message-author-name mt-3">Sr. Joy Maria DM</h4>
                                    <div className="message-author-title">Principal</div>
                                </div>
                                <div className="col-lg-8">
                                    <div className="message-body">
                                        <i className="fa-solid fa-quote-left quote-icon mb-3"></i>
                                        <p className="message-text">“Education is not merely the acquisition of knowledge; it is the formation of character, the awakening of potential, and the preparation for a meaningful life.”</p>
                                        <p className="message-text">It gives me immense joy to welcome you to the official website of St. Mary’s Convent School, Chhallan Ramkot.</p>
                                        <p className="message-text">Established in 2002, our school has grown with a clear vision of providing quality education rooted in values, discipline, compassion, and excellence. Over the years, St. Mary’s has become not merely a place of learning, but a nurturing home where young minds are guided to discover their talents, develop their confidence, and grow into responsible and caring individuals.</p>
                                        <div className="message-signature">
                                            <span className="gold-line"></span>
                                            <span>St. Mary’s Convent School, Chhallan Ramkot</span>
                                        </div>
                                        <div><a href="#messages" className="message-read-more">Read More <i className="fa-solid fa-arrow-right"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Management */}
                    <div className={`tab-pane fade ${activeTab === 'management' ? 'show active' : 'd-none'}`} id="management-pane" role="tabpanel" tabIndex="0">
                        <div className="message-card">
                            <div className="row g-4 align-items-center">
                                <div className="col-lg-4 text-center">
                                    <div className="message-photo-wrapper mx-auto">
                                        <img src="/images/logo.png" alt="School Management" className="message-photo p-2 bg-white" />
                                    </div>
                                    <h4 className="message-author-name mt-3">Management Message</h4>
                                    <div className="message-author-title">Diocese of Jammu-Srinagar Education Society (DJSES)</div>
                                </div>
                                <div className="col-lg-8">
                                    <div className="message-body">
                                        <i className="fa-solid fa-quote-left quote-icon mb-3"></i>
                                        <p className="message-text">“Our goal is to nurture intellectual curiosity, moral integrity, and leadership qualities in our students, preparing them to be compassionate global citizens.”</p>
                                        <p className="message-text">The Management of St. Mary’s Convent School remains committed to upholding holistic education that balances academic vigor with strong moral values, discipline, and community service.</p>
                                        <p className="message-text">Under the auspices of the Diocese of Jammu-Srinagar Education Society (DJSES), we continue to modernize facilities and foster an environment where every child feels valued, inspired, and empowered to excel.</p>
                                        <div className="message-signature">
                                            <span className="gold-line"></span>
                                            <span>Diocese of Jammu-Srinagar Education Society (DJSES)</span>
                                        </div>
                                        <div><a href="#messages" className="message-read-more">Read More <i className="fa-solid fa-arrow-right"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Head Boy */}
                    <div className={`tab-pane fade ${activeTab === 'headboy' ? 'show active' : 'd-none'}`} id="headboy-pane" role="tabpanel" tabIndex="0">
                        <div className="message-card">
                            <div className="row g-4 align-items-center">
                                <div className="col-lg-4 text-center">
                                    <div className="message-photo-wrapper mx-auto">
                                        <img src="/images/head-boy.jpg" alt="Head Boy" className="message-photo" />
                                    </div>
                                    <h4 className="message-author-name mt-3">Utkarsh Singh</h4>
                                    <div className="message-author-title">Head Boy (Student Council)</div>
                                </div>
                                <div className="col-lg-8">
                                    <div className="message-body">
                                        <i className="fa-solid fa-quote-left quote-icon mb-3"></i>
                                        <p className="message-text">My journey at St. Mary’s Convent School began in Nursery, when I was a quiet and hesitant little child, taking my first steps into the world of learning. Little did I know that this school would become so much more than a place of education. It would become a second home—a place where I would discover my strengths, overcome my fears, build lasting friendships, and gradually find my confidence.</p>
                                        <p className="message-text">Over the years, I have grown alongside my school, both academically and personally. Every experience, whether a joyful achievement or a challenging moment, has taught me valuable lessons in patience, discipline, responsibility, and maturity.</p>
                                        <div className="message-signature"><span className="gold-line"></span><span>Student Leadership Council</span></div>
                                        <div><a href="#messages" className="message-read-more">Read More <i className="fa-solid fa-arrow-right"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Head Girl */}
                    <div className={`tab-pane fade ${activeTab === 'headgirl' ? 'show active' : 'd-none'}`} id="headgirl-pane" role="tabpanel" tabIndex="0">
                        <div className="message-card">
                            <div className="row g-4 align-items-center">
                                <div className="col-lg-4 text-center">
                                    <div className="message-photo-wrapper mx-auto">
                                        <img src="/images/head-girl.jpg" alt="Head Girl" className="message-photo" />
                                    </div>
                                    <h4 className="message-author-name mt-3">Rimsha Verma</h4>
                                    <div className="message-author-title">Head Girl (Student Council)</div>
                                </div>
                                <div className="col-lg-8">
                                    <div className="message-body">
                                        <i className="fa-solid fa-quote-left quote-icon mb-3"></i>
                                        <p className="message-text">My journey at St. Mary’s Convent School began in Class I, and today, as I stand in Class X as the Head Girl, I feel incredibly grateful and proud.</p>
                                        <p className="message-text">These ten years have been filled with learning, growth, friendship, achievements, and unforgettable memories. The school management and my teachers have taught me not only academics but also discipline, confidence, kindness, and responsibility.</p>
                                        <p className="message-text">This school is the place where I have been encouraged to discover my strengths, learn from my mistakes, face challenges with courage, and always believe in myself.</p>
                                        <div className="message-signature"><span className="gold-line"></span><span>Student Leadership Council</span></div>
                                        <div><a href="#messages" className="message-read-more">Read More <i className="fa-solid fa-arrow-right"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    );
}
