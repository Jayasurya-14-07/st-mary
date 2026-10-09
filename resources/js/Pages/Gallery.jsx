import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function Gallery({ galleries = [], flashNews = [] }) {
    return (
        <AppLayout flashNews={flashNews}>
            <Head title="Media Gallery - St. Mary's Convent School" />

            {/* Subpage Banner Hero */}
            <SubpageHero 
                title="Photo Gallery" 
                breadcrumbs={[{ label: 'Gallery' }]} 
            />

            {/* Gallery Main Content Section */}
            <section className="py-5 bg-white">
                <div className="container py-4">
                    {galleries && galleries.length > 0 ? (
                        <div className="row g-4">
                            {galleries.map((gallery) => {
                                const coverImg = gallery.images && gallery.images.length > 0 ? gallery.images[0] : null;
                                const coverUrl = coverImg 
                                    ? (coverImg.url || (coverImg.path ? `/storage/${coverImg.path.replace(/^\//, '')}` : null))
                                    : null;

                                return (
                                    <div key={gallery.id} className="col-lg-4 col-md-6">
                                        <div className="card h-100 shadow-sm border-0 gallery-album-card overflow-hidden">
                                            <div className="gallery-album-image position-relative" style={{ height: '240px', background: '#f3f4f6' }}>
                                                {coverUrl ? (
                                                    <img 
                                                        src={coverUrl} 
                                                        alt={gallery.title} 
                                                        className="w-100 h-100 object-fit-cover"
                                                    />
                                                ) : (
                                                    <div className="d-flex align-items-center justify-content-center h-100 text-muted fs-1">
                                                        <i className="fa-regular fa-image"></i>
                                                    </div>
                                                )}
                                                <div className="gallery-album-overlay position-absolute inset-0 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0 transition-opacity">
                                                    <i className="fa-solid fa-folder-open text-white fs-2"></i>
                                                </div>
                                            </div>
                                            <div className="card-body text-center p-4">
                                                <h5 className="card-title fw-bold mb-2">{gallery.title}</h5>
                                                <p className="card-text text-muted small mb-0">
                                                    <i className="fa-solid fa-camera me-2 text-gold"></i>
                                                    {gallery.images ? gallery.images.length : 0} Photos
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    ) : (
                        <div className="text-center py-5">
                            <div className="text-muted mb-3">
                                <i className="fa-regular fa-images" style={{ fontSize: '64px' }}></i>
                            </div>
                            <h3 className="fw-bold">No Albums Found</h3>
                            <p className="text-muted">We haven't added any photo albums yet. Please check back later.</p>
                        </div>
                    )}
                </div>
            </section>
        </AppLayout>
    );
}
