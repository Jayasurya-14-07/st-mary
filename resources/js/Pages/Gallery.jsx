import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function Gallery({ academicYearGalleries = [], galleries = [], flashNews = [] }) {
    const hasGalleries = (academicYearGalleries && academicYearGalleries.length > 0) || (galleries && galleries.length > 0);

    return (
        <AppLayout flashNews={flashNews}>
            <Head title="Photo Gallery — St. Mary's Convent School" />

            <SubpageHero 
                title="Photo Gallery" 
                breadcrumbs={[{ name: 'Photo Gallery', url: '/gallery' }]} 
            />

            <section className="py-5 bg-white">
                <div className="container py-3">
                    {academicYearGalleries && academicYearGalleries.length > 0 ? (
                        academicYearGalleries.map((yearGroup, index) => (
                            <div key={yearGroup.year_key || index} className="academic-year-section mb-5">
                                {/* Academic Year Header */}
                                <div className="d-flex align-items-center mb-4">
                                    <div className="pe-3">
                                        <h3 className="section-title text-navy fs-2 mb-0">{yearGroup.year_label}</h3>
                                    </div>
                                    <div className="flex-grow-1 border-bottom ms-2 opacity-25"></div>
                                </div>

                                {/* Album Cards Grid for this Academic Year */}
                                <div className="row g-4">
                                    {yearGroup.albums.map((album) => (
                                        <div key={album.id} className="col-lg-4 col-md-6">
                                            <Link href={`/gallery/folder/${album.slug}`} className="text-decoration-none">
                                                <div className="card h-100 border-0 shadow-sm rounded-4 overflow-hidden gallery-album-card transition-all">
                                                    <div className="position-relative overflow-hidden" style={{ height: '240px', background: '#f8f9fa' }}>
                                                        <img 
                                                            src={album.cover_url || '/images/gallery/gallery1.jpg'} 
                                                            alt={album.title} 
                                                            className="w-100 h-100 object-fit-cover transition-transform"
                                                        />
                                                        <div className="position-absolute top-0 end-0 m-3">
                                                            <span className="badge bg-wine text-white px-3 py-2 rounded-pill shadow-sm">
                                                                <i className="fa-solid fa-camera me-1"></i> {album.images_count || 0} Photos
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div className="card-body p-4 text-center">
                                                        <h5 className="card-title text-navy fw-bold mb-2">{album.title}</h5>
                                                        {album.description && (
                                                            <p className="card-text text-muted small line-clamp-2 mb-0">
                                                                {album.description}
                                                            </p>
                                                        )}
                                                    </div>
                                                </div>
                                            </Link>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        ))
                    ) : (
                        <div className="text-center py-5 my-4">
                            <i className="fa-regular fa-images text-muted mb-3" style={{ fontSize: '64px' }}></i>
                            <h3 className="fw-bold text-navy">No Photo Albums Found</h3>
                            <p className="text-muted">We haven't added any photo albums yet. Please check back later.</p>
                        </div>
                    )}
                </div>
            </section>
        </AppLayout>
    );
}
