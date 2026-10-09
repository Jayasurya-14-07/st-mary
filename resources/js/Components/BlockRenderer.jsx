import { useState } from 'react';

/**
 * Helper to convert Youtube / Vimeo URLs into valid iframe embed URLs
 */
function toEmbedUrl(url) {
    if (!url || typeof url !== 'string') return null;

    // Youtube short or standard URL
    const ytMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i);
    if (ytMatch && ytMatch[1]) {
        return `https://www.youtube.com/embed/${ytMatch[1]}`;
    }

    // Vimeo URL
    const vimeoMatch = url.match(/vimeo\.com\/(?:video\/)?(\d+)/i);
    if (vimeoMatch && vimeoMatch[1]) {
        return `https://player.vimeo.com/video/${vimeoMatch[1]}`;
    }

    return url;
}

/**
 * Normalizes image paths stored in Filament DB
 */
function normalizeMediaUrl(url) {
    if (!url) return '';
    if (url.startsWith('http://') || url.startsWith('https://') || url.startsWith('/')) {
        return url;
    }
    return `/storage/${url.replace(/^\//, '')}`;
}

/**
 * BlockRenderer parses and renders dynamic Filament block content arrays stored in DB.
 * Handles headings, rich text, images, custom grids, videos, accordions, tabs, etc.
 */
