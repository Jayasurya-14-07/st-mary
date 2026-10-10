import { Link } from '@inertiajs/react';

export default function PhotoGallerySection({ homeGalleries = [], galleryImages = [] }) {
    const defaultGallery = [
        { title: 'Morning Assembly', cover_url: '/images/gallery/gallery1.jpg', images_count: 12, slug: '#' },
        { title: 'Cultural Activities', cover_url: '/images/gallery/gallery2.jpg', images_count: 8, slug: '#' },
        { title: 'School Clubs', cover_url: '/images/gallery/gallery3.jpg', images_count: 15, slug: '#' },
        { title: 'Value Edu Club', cover_url: '/images/gallery/gallery4.jpg', images_count: 10, slug: '#' },
        { title: 'Paper Show', cover_url: '/images/gallery/gallery5.jpg', images_count: 6, slug: '#' },
        { title: 'New Academic Year', cover_url: '/images/gallery/gallery6.jpg', images_count: 20, slug: '#' },
    ];

    const displayAlbums = (homeGalleries && homeGalleries.length > 0)
        ? homeGalleries
        : defaultGallery;

    return (
        <section className="section section-soft" id="gallery">
            <div className="container">
                <div className="row align-items-end mb-5 reveal">
                    <div className="col-lg-7">
                        <div className="section-kicker">Photo Gallery</div>
                        <h2 className="section-title mb-0">Moments at School</h2>
                    </div>
                    <div className="col-lg-5 d-flex flex-column align-items-lg-end mt-4 mt-lg-0">
                        <Link href="/gallery" className="btn-gallery-view">
                            View All <i className="fa-solid fa-arrow-right ms-2"></i>
                        </Link>
                    </div>
                </div>

                <div className="row g-4" id="galleryGrid">
                    {displayAlbums.map((album, i) => {
                        const albumHref = album.slug && album.slug !== '#' ? `/gallery/folder/${album.slug}` : '/gallery';
                        return (
                            <div key={album.id || i} className="col-lg-4 col-md-6 reveal">
                                <Link href={albumHref} className="text-decoration-none">
                                    <div className="gallery-item uniform-card position-relative overflow-hidden rounded-4 shadow-sm">
                                        <img 
                                            src={album.cover_url || '/images/gallery/gallery1.jpg'} 
                                            alt={album.title}
                                            className="w-100 h-100 object-fit-cover"
                                        />
                                        <div className="gallery-overlay p-3 d-flex flex-column justify-content-end">
                                            <div className="badge bg-wine text-white align-self-start mb-2 px-2.5 py-1 rounded-pill small">
                                                <i className="fa-solid fa-camera me-1"></i> {album.images_count || 0} Photos
                                            </div>
                                            <h4 className="fs-5 serif text-white mb-0">{album.title}</h4>
                                        </div>
                                    </div>
                                </Link>
                            </div>
                        );
                    })}
                </div>
            </div>
        </section>
    );
}
