import { useState, useMemo } from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function OurClubs({ ourClubs = [] }) {
    const defaultClubs = [
        { card: 'card-art', icon: 'icon-art', fa: 'fa-palette', title: 'Art Club', excerpt: 'Encourages imagination, creativity, and artistic expression through painting, sketching, and crafts.' },
        { card: 'card-eco', icon: 'icon-eco', fa: 'fa-seedling', title: 'Eco Club', excerpt: 'Promotes environmental awareness, sustainability, and responsible citizenship.' },
        { card: 'card-science', icon: 'icon-science', fa: 'fa-flask', title: 'EVS & Science Club', excerpt: 'Develops scientific curiosity through exploration, interactive experiments, and innovation.' },
        { card: 'card-heritage', icon: 'icon-heritage', fa: 'fa-landmark', title: 'Heritage Club', excerpt: 'Creates awareness and deep appreciation of our rich cultural heritage and traditions.' },
        { card: 'card-language', icon: 'icon-language', fa: 'fa-comments', title: 'Language Club', excerpt: 'Strengthens communication, vocabulary, reading, debate, and speaking skills.' },
        { card: 'card-math', icon: 'icon-math', fa: 'fa-square-root-variable', title: 'Math Club', excerpt: 'Makes mathematics engaging through logical thinking, puzzles, and activity-based learning.' },
        { card: 'card-sports', icon: 'icon-sports', fa: 'fa-trophy', title: 'Sports Club', excerpt: 'Promotes fitness, teamwork, discipline, leadership, and athletic sportsmanship.' },
        { card: 'card-value', icon: 'icon-value', fa: 'fa-hand-holding-heart', title: 'Value Education Club', excerpt: 'Nurtures moral character, empathy, respect, responsibility, and moral values.' },
    ];

    const [searchQuery, setSearchQuery] = useState('');

    const displayClubs = useMemo(() => {
        return (ourClubs && ourClubs.length > 0) ? ourClubs : defaultClubs;
    }, [ourClubs]);

    const filteredClubs = useMemo(() => {
        if (!searchQuery) return displayClubs;
        return displayClubs.filter(club =>
            (club.title && club.title.toLowerCase().includes(searchQuery.toLowerCase())) ||
            (club.excerpt && club.excerpt.toLowerCase().includes(searchQuery.toLowerCase())) ||
            (club.text && club.text.toLowerCase().includes(searchQuery.toLowerCase()))
        );
    }, [displayClubs, searchQuery]);

    return (
        <AppLayout>
            <Head title="Our Clubs — St. Mary's Convent School" />

            <SubpageHero title="Our Clubs" breadcrumbs={[{ name: 'Our Clubs', url: '/our-clubs' }]} />

            <section className="section py-5 bg-white">
                <div className="container">
                    {/* Header & Search Toolbar */}
                    <div className="row align-items-center mb-5">
                        <div className="col-lg-6">
                            <div className="section-kicker">Co-Curricular Activities</div>
                            <h2 className="section-title mb-0">Explore Our Clubs</h2>
                            <div className="rule mt-3"></div>
                        </div>
                        <div className="col-lg-6 mt-4 mt-lg-0">
                            <div className="search-box-custom">
                                <i className="fa-solid fa-magnifying-glass"></i>
                                <input
                                    type="text"
                                    className="form-control border-0 shadow-none bg-transparent ps-5"
                                    placeholder="Search club by title or activity..."
                                    value={searchQuery}
                                    onChange={(e) => setSearchQuery(e.target.value)}
                                />
                            </div>
                        </div>
                    </div>

                    {/* Clubs Grid */}
                    {filteredClubs.length > 0 ? (
                        <div className="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-4">
                            {filteredClubs.map((club, i) => (
                                <div key={club.id || i} className="col">
                                    <div className={`club-card ${club.card || 'card-art'} h-100 d-flex flex-column justify-content-between`}>
                                        <div>
                                            <div className={`club-icon-wrap ${club.icon || 'icon-art'}`}>
                                                <i className={`fa-solid ${club.fa || 'fa-palette'}`}></i>
                                            </div>
                                            <h4 className="club-title">{club.title}</h4>
                                            <p className="club-text">{club.excerpt || club.text}</p>
                                        </div>
                                        <div>
                                            {club.slug ? (
                                                <Link href={`/post/${club.slug}`} className="club-read-more">
                                                    Read More <i className="fa-solid fa-arrow-right"></i>
                                                </Link>
                                            ) : (
                                                <a href="#clubs" className="club-read-more">
                                                    Read More <i className="fa-solid fa-arrow-right"></i>
                                                </a>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div className="text-center py-5 my-4">
                            <i className="fa-solid fa-people-group text-muted mb-3 fs-1"></i>
                            <h4 className="text-muted fw-medium">No Clubs Found</h4>
                            <p className="text-muted small">Try searching with a different keyword.</p>
                        </div>
                    )}
                </div>
            </section>
        </AppLayout>
    );
}