export default function BlockRenderer({ blocks = [] }) {
    const [activeTabs, setActiveTabs] = useState({});
    const [activeAccordions, setActiveAccordions] = useState({});

    if (!Array.isArray(blocks) || blocks.length === 0) {
        return null;
    }

    const toggleAccordion = (blockIndex, itemIndex) => {
        const key = `${blockIndex}-${itemIndex}`;
        setActiveAccordions(prev => ({
            ...prev,
            [key]: !prev[key]
        }));
    };

    const handleTabChange = (blockIndex, tabIndex) => {
        setActiveTabs(prev => ({
            ...prev,
            [blockIndex]: tabIndex
        }));
    };

    return (
        <div className="block-renderer-content">
            {blocks.map((block, index) => {
                if (!block) return null;
                const type = block.type || '';
                const data = block.data || {};
                const content = data.content || '';
                const alt = data.alt || '';
                const url = data.url || '';
                const level = data.level || 'h3';

                switch (type) {
                    case 'heading': {
                        const Tag = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'].includes(level) ? level : 'h3';
                        return (
                            <div key={index} className="block-item mb-3">
                                <Tag className="section-heading fw-bold text-navy">{content}</Tag>
                            </div>
                        );
                    }

                    case 'Rich Editor':
                    case 'Tip tap editor':
                    case 'TipTap Editor':
                    case 'tiptap': {
                        return (
                            <div key={index} className="block-item mb-4">
                                <div 
                                    className="content-text tiptap-content"
                                    dangerouslySetInnerHTML={{ __html: typeof content === 'string' ? content : JSON.stringify(content) }}
                                />
                            </div>
                        );
                    }

                    case 'image': {
                        if (!url) return null;
                        const imgUrl = normalizeMediaUrl(url);
                        return (
                            <div key={index} className="block-item mb-4">
                                <a href={imgUrl} target="_blank" rel="noopener noreferrer" className="popup-image d-block">
                                    <img src={imgUrl} alt={alt} className="img-fluid rounded shadow-sm" />
                                </a>
                            </div>
                        );
                    }

                    case 'Custom Grid': {
                        const columns = data.columns || '2';
                        const items = Array.isArray(data.items) ? data.items : [];
                        let colClass = 'col-md-6';
                        if (columns === '3') colClass = 'col-md-4';
                        if (columns === '4') colClass = 'col-md-3';

                        return (
                            <div key={index} className="block-item mb-4">
                                <div className="row g-3">
                                    {items.map((item, iIndex) => (
                                        <div key={iIndex} className={colClass}>
                                            <div className="grid-item p-3 border rounded bg-light h-100">
                                                {(item.image || item.url) && (
                                                    <img 
                                                        src={normalizeMediaUrl(item.image || item.url)} 
                                                        alt={item.title || ''} 
                                                        className="img-fluid rounded mb-2 w-100"
                                                        style={{ height: '200px', objectFit: 'cover' }}
                                                    />
                                                )}
                                                {item.title && <h5 className="fw-bold text-navy mb-2">{item.title}</h5>}
                                                {item.content && (
                                                    <div 
                                                        className="grid-content text-muted small"
                                                        dangerouslySetInnerHTML={{ __html: item.content }}
                                                    />
                                                )}
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        );
                    }

                    case 'video': {
                        const embedUrl = toEmbedUrl(url);
                        if (!embedUrl) return null;
                        return (
                            <div key={index} className="block-item mb-4">
                                <div className="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                                    <iframe 
                                        src={embedUrl} 
                                        title={`Video ${index}`}
                                        allowFullScreen 
                                        className="border-0"
                                    />
                                </div>
                            </div>
                        );
                    }

                    case 'Image Carousel': {
                        const images = Array.isArray(data.images) ? data.images : [];
                        return (
                            <div key={index} className="block-item mb-4">
                                <div className="row g-2">
                                    {images.map((imgGroup, gIndex) => {
                                        const urls = Array.isArray(imgGroup.url) ? imgGroup.url : [imgGroup.url];
                                        return urls.map((iUrl, uIndex) => (
                                            <div key={`${gIndex}-${uIndex}`} className="col-6 col-md-4 col-lg-3">
                                                <a href={normalizeMediaUrl(iUrl)} target="_blank" rel="noopener noreferrer">
                                                    <img 
                                                        src={normalizeMediaUrl(iUrl)} 
                                                        alt={imgGroup.alt || 'Gallery'} 
                                                        className="img-fluid rounded shadow-sm w-100"
                                                        style={{ height: '160px', objectFit: 'cover' }}
                                                    />
                                                </a>
                                            </div>
                                        ));
                                    })}
                                </div>
                            </div>
                        );
                    }

                    case 'iframe': {
                        if (!url) return null;
                        return (
                            <div key={index} className="block-item mb-4">
                                <iframe 
                                    src={url} 
                                    width="100%" 
                                    height="600px" 
                                    className="border rounded shadow-sm"
                                    title={`Iframe ${index}`}
                                />
                            </div>
                        );
                    }

                    case 'button': {
                        if (!url) return null;
                        return (
                            <div key={index} className="block-item mb-3">
                                <a 
                                    href={url} 
                                    className="btn btn-premium"
                                    target={data.open_in_new_tab ? '_blank' : undefined}
                                    rel={data.open_in_new_tab ? 'noopener noreferrer' : undefined}
                                >
                                    {data.text || 'Click Here'}
                                </a>
                            </div>
                        );
                    }

                    case 'accordion': {
                        const items = Array.isArray(data.items) ? data.items : [];
                        return (
                            <div key={index} className="block-item mb-4">
                                <div className="accordion custom-accordion">
                                    {items.map((item, iIndex) => {
                                        const isOpen = activeAccordions[`${index}-${iIndex}`] ?? (iIndex === 0);
                                        return (
                                            <div key={iIndex} className="accordion-item border rounded mb-2 overflow-hidden">
                                                <h2 className="accordion-header">
                                                    <button 
                                                        type="button"
                                                        className={`accordion-button shadow-none fw-bold ${isOpen ? '' : 'collapsed'}`}
                                                        onClick={() => toggleAccordion(index, iIndex)}
                                                    >
                                                        {item.title || 'Untitled'}
                                                    </button>
                                                </h2>
                                                {isOpen && (
                                                    <div className="accordion-body bg-light">
                                                        {item.content && (
                                                            <div 
                                                                className="tiptap-content mb-3"
                                                                dangerouslySetInnerHTML={{ __html: item.content }}
                                                            />
                                                        )}
                                                    </div>
                                                )}
                                            </div>
                                        );
                                    })}
                                </div>
                            </div>
                        );
                    }

                    case 'tabs': {
                        const tabItems = Array.isArray(data.items) ? data.items : [];
                        const activeIndex = activeTabs[index] || 0;
                        const currentTab = tabItems[activeIndex];

                        return (
                            <div key={index} className="block-item mb-4">
                                <ul className="nav nav-tabs border-bottom-0 mb-3">
                                    {tabItems.map((tab, tIndex) => (
                                        <li key={tIndex} className="nav-item">
                                            <button 
                                                type="button"
                                                className={`nav-link fw-bold ${activeIndex === tIndex ? 'active bg-navy text-white' : 'bg-light text-navy'}`}
                                                onClick={() => handleTabChange(index, tIndex)}
                                            >
                                                {tab.title || `Tab ${tIndex + 1}`}
                                            </button>
                                        </li>
                                    ))}
                                </ul>
                                {currentTab && (
                                    <div className="p-4 border rounded bg-white shadow-sm">
                                        {currentTab.content && (
                                            <div 
                                                className="tiptap-content"
                                                dangerouslySetInnerHTML={{ __html: currentTab.content }}
                                            />
                                        )}
                                    </div>
                                )}
                            </div>
                        );
                    }

                    default:
                        return null;
                }
            })}
        </div>
    );
}
