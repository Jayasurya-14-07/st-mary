export default function FacilitiesSection() {
    return (
        <section className="section section-soft">
            <div className="container">
                <div className="row g-5 align-items-center">
                    <div className="col-lg-5 reveal">
                        <div className="section-kicker">Facilities</div>
                        <h2 className="section-title">Facilities for Learning and Growth.</h2>
                        <p className="section-copy">St. Mary’s Convent School provides a safe, welcoming, and child-friendly learning environment with facilities that support the academic, physical, creative, and overall development of our students. The school continually strives to provide the resources and opportunities needed to make learning meaningful, engaging, and enjoyable.</p>
                        <a href="#gallery" className="btn btn-outline-premium mt-3">Read More<i className="fa-solid fa-arrow-right ms-2"></i></a>
                    </div>
                    <div className="col-lg-7 reveal">
                        <div className="row g-3">
                            <div className="col-7">
                                <div className="image-card" style={{ height: '300px' }}>
                                    <img src="/images/facilities/facilities1.jpg" alt="Students learning in classroom" />
                                </div>
                            </div>
                            <div className="col-5">
                                <div className="image-card" style={{ height: '300px' }}>
                                    <img src="/images/facilities/facilities2.jpg" alt="Students practising yoga" />
                                </div>
                            </div>
                            <div className="col-5">
                                <div className="image-card" style={{ height: '220px' }}>
                                    <img src="/images/facilities/facilities3.jpg" alt="Students playing kabaddi" />
                                </div>
                            </div>
                            <div className="col-7">
                                <div className="image-card" style={{ height: '220px' }}>
                                    <img src="/images/facilities/facilities4.jpg" alt="School band" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
