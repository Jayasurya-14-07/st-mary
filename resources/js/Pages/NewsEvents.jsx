import { useState, useMemo } from 'react';
import { Head } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function NewsEvents({ newsEvents = [], tags = [] }) {
    const [searchQuery, setSearchQuery] = useState('');
    const [selectedTag, setSelectedTag] = useState('all');
    const [currentPage, setCurrentPage] = useState(1);

    const ITEMS_PER_PAGE = 6;

    const allItems = useMemo(() => {
        return newsEvents || [];
    }, [newsEvents]);

    const filteredItems = useMemo(() => {
        return allItems.filter(item => {
            const matchesSearch = !searchQuery ||
                (item.title && item.title.toLowerCase().includes(searchQuery.toLowerCase())) ||
                (item.excerpt && item.excerpt.toLowerCase().includes(searchQuery.toLowerCase()));

            const matchesTag = selectedTag === 'all' ||
                (item.tag_id && String(item.tag_id) === String(selectedTag)) ||
                (item.tag_name && item.tag_name.toLowerCase() === String(selectedTag).toLowerCase());

            return matchesSearch && matchesTag;
        });
    }, [allItems, searchQuery, selectedTag]);

    const totalPages = Math.ceil(filteredItems.length / ITEMS_PER_PAGE);

    const paginatedItems = useMemo(() => {
        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        return filteredItems.slice(startIndex, startIndex + ITEMS_PER_PAGE);
    }, [filteredItems, currentPage]);

    const handleSearchChange = (e) => {
        setSearchQuery(e.target.value);
        setCurrentPage(1);
    };

    const handleTagChange = (tagId) => {
        setSelectedTag(tagId);
        setCurrentPage(1);
    };

    // Only show tags that actually have matching posts in newsEvents
    const availableTags = useMemo(() => {
        if (!tags || tags.length === 0) return [];
        const postTagIds = new Set(allItems.map(item => String(item.tag_id)).filter(Boolean));
        const postTagNames = new Set(allItems.map(item => (item.tag_name || '').toLowerCase()).filter(Boolean));
        return tags.filter(tag => postTagIds.has(String(tag.id)) || postTagNames.has((tag.name || '').toLowerCase()));
    }, [tags, allItems]);

    return (
        <AppLayout>
            <Head title="News & Events — St. Mary's Convent School" />

            <SubpageHero title="News & Events" breadcrumbs={[{ name: 'News & Events', url: '/news-events' }]} />

            <section className="section py-5 bg-white">
                <div className="container">
                    {/* Search & Tag Filter Bar */}
                    <div className="news-toolbar mb-5">
                        <div className="row g-3 align-items-center">
                            <div className="col-lg-5">
                                <div className="search-box-custom">
                                    <i className="fa-solid fa-magnifying-glass"></i>
                                    <input
                                        type="text"
                                        className="form-control border-0 shadow-none bg-transparent ps-5"
                                        placeholder="Search news by title or keyword..."
                                        value={searchQuery}
                                        onChange={handleSearchChange}
                                    />
                                </div>
                            </div>
                            <div className="col-lg-7">
                                <div className="filter-pills justify-content-lg-end m-0 d-flex flex-wrap gap-2">
                                    <button
                                        className={`filter-btn ${selectedTag === 'all' ? 'active' : ''}`}
                                        onClick={() => handleTagChange('all')}
                                    >
                                        All Updates
                                    </button>

                                    {availableTags && availableTags.length > 0 && (
                                        availableTags.map((tag) => (
                                            <button
                                                key={tag.id}
                                                className={`filter-btn ${selectedTag === tag.id ? 'active' : ''}`}
                                                onClick={() => handleTagChange(tag.id)}
                                            >
                                                {tag.name}
                                            </button>
                                        ))
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* News Grid Container */}
                    <div className="row g-4 mb-5">
                        {paginatedItems.length > 0 ? (
                            paginatedItems.map((item, index) => (
                                <div key={item.id || index} className="col-lg-4 col-md-6">
                                    <div className="news-card-v2 h-100 d-flex flex-column bg-white border rounded-4 overflow-hidden shadow-sm">
                                        <div className="news-thumb-wrapper position-relative" style={{ height: '220px', overflow: 'hidden' }}>
                                            <img
                                                src={item.feature_image || '/images/news/news1.jpg'}
                                                alt={item.title}
                                                className="w-100 h-100"
                                                style={{ objectFit: 'cover' }}
                                            />
                                            <span className="news-category-badge">{item.tag_name || 'News & Events'}</span>
                                            <span className="news-date-chip">{item.publish_date || '05 OCT'}</span>
                                        </div>
                                        <div className="news-card-body p-4 d-flex flex-column flex-grow-1">
                                            <h4 className="news-title-v2 fw-bold text-navy mb-2">{item.title}</h4>
                                            <p className="news-excerpt text-muted small flex-grow-1">{item.excerpt}</p>
                                            <div className="news-card-footer border-top pt-3 mt-3 d-flex align-items-center justify-content-between">
                                                <a
                                                    href={item.slug ? `/post/${item.slug}` : '#'}
                                                    className="btn p-0 news-link-btn fw-bold"
                                                    style={{ color: 'var(--wine)' }}
                                                >
                                                    Read More <i className="fa-solid fa-arrow-right ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))
                        ) : (
                            <div className="col-12 text-center py-5">
                                <i className="fa-solid fa-newspaper fs-1 text-muted mb-3 d-block"></i>
                                <h4 className="text-navy fw-bold">No News &amp; Events</h4>
                                <p className="text-muted">Try adjusting your search query or tag selection.</p>
                            </div>
                        )}
                    </div>

                    {/* Pagination Bar (6 items per page) */}
                    {totalPages > 1 && (
                        <nav className="d-flex justify-content-center">
                            <ul className="pagination-custom list-unstyled d-flex align-items-center gap-2">
                                <li className={`page-item ${currentPage === 1 ? 'disabled' : ''}`}>
                                    <button
                                        className="page-link rounded-circle border-0 shadow-sm"
                                        onClick={() => setCurrentPage(prev => Math.max(prev - 1, 1))}
                                        disabled={currentPage === 1}
                                        style={{ width: '40px', height: '40px', display: 'grid', placeItems: 'center' }}
                                    >
                                        <i className="fa-solid fa-chevron-left"></i>
                                    </button>
                                </li>

                                {Array.from({ length: totalPages }).map((_, pIndex) => {
                                    const pageNum = pIndex + 1;
                                    return (
                                        <li key={pageNum} className={`page-item ${currentPage === pageNum ? 'active' : ''}`}>
                                            <button
                                                className={`page-link rounded-circle border-0 shadow-sm fw-bold ${currentPage === pageNum ? 'bg-navy text-white' : 'bg-light text-navy'}`}
                                                onClick={() => setCurrentPage(pageNum)}
                                                style={{ width: '40px', height: '40px', display: 'grid', placeItems: 'center' }}
                                            >
                                                {pageNum}
                                            </button>
                                        </li>
                                    );
                                })}

                                <li className={`page-item ${currentPage === totalPages ? 'disabled' : ''}`}>
                                    <button
                                        className="page-link rounded-circle border-0 shadow-sm"
                                        onClick={() => setCurrentPage(prev => Math.min(prev + 1, totalPages))}
                                        disabled={currentPage === totalPages}
                                        style={{ width: '40px', height: '40px', display: 'grid', placeItems: 'center' }}
                                    >
                                        <i className="fa-solid fa-chevron-right"></i>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    )}
                </div>
            </section>
        </AppLayout>
    );
}
