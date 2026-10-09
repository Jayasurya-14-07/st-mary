export default function AboutSection({ aboutus = null }) {
    return (
        <section className="section section-soft" id="story">
            <div className="container">
                <div className="row g-5 align-items-center">
                    <div className="col-lg-6 reveal">
                        <div className="image-card">
                            <img src="/images/about.jpg" alt="St. Mary's Convent School, Chhallan, Ramkot building" />
                        </div>
                    </div>
                    <div className="col-lg-6 reveal">
                        <h2 className="section-title">About</h2>
                        <div style={{ color: 'var(--navy)' }}>Unit of Diocese of Jammu-Srinagar Education Society (DJSES)</div>
                        <div className="rule"></div>
                        <p className="section-copy">
                            {aboutus ? aboutus.description : (
                                <>
                                    St. Mary’s Convent School, Chhallan, Ramkot, is an English-medium, co-educational secondary school, affiliated to the Jammu and Kashmir Board of School Education (JKBOSE). The school was established in 2002 by the Catholic Education Society of the Jammu–Srinagar Diocese.
                                    Correction: The school was established in 2002 by the Diocese of Jammu–Srinagar Education Society.&nbsp;
                                </>
                            )}
                            <a href="#" className="btn-gallery-view">Read More <i className="fa-solid fa-arrow-right ms-2"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    );
}
