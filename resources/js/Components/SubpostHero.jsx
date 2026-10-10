import { Link } from '@inertiajs/react';

/**
 * SubpostHero component for Post views (Filament Posts / post.blade.php equivalent).
 * Styled according to about.html design system with page-banner & glassmorphism breadcrumbs.
 */
export default function SubpostHero({ post = null, categoryName = null, title = null }) {
    // 1. Post title for the main banner heading
    const pageTitle = post?.title || title || 'Post';

    // 2. Extract category name for breadcrumb
    let categoryTitle = categoryName;

    if (!categoryTitle && post) {
        if (Array.isArray(post.categories) && post.categories.length > 0) {
            categoryTitle = post.categories.map(c => typeof c === 'string' ? c : (c.name || '')).filter(Boolean).join(', ');
        } else if (post.category) {
            categoryTitle = typeof post.category === 'string' ? post.category : (post.category.name || '');
        }
    }

    const breadcrumbCategory = categoryTitle || 'News & Events';
    const lowerCategory = breadcrumbCategory.toLowerCase();

    // Determine category URL
    let categoryUrl = '/news-events';
    if (lowerCategory.includes('club')) {
        categoryUrl = '/our-clubs';
    } else if (lowerCategory.includes('facilit')) {
        categoryUrl = '/facilities';
    }

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

                                <li className="breadcrumb-item active" aria-current="page">
                                    <Link href={categoryUrl}>{breadcrumbCategory}</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
