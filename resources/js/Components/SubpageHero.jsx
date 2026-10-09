import { Link } from '@inertiajs/react';

/**
 * SubpageHero component for Page views (Filament Pages / page.blade.php equivalent).
 * Styled according to about.html design system with page-banner & glassmorphism breadcrumbs.
 */
export default function SubpageHero({ page = null, title = null, breadcrumbs = [] }) {
    // Title logic matching page.blade.php ($page->title ?? $title ?? 'About Us')
    const pageTitle = page?.title || title || 'About Us';

    return (
        <section className="page-banner text-center">
            <div className="page-banner-pattern"></div>
            <div className="container position-relative z-2">
                <div className="row justify-content-center">
                    <div className="col-lg-10">
                        <h1 className="page-banner-title">{pageTitle}</h1>

                        <div className="breadcrumb-wrapper">
                            <ul className="breadcrumb-custom">
                                <li className="breadcrumb-item">
                                    <Link href="/">
                                        <i className="fa-solid fa-house me-2"></i>Home
                                    </Link>
                                </li>
                                {breadcrumbs && breadcrumbs.length > 0 ? (
                                    breadcrumbs.map((crumb, index) => {
                                        const isLast = index === breadcrumbs.length - 1;
                                        const name = typeof crumb === 'string' ? crumb : (crumb.name || crumb.label);
                                        const url = typeof crumb === 'object' ? crumb.url : null;

                                        return isLast ? (
                                            <li key={index} className="breadcrumb-item active" aria-current="page">
                                                {name}
                                            </li>
                                        ) : (
                                            <li key={index} className="breadcrumb-item">
                                                <Link href={url || '#'}>{name}</Link>
                                            </li>
                                        );
                                    })
                                ) : (
                                    <li className="breadcrumb-item active" aria-current="page">
                                        {pageTitle}
                                    </li>
                                )}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
