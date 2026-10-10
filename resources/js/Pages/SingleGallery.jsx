import { useState, useEffect, useCallback } from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function SingleGallery({ gallery = null, images = [], academicYear = '' }) {
    const [lightboxIndex, setLightboxIndex] = useState(null);

    const isOpen = lightboxIndex !== null;
    const currentImage = isOpen && images[lightboxIndex] ? images[lightboxIndex] : null;

    const handlePrev = useCallback(() => {
        if (images.length === 0) return;
        setLightboxIndex((prevIndex) => 
            prevIndex === 0 ? images.length - 1 : prevIndex - 1
        );
    }, [images.length]);

    const handleNext = useCallback(() => {
        if (images.length === 0) return;
        setLightboxIndex((prevIndex) => 
            prevIndex === images.length - 1 ? 0 : prevIndex + 1
        );
    }, [images.length]);

    const handleClose = useCallback(() => {
        setLightboxIndex(null);
    }, []);

    useEffect(() => {
        const handleKeyDown = (e) => {
            if (!isOpen) return;
            if (e.key === 'ArrowLeft') handlePrev();
            if (e.key === 'ArrowRight') handleNext();
            if (e.key === 'Escape') handleClose();
        };

        window.addEventListener('keydown', handleKeyDown);
        return () => window.removeEventListener('keydown', handleKeyDown);
    }, [isOpen, handlePrev, handleNext, handleClose]);

    if (!gallery) {
        return (
            <AppLayout>
                <Head title="Album Not Found - St. Mary's Convent School" />
                <SubpageHero title="Album Not Found" />
                <div className="container py-5 text-center">
                    <h3>Album Not Found</h3>
                    <p className="text-muted">The requested photo album could not be found.</p>
                </div>
            </AppLayout>
        );
    }

    return (
        <AppLayout>
            <Head title={`${gallery.title} — Photo Gallery`} />

            <SubpageHero 
                title={gallery.title} 
                breadcrumbs={[
                    { name: 'Photo Gallery', url: '/gallery' },
                    { name: gallery.title, url: `/gallery/folder/${gallery.slug}` }
                ]} 
            />

            <section className="py-5 bg-white">
                <div className="container py-3">
                    {/* Album Title Header */}
                    <div className="row align-items-center mb-5">
                        <div className="col-lg-8">
                            <span className="badge bg-wine text-white px-3 py-2 rounded-pill mb-2 fw-semibold">
                                {academicYear}
                            </span>
                            <h2 className="display-6 fw-bold text-navy mb-2">{gallery.title}</h2>
                            {gallery.description && (
                                <p className="lead text-muted mb-0">{gallery.description}</p>
                            )}
                        </div>
                        <div className="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <Link href="/gallery" className="btn btn-outline-premium">
                                <i className="fa-solid fa-arrow-left me-2"></i> Back to All Albums
                            </Link>
                        </div>
                    </div>

                    {/* Image Grid */}
                    {images && images.length > 0 ? (
                        <div className="row g-4">
                            {images.map((img, index) => (
                                <div key={img.id || index} className="col-lg-4 col-md-6">
                                    <div 
                                        className="gallery-item uniform-card rounded-4 overflow-hidden shadow-sm position-relative cursor-pointer"
                                        onClick={() => setLightboxIndex(index)}
                                        style={{ height: '280px', cursor: 'pointer' }}
                                    >
                                        <img 
                                            src={img.url} 
                                            alt={img.title || gallery.title} 
                                            className="w-100 h-100 object-fit-cover"
                                        />
                                        <div className="gallery-overlay p-3 d-flex align-items-center justify-content-center">
                                            <div className="text-center text-white">
                                                <i className="fa-solid fa-magnifying-glass-plus fs-2 mb-2 text-gold"></i>
                                                <div className="small fw-semibold">{img.title || gallery.title}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div className="text-center py-5 my-4">
                            <i className="fa-regular fa-image text-muted mb-3 fs-1"></i>
                            <h4 className="text-muted fw-medium">No Photos in this Album</h4>
                            <p className="text-muted small">No images have been uploaded to this album yet.</p>
                        </div>
                    )}
                </div>
            </section>

            {/* Interactive Lightbox Popup Modal */}
            {isOpen && currentImage && (
                <div 
                    className="position-fixed inset-0 z-50 d-flex flex-column align-items-center justify-content-between p-3 p-md-4"
                    style={{
                        position: 'fixed',
                        top: 0,
                        left: 0,
                        right: 0,
                        bottom: 0,
                        backgroundColor: 'rgba(7, 19, 31, 0.95)',
                        backdropFilter: 'blur(10px)',
                        zIndex: 1055,
                    }}
                >
                    {/* Lightbox Top Header Bar */}
                    <div className="w-100 d-flex justify-content-between align-items-center text-white z-10 px-2 px-md-4">
                        <div>
                            <h5 className="mb-0 fw-bold text-white fs-5">{gallery.title}</h5>
                            <span className="text-gold small">
                                Photo {lightboxIndex + 1} of {images.length}
                            </span>
                        </div>
                        <button 
                            type="button" 
                            className="btn btn-link text-white text-decoration-none fs-2 p-0 border-0 shadow-none opacity-75 hover-opacity-100"
                            onClick={handleClose}
                            aria-label="Close Lightbox"
                        >
                            <i className="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    {/* Lightbox Main Image Display & Navigation Arrows */}
                    <div className="position-relative w-100 flex-grow-1 d-flex align-items-center justify-content-center my-3 overflow-hidden">
                        {/* Previous Button */}
                        {images.length > 1 && (
                            <button
                                type="button"
                                className="btn position-absolute start-0 ms-2 ms-md-4 text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg border-0"
                                style={{
                                    width: '50px',
                                    height: '50px',
                                    backgroundColor: 'rgba(255, 255, 255, 0.15)',
                                    backdropFilter: 'blur(5px)',
                                    zIndex: 10,
                                }}
                                onClick={handlePrev}
                                aria-label="Previous Photo"
                            >
                                <i className="fa-solid fa-chevron-left fs-4"></i>
                            </button>
                        )}

                        {/* Center Image */}
                        <img 
                            src={currentImage.url} 
                            alt={currentImage.title || gallery.title} 
                            className="img-fluid rounded-3 shadow-2xl max-h-100 object-fit-contain"
                            style={{ maxHeight: '78vh', maxWidth: '90vw' }}
                        />

                        {/* Next Button */}
                        {images.length > 1 && (
                            <button
                                type="button"
                                className="btn position-absolute end-0 me-2 me-md-4 text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg border-0"
                                style={{
                                    width: '50px',
                                    height: '50px',
                                    backgroundColor: 'rgba(255, 255, 255, 0.15)',
                                    backdropFilter: 'blur(5px)',
                                    zIndex: 10,
                                }}
                                onClick={handleNext}
                                aria-label="Next Photo"
                            >
                                <i className="fa-solid fa-chevron-right fs-4"></i>
                            </button>
                        )}
                    </div>

                    {/* Lightbox Bottom Caption */}
                    {currentImage.title && (
                        <div className="text-center text-white opacity-90 py-2">
                            <span className="fs-6 fw-medium">{currentImage.title}</span>
                        </div>
                    )}
                </div>
            )}
        </AppLayout>
    );
}
