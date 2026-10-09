import { useEffect } from 'react';
import { Head } from '@inertiajs/react';
import panel from '../Constants/panel';
import NoticeBar from '../Components/NoticeBar';
import Navbar from '../Components/Navbar';
import HeroSlider from '../Components/HeroSlider';
import AboutSection from '../Components/AboutSection';
import LeadershipMessages from '../Components/LeadershipMessages';
import FacilitiesSection from '../Components/FacilitiesSection';
import VisionMissionSection from '../Components/VisionMissionSection';
import ClubsSection from '../Components/ClubsSection';
import PhotoGallerySection from '../Components/PhotoGallerySection';
import NewsEventsSection from '../Components/NewsEventsSection';
import VideoGallerySection from '../Components/VideoGallerySection';
import Footer from '../Components/Footer';
import FloatingSocial from '../Components/FloatingSocial';
import ImageModal from '../Components/ImageModal';

export default function Home({ sliders = null, sliderImages = [], notices = [], flashNews = [], newsEvents = [], galleryImages = [], videos = [], aboutus = null, facilites = [], testimoinals = [], siteTitle = null }) {
    useEffect(() => {
        // Reveal-on-scroll intersection observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Gallery modal click handler
        const handleGalleryClick = (item) => {
            const imgEl = document.getElementById('modalImage');
            const titleEl = document.getElementById('modalTitle');
            if (imgEl && item.dataset.image) imgEl.src = item.dataset.image;
            if (imgEl && item.dataset.title) imgEl.alt = item.dataset.title;
            if (titleEl && item.dataset.title) titleEl.textContent = item.dataset.title;
        };

        const galleryItems = document.querySelectorAll('.gallery-item');
        galleryItems.forEach(item => {
            item.addEventListener('click', () => handleGalleryClick(item));
        });

        return () => {
            galleryItems.forEach(item => {
                item.removeEventListener('click', () => handleGalleryClick(item));
            });
        };
    }, []);

    return (
        <>
            <Head title={siteTitle || panel.site_title} />

            <NoticeBar notices={notices || flashNews} />
            <Navbar />
            <HeroSlider sliders={sliders} sliderImages={sliderImages} />
            <AboutSection aboutus={aboutus} />
            <LeadershipMessages />
            <FacilitiesSection />
            <VisionMissionSection />
            <ClubsSection />
            <PhotoGallerySection galleryImages={galleryImages} />
            <NewsEventsSection newsEvents={newsEvents} />
            <VideoGallerySection videos={videos} />
            <Footer />
            <FloatingSocial />
            <ImageModal />
        </>
    );
}
