import { Link } from '@inertiajs/react';

/**
 * SubpostHero component for Post views (Filament Posts / post.blade.php equivalent).
 * Styled according to about.html design system with page-banner & glassmorphism breadcrumbs.
 */
export default function SubpostHero({ post = null, categoryName = null, title = null }) {
    // Extract category name(s) matching post.blade.php logic ($post->categories->pluck('name')->join(', '))
    let categoryTitle = categoryName;

    if (!categoryTitle && post) {
        if (Array.isArray(post.categories) && post.categories.length > 0) {
            categoryTitle = post.categories.map(c => typeof c === 'string' ? c : (c.name || '')).filter(Boolean).join(', ');
        } else if (post.category) {
            categoryTitle = typeof post.category === 'string' ? post.category : (post.category.name || '');
        }
    }

    const displayTitle = categoryTitle || title || post?.title || 'News & Updates';
    const lowerTitle = displayTitle.toLowerCase();
    const showNewsEventsParent = lowerTitle.includes('event') || lowerTitle.includes('news') || lowerTitle.includes('special');

    return (
        <section className="page-banner text-center">
            <div className="page-banner-pattern"></div>
            <div className="container position-relative z-2">
                <div className="row justify-content-center">
                    <div className="col-lg-10">
                        <h1 className="page-banner-title">{displayTitle}</h1>

                        <div className="breadcrumb-wrapper">
                            <ul className="breadcrumb-custom">
                                <li className="breadcrumb-item">
                                    <Link href="/">
                                        <i className="fa-solid fa-house me-2"></i>Home
                                    </Link>
                                </li>

                                {showNewsEventsParent && (
                                    <li className="breadcrumb-item">
                                        <Link href="/news-events">News & Events</Link>
                                    </li>
                                )}

                                <li className="breadcrumb-item active" aria-current="page">
                                    {displayTitle}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
