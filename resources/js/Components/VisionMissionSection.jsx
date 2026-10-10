export default function VisionMissionSection({ vision = null, mission = null, missionFocus = null }) {
    const defaultVisionExcerpt = 'To create a world where every child learns to love God, one another, and nature with understanding and joy, and grows into a good human being and a responsible citizen committed to serving society.';
    const defaultVisionSubtitle = 'Learn to Live';
    const defaultMissionExcerpt = 'We are committed to providing a safe, welcoming, and caring environment where every child is respected as an individual and encouraged to discover and develop their talents.';
    const defaultMissionFocusText = 'Peace through Mercy';

    const visTitle = vision?.title || 'OUR VISION';
    const visExcerpt = vision?.excerpt || defaultVisionExcerpt;
    const visSubtitle = vision?.subtitle || vision?.author || defaultVisionSubtitle;

    const misTitle = mission?.title || 'OUR MISSION';
    const misExcerpt = mission?.excerpt || defaultMissionExcerpt;

    const focusTitle = (missionFocus?.title && missionFocus?.title !== 'Mission Focus') 
        ? missionFocus.title.toUpperCase() 
        : 'MISSION FOCUS';
    const focusText = missionFocus?.excerpt 
        ? missionFocus.excerpt.replace(/<[^>]*>?/gm, '').trim() 
        : (missionFocus?.subtitle || defaultMissionFocusText);

    return (
        <section className="section-messages-full-width" id="values">
            <div className="container">
                <div className="vision-wrap reveal">
                    <div className="row g-0">
                        <div className="col-lg-7">
                            <div className="vision-inner">
                                <div className="section-kicker">Vision · Mission</div>
                                <h2 className="section-title">A light that guides every child.</h2>
                                <div className="motto">
                                    <span>{focusTitle}</span>
                                    <strong>{focusText}</strong>
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-5 d-flex align-items-end">
                            <div className="p-4 p-lg-5">
                                {/* OUR VISION */}
                                <div className="mb-4">
                                    <div className="text-uppercase fw-bold" style={{ fontSize: '.8rem', letterSpacing: '.14em', color: 'var(--gold-light)' }}>
                                        {visTitle}
                                    </div>
                                    {visExcerpt ? (
                                        <div 
                                            className="mt-2 mb-0 tiptap-content-white"
                                            style={{ color: 'rgba(255,255,255,.72)', lineHeight: 1.8 }}
                                            dangerouslySetInnerHTML={{ __html: visExcerpt }}
                                        />
                                    ) : null}
                                    {visSubtitle && (
                                        <p className="mt-2 mb-0" style={{ color: 'rgba(255,255,255,.72)', lineHeight: 1.8 }}>
                                            <em>{visSubtitle}</em>
                                        </p>
                                    )}
                                </div>

                                {/* OUR MISSION */}
                                <div>
                                    <div className="text-uppercase fw-bold" style={{ fontSize: '.8rem', letterSpacing: '.14em', color: 'var(--gold-light)' }}>
                                        {misTitle}
                                    </div>
                                    {misExcerpt ? (
                                        <div 
                                            className="mt-2 mb-0 tiptap-content-white"
                                            style={{ color: 'rgba(255,255,255,.72)', lineHeight: 1.8 }}
                                            dangerouslySetInnerHTML={{ __html: misExcerpt }}
                                        />
                                    ) : null}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
