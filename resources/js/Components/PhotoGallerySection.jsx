export default function PhotoGallerySection({ galleryImages = [] }) {

    const defaultGallery = [
        { title: 'Morning Assembly', image: '/images/gallery/gallery1.jpg', category: 'campus' },
        { title: 'Cultural Activities', image: '/images/gallery/gallery2.jpg', category: 'events' },
        { title: 'School Clubs', image: '/images/gallery/gallery3.jpg', category: 'activities' },
        { title: 'Value Edu Club', image: '/images/gallery/gallery4.jpg', category: 'learning' },
        { title: 'Paper Show', image: '/images/gallery/gallery5.jpg', category: 'sports' },
        { title: 'New Academic Year', image: '/images/gallery/gallery6.jpg', category: 'activities' },
    ];

    const displayGallery = (galleryImages && galleryImages.length > 0)
        ? galleryImages.map(img => ({
            title: img.title || 'Gallery Image',
            image: img.url || img.file_path || '/images/gallery/gallery1.jpg',
            category: 'campus'
          }))
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
                        <a href="/gallery" className="btn-gallery-view">View All <i className="fa-solid fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
                <div className="row g-4" id="galleryGrid">
                    {displayGallery.map((item, i) => (
                        <div key={i} className="col-lg-4 col-md-6 gallery-box reveal" data-category={item.category || 'campus'}>
                            <div className="gallery-item uniform-card" data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-image={item.image} data-title={item.title}>
                                <img src={item.image} alt={item.title} />
                                <div className="gallery-overlay">
                                    <div className="fs-5 serif">{item.title}</div>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
