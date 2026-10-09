export default function ClubsSection() {
    const clubs = [
        { card: 'card-art', icon: 'icon-art', fa: 'fa-palette', title: 'Art Club', text: 'Encourages imagination, creativity, and artistic expression through painting, sketching, and crafts.' },
        { card: 'card-eco', icon: 'icon-eco', fa: 'fa-seedling', title: 'Eco Club', text: 'Promotes environmental awareness, sustainability, and responsible citizenship.' },
        { card: 'card-science', icon: 'icon-science', fa: 'fa-flask', title: 'EVS & Science Club', text: 'Develops scientific curiosity through exploration, interactive experiments, and innovation.' },
        { card: 'card-heritage', icon: 'icon-heritage', fa: 'fa-landmark', title: 'Heritage Club', text: 'Creates awareness and deep appreciation of our rich cultural heritage and traditions.' },
        { card: 'card-language', icon: 'icon-language', fa: 'fa-comments', title: 'Language Club', text: 'Strengthens communication, vocabulary, reading, debate, and speaking skills.' },
        { card: 'card-math', icon: 'icon-math', fa: 'fa-square-root-variable', title: 'Math Club', text: 'Makes mathematics engaging through logical thinking, puzzles, and activity-based learning.' },
        { card: 'card-sports', icon: 'icon-sports', fa: 'fa-trophy', title: 'Sports Club', text: 'Promotes fitness, teamwork, discipline, leadership, and athletic sportsmanship.' },
        { card: 'card-value', icon: 'icon-value', fa: 'fa-hand-holding-heart', title: 'Value Education Club', text: 'Nurtures moral character, empathy, respect, responsibility, and moral values.' },
    ];

    return (
        <section className="section bg-white" id="clubs">
            <div className="container">
                <div className="row align-items-center mb-5 reveal">
                    <div className="col-lg-7">
                        <div className="section-kicker">Co-Curricular Activities</div>
                        <h2 className="section-title mb-0">Our Clubs</h2>
                        <div className="rule mt-3"></div>
                    </div>
                </div>
                <div className="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-4 reveal">
                    {clubs.map((club, i) => (
                        <div key={i} className="col">
                            <div className={`club-card ${club.card} h-100 d-flex flex-column justify-content-between`}>
                                <div>
                                    <div className={`club-icon-wrap ${club.icon}`}><i className={`fa-solid ${club.fa}`}></i></div>
                                    <h4 className="club-title">{club.title}</h4>
                                    <p className="club-text">{club.text}</p>
                                </div>
                                <div><a href="#clubs" className="club-read-more">Read More <i className="fa-solid fa-arrow-right"></i></a></div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
