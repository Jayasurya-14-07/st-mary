import NoticeBar from '../Components/NoticeBar';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';
import FloatingSocial from '../Components/FloatingSocial';
import ImageModal from '../Components/ImageModal';

/**
 * AppLayout component serves as the master layout for pages.
 * In React, `{children}` acts just like `@yield('content')` in Laravel Blade.
 */
export default function AppLayout({ children, flashNews = [] }) {
    return (
        <>
            {/* Header Components */}
            <NoticeBar flashNews={flashNews} />
            <Navbar />

            {/* Dynamic Page Content (Equivalent to @yield('content')) */}
            <main id="main-content">
                {children}
            </main>

            {/* Footer & Global Floating Elements */}
            <Footer />
            <FloatingSocial />
            <ImageModal />
        </>
    );
}
