export default function NoticeBar({ notices = [], flashNews = [] }) {
    const noticeItems = (notices && notices.length > 0) ? notices : flashNews;

    return (
        <>
            {/* Announcement Bar */}
            <div className="notice-bar d-none d-md-block">
                <div className="container d-flex align-items-center gap-4">
                    <div className="top-contact-info d-flex gap-3">
                        <span><i className="fa-solid fa-phone me-2"></i>+91 8082171498</span>
                        <span><i className="fa-solid fa-envelope me-2"></i>smcsramkot@gmail.com</span>
                    </div>
                    <div className="notice-wrapper flex-grow-1 d-flex align-items-center">
                        <span className="notice-label"><i className="fa-solid fa-bell me-1"></i> Notices</span>
                        <div className="notice-scroll w-100 ms-3">
                            <span>
                                {noticeItems && noticeItems.length > 0
                                    ? noticeItems.map((n, i) => <span key={i}>{n.title}&nbsp; • &nbsp;</span>)
                                    : 'Admissions registration begins in January \u00a0 • \u00a0 Entrance examinations run from March to the beginning of April \u00a0 • \u00a0 Fees are paid quarterly through the Parent Portal'
                                }
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
                            {noticeItems && noticeItems.length > 0
                                ? noticeItems.map((n, i) => <span key={i}>{n.title}&nbsp; • &nbsp;</span>)
                                : 'Admissions registration begins in January \u00a0 • \u00a0 Entrance examinations run from March to the beginning of April'
                            }
                        </span>
                    </div>
                </div>
            </div>
        </>
    );
}
