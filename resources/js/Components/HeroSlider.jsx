import { useEffect } from 'react';
import { Link } from '@inertiajs/react';

export default function HeroSlider({ sliders = null, sliderImages = [], belowSliderFacilities = [] }) {
    // Determine dynamic list of images from DB
    let imagesList = [];

    if (Array.isArray(sliderImages) && sliderImages.length > 0) {
        imagesList = sliderImages.map(item => typeof item === 'string' ? item : (item.url || item.image || ''));
    } else if (sliders) {
        const sliderArray = Array.isArray(sliders) ? sliders : [sliders];
        sliderArray.forEach(s => {
            if (!s) return;
            const imgs = s.image || s.images;
            if (Array.isArray(imgs)) {
                imgs.forEach(img => {
                    if (typeof img === 'string') {
                        imagesList.push(img.startsWith('/') || img.startsWith('http') ? img : `/storage/${img}`);
                    } else if (img && img.url) {
                        imagesList.push(img.url);
                    }
                });
            } else if (typeof imgs === 'string' && imgs) {
                imagesList.push(imgs.startsWith('/') || imgs.startsWith('http') ? imgs : `/storage/${imgs}`);
            }
        });
    }

    imagesList = imagesList.filter(Boolean);
    const totalSlides = imagesList.length;

    const defaultStats = [
        { title: 'Smart Board Classrooms', slug: 'smart-board-classrooms', link: '/facilities#smart-board-classrooms' },
        { title: 'Computer Lab', slug: 'computer-lab', link: '/facilities#computer-lab' },
        { title: 'Science Laboratory', slug: 'science-laboratory', link: '/facilities#science-laboratory' },
        { title: 'Playground', slug: 'playground', link: '/facilities#playground' },
    ];

    const displayStats = (belowSliderFacilities && belowSliderFacilities.length > 0)
        ? belowSliderFacilities
        : defaultStats;

    useEffect(() => {
        if (totalSlides === 0) return;
        const heroCarousel = document.getElementById('heroCarousel');
        const slideFraction = document.getElementById('slideFraction');

        let carouselInstance = null;
        if (heroCarousel && window.bootstrap && window.bootstrap.Carousel) {
            carouselInstance = window.bootstrap.Carousel.getOrCreateInstance(heroCarousel, {
                interval: 4000,
                ride: 'carousel',
                touch: true,
                pause: false
            });
            carouselInstance.cycle();
        }

        if (heroCarousel && slideFraction) {
            const handleSlide = (event) => {
                slideFraction.textContent = (event.to + 1) + '/' + totalSlides;
            };
            heroCarousel.addEventListener('slide.bs.carousel', handleSlide);
            return () => {
                heroCarousel.removeEventListener('slide.bs.carousel', handleSlide);
                if (carouselInstance) {
                    try {
                        carouselInstance.dispose();
                    } catch (e) { }
                }
            };
        }
    }, [totalSlides]);

    // If no dynamic sliders exist in database, display NO slider state
    if (imagesList.length === 0) {
        return (
            <header className="hero d-flex align-items-center justify-content-center text-center py-5" id="home" style={{ minHeight: '400px', background: '#102b46' }}>
                <div className="container py-5">
                    <div className="eyebrow justify-content-center text-gold mb-3">Welcome to</div>
                    <h1 className="text-white display-5 mb-3">St. Mary's Convent School <em>Chhallan, Ramkot</em></h1>
                    <p className="lead text-white-50 mb-0">NO slider</p>
                </div>
            </header>
        );
    }

    return (
        <header className="hero" id="home">
            <div className="hero-overlay"></div>
            <div id="heroCarousel" className="carousel slide carousel-fade hero-carousel-bg" data-bs-ride="carousel"
                data-bs-interval="4000" data-bs-pause="false">
                <div className="carousel-inner h-100">
                    {imagesList.map((imgUrl, i) => (
                        <div key={i} className={`carousel-item h-100 ${i === 0 ? 'active' : ''}`}>
                            <div className="hero-media" style={{ backgroundImage: `url('${imgUrl}')` }}></div>
                        </div>
                    ))}
                </div>

                {totalSlides > 1 && (
                    <>
                        <button className="carousel-control-prev z-3" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style={{ width: '5%' }}>
                            <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span className="visually-hidden">Previous</span>
                        </button>
                        <button className="carousel-control-next z-3" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style={{ width: '5%' }}>
                            <span className="carousel-control-next-icon" aria-hidden="true"></span>
                            <span className="visually-hidden">Next</span>
                        </button>
                    </>
                )}
            </div>

            <div className="container hero-content position-relative z-3">
                <div className="row">
                    <div className="col-lg-9">
                        <div className="eyebrow">Welcome to</div>
                        <h1>St. Mary's Convent School <em>Chhallan, Ramkot</em></h1>
                        <p style={{ color: 'var(--gold-light)' }}><em>Unit of Diocese of Jammu-Srinagar Education Society (DJSES)</em></p>
                        <p className="hero-lead">
                            A joyful place to learn, grow and serve — nurturing young minds through knowledge, character, faith and enduring values.
                        </p>
                        <div className="hero-actions">
                            <a className="btn btn-light-premium" href="#story">Explore Our School <i className="fa-solid fa-arrow-down ms-2"></i></a>
                            <a className="btn btn-ghost" href="javascript:void(0);">Admission Enquiry <i className="fa-solid fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div className="row g-2 mt-5 hero-stats">
                    {displayStats.map((stat, i) => (
                        <div key={stat.id || i} className="col-6 col-md-3">
                            <Link href={stat.link || `/facilities#${stat.slug}`} className="text-decoration-none text-white d-block h-100">
                                <div className="stat-card transition-all">
                                    <strong title={stat.title}>{stat.title}</strong>
                                    <span>Read More <i className="fa-solid fa-arrow-right ms-2"></i></span>
                                </div>
                            </Link>
                        </div>
                    ))}
                </div>
            </div>

            <div className="hero-slider-controls">
                <div className="slide-fraction" id="slideFraction">{`1/${totalSlides}`}</div>
                <div className="carousel-indicators custom-dots">
                    {imagesList.map((_, i) => (
                        <button key={i} type="button" data-bs-target="#heroCarousel" data-bs-slide-to={i}
                            className={i === 0 ? 'active' : ''} aria-current={i === 0 ? 'true' : 'false'} aria-label={`Slide ${i + 1}`}></button>
                    ))}
                </div>
            </div>
            <div className="scroll-cue"><i className="fa-solid fa-arrow-down me-2"></i> Scroll to explore</div>
        </header>
    );
}
