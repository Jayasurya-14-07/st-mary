export default function NoticeBar({ notices = [], flashNews = [] }) {
    const rawItems = (notices && notices.length > 0) ? notices : flashNews;
    const noticeItems = Array.isArray(rawItems) ? rawItems : [];

    // Duplicate notice items if few to maintain continuous smooth scrolling
    const displayItems = noticeItems.length > 0
        ? (noticeItems.length === 1
            ? [noticeItems[0], noticeItems[0], noticeItems[0], noticeItems[0]]
            : noticeItems.length === 2
            ? [...noticeItems, ...noticeItems]
            : noticeItems)
        : [];

    const formatNoticeLink = (url) => {
        if (!url) return null;
        const trimmed = url.trim();
        if (!trimmed) return null;
        if (trimmed.startsWith('www.')) {
            return `https://${trimmed}`;
        }
        return trimmed;
    };

    const renderNoticeItems = () => {
        if (displayItems.length > 0) {
            return displayItems.map((n, i) => {
                const link = formatNoticeLink(n.link);
                const isNewTab = Boolean(n.open_in_new_tab);

                return (
                    <span key={i} className="notice-item">
                        {link ? (
                            <a
                                href={link}
                                target={isNewTab ? '_blank' : undefined}
                                rel={isNewTab ? 'noopener noreferrer' : undefined}
                                className="notice-link text-white text-decoration-none"
                            >
                                {n.title}
                            </a>
                        ) : (
                            <span>{n.title}</span>
                        )}
                        &nbsp; • &nbsp;
                    </span>
                );
            });
        }

        return 'Admissions registration begins in January \u00a0 • \u00a0 Entrance examinations run from March to the beginning of April \u00a0 • \u00a0 Fees are paid quarterly through the Parent Portal';
    };

    return (
        <>
            {/* Announcement Bar */}
            <div className="notice-bar d-none d-md-block">
                <div className="container d-flex align-items-center gap-4">
                    <div className="top-contact-info d-flex gap-3">
                        <span>
                            <i className="fa-solid fa-phone me-2"></i>
                            <a href="tel:+918082171498" className="text-white text-decoration-none">+91 8082171498</a>
                        </span>
                        <span>
                            <i className="fa-solid fa-envelope me-2"></i>
                            <a href="mailto:school@smcsramkot.in" className="text-white text-decoration-none">school@smcsramkot.in</a>
                        </span>
                    </div>
                    <div className="notice-wrapper flex-grow-1 d-flex align-items-center">
                        <span className="notice-label"><i className="fa-solid fa-bell me-1"></i> Notices</span>
                        <div className="notice-scroll w-100 ms-3">
                            <span>
                                {renderNoticeItems()}
                            </span>
                        </div>
                    </div>
                    <div className="notice-wrapper flex-grow-1 d-flex align-items-end">
                        <a href="#"><span className="notice-label"><i className="fa-solid fa-user me-1"></i> Parent Portal</span></a>
                    </div>
                </div>
            </div>

            {/* Mobile Notice Bar */}
            <div className="notice-bar d-md-none">
                <div className="container d-flex align-items-center gap-2">
                    <span className="notice-label px-2"><i className="fa-solid fa-bell"></i></span>
                    <div className="notice-scroll flex-grow-1">
                        <span>
                            {renderNoticeItems()}
                        </span>
                    </div>
                </div>
            </div>
        </>
    );
}
