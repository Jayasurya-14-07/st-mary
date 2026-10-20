import { useEffect, useRef } from 'react';
import { Link, usePage, router } from '@inertiajs/react';

export default function Navbar() {
    const navRef = useRef(null);
    const { url: currentUrl = '/', props = {} } = usePage();
    const dynamicMenus = props.menus || [];

    const closeMobileOffcanvas = () => {
        const offcanvasEl = document.getElementById('mobileOffcanvas');
        if (!offcanvasEl) return;

        try {
            if (window.bootstrap && window.bootstrap.Offcanvas) {
                const instance = window.bootstrap.Offcanvas.getInstance(offcanvasEl) || new window.bootstrap.Offcanvas(offcanvasEl);
                if (instance) {
                    instance.hide();
                    return;
                }
            }
        } catch (e) {
            // fallback below
        }

        const closeBtn = offcanvasEl.querySelector('.btn-close');
        if (closeBtn) {
            closeBtn.click();
        }
    };

    useEffect(() => {
        const unbind = router.on('navigate', () => {
            closeMobileOffcanvas();
        });
        return () => unbind();
    }, []);

    useEffect(() => {
        const nav = navRef.current;
        if (nav) {
            const handleScroll = () => nav.classList.toggle('scrolled', window.scrollY > 20);
            window.addEventListener('scroll', handleScroll);
            return () => window.removeEventListener('scroll', handleScroll);
        }
    }, []);

    // Helper to check if a menu path or any of its sub-children is currently active
    const isPathActive = (menuUrl) => {
        if (!menuUrl || menuUrl === '#' || menuUrl === 'javascript:void(0);') return false;
        const currentPath = currentUrl.replace(/\/$/, '') || '/';

        let targetPath = menuUrl;
        if (menuUrl.startsWith('http://') || menuUrl.startsWith('https://')) {
            try {
                targetPath = new URL(menuUrl).pathname;
            } catch (e) {
                targetPath = menuUrl;
            }
        }
        targetPath = targetPath.replace(/\/$/, '') || '/';

        if (targetPath === '/' && currentPath === '/') return true;
        if (targetPath !== '/' && (currentPath === targetPath || currentPath.startsWith(targetPath + '/'))) {
            return true;
        }
        return false;
    };

    const isMenuRecursiveActive = (menu) => {
        if (isPathActive(menu.url)) return true;
        if (Array.isArray(menu.all_children) && menu.all_children.length > 0) {
            return menu.all_children.some(child => isMenuRecursiveActive(child));
        }
        return false;
    };

    const isInternalUrl = (url, target) => {
        if (!url || url === '#' || url.startsWith('javascript:')) return false;
        if (target && target !== '_self') return false;
        if (url.startsWith('http://') || url.startsWith('https://')) {
            try {
                return new URL(url).origin === window.location.origin;
            } catch (e) {
                return false;
            }
        }
        return url.startsWith('/');
    };

    const getInternalPath = (url) => {
        if (url && (url.startsWith('http://') || url.startsWith('https://'))) {
            try {
                return new URL(url).pathname;
            } catch (e) {
                return url;
            }
        }
        return url;
    };

    const isHomeActive = currentUrl === '/' || currentUrl === '' || currentUrl.startsWith('/#');

    return (
        <>
            {/* Desktop & Main Header Navigation */}
            <nav className="navbar navbar-expand-lg sticky-top bg-white" id="mainNav" ref={navRef} style={{ zIndex: 1040 }}>
                <div className="container d-flex align-items-center justify-content-between justify-content-lg-start">
                    <Link className="navbar-brand py-0 me-0 flex-shrink-0" href="/">
                        <img src="/images/logo.png" alt="St. Mary's Convent School, Chhallan, Ramkot" className="navbar-logo-img" />
                    </Link>
                    <button
                        className="navbar-toggler border-0 shadow-none d-lg-none"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobileOffcanvas"
                        aria-controls="mobileOffcanvas"
                    >
                        <i className="fa-solid fa-bars fs-1" style={{ color: 'var(--navy)' }}></i>
                    </button>

                    <div className="collapse navbar-collapse d-none d-lg-flex align-items-center flex-grow-1" id="siteNav">
                        <ul className="navbar-nav align-items-center ms-lg-3 ms-xl-4 flex-grow-1 justify-content-between mb-0">
                            {/* Static Home Menu */}
                            <li className="nav-item">
                                <Link className={`nav-link ${isHomeActive ? 'active' : ''}`} href="/">
                                    Home
                                </Link>
                            </li>

                            {/* Dynamic Database Menus (or default fallbacks) */}
                            {dynamicMenus.length > 0 ? (
                                dynamicMenus.map((menu) => {
                                    const hasChildren = Array.isArray(menu.all_children) && menu.all_children.length > 0;
                                    const activeClass = isMenuRecursiveActive(menu) ? 'active' : '';

                                    if (hasChildren) {
                                        return (
                                            <li key={menu.id} className="nav-item dropdown">
                                                <a
                                                    className={`nav-link dropdown-toggle ${activeClass}`}
                                                    href={menu.url || '#'}
                                                    role="button"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                    target={menu.target || '_self'}
                                                >
                                                    {menu.name}
                                                </a>
                                                <ul className="dropdown-menu">
                                                    {menu.all_children.map((child) => {
                                                        const childHasChildren = Array.isArray(child.all_children) && child.all_children.length > 0;
                                                        const childActive = isMenuRecursiveActive(child) ? 'active' : '';

                                                        if (childHasChildren) {
                                                            return (
                                                                <li key={child.id} className="dropdown-submenu">
                                                                    <a
                                                                        className={`dropdown-item dropdown-toggle ${childActive}`}
                                                                        href={child.url || '#'}
                                                                        target={child.target || '_self'}
                                                                    >
                                                                        {child.name}
                                                                    </a>
                                                                    <ul className="dropdown-menu">
                                                                        {child.all_children.map((subChild) => (
                                                                            <li key={subChild.id}>
                                                                                {isInternalUrl(subChild.url, subChild.target) ? (
                                                                                    <Link
                                                                                        className={`dropdown-item ${isPathActive(subChild.url) ? 'active' : ''}`}
                                                                                        href={getInternalPath(subChild.url)}
                                                                                    >
                                                                                        {subChild.name}
                                                                                    </Link>
                                                                                ) : (
                                                                                    <a
                                                                                        className={`dropdown-item ${isPathActive(subChild.url) ? 'active' : ''}`}
                                                                                        href={subChild.url || '#'}
                                                                                        target={subChild.target || '_self'}
                                                                                    >
                                                                                        {subChild.name}
                                                                                    </a>
                                                                                )}
                                                                            </li>
                                                                        ))}
                                                                    </ul>
                                                                </li>
                                                            );
                                                        }

                                                        return (
                                                            <li key={child.id}>
                                                                {isInternalUrl(child.url, child.target) ? (
                                                                    <Link
                                                                        className={`dropdown-item ${childActive}`}
                                                                        href={getInternalPath(child.url)}
                                                                    >
                                                                        {child.name}
                                                                    </Link>
                                                                ) : (
                                                                    <a
                                                                        className={`dropdown-item ${childActive}`}
                                                                        href={child.url || '#'}
                                                                        target={child.target || '_self'}
                                                                    >
                                                                        {child.name}
                                                                    </a>
                                                                )}
                                                            </li>
                                                        );
                                                    })}
                                                </ul>
                                            </li>
                                        );
                                    }

                                    return (
                                        <li key={menu.id} className="nav-item">
                                            <a
                                                className={`nav-link ${activeClass}`}
                                                href={menu.url || '#'}
                                                target={menu.target || '_self'}
                                            >
                                                {menu.name}
                                            </a>
                                        </li>
                                    );
                                })
                            ) : (
                                /* Fallback static menus when DB menus are empty */
                                <>
                                    <li className="nav-item dropdown">
                                        <a className={`nav-link dropdown-toggle ${currentUrl.includes('about') ? 'active' : ''}`} href="#story" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            About Us
                                        </a>
                                        <ul className="dropdown-menu">
                                            <li><a className="dropdown-item" href="#story">About the School</a></li>
                                            <li><a className="dropdown-item" href="#messages">Our Principals</a></li>
                                            <li><a className="dropdown-item" href="#messages">Leadership Team</a></li>
                                            <li><a className="dropdown-item" href="#messages">Our Staff</a></li>
                                        </ul>
                                    </li>
                                    <li className="nav-item"><a className="nav-link" href="javascript:void(0);">Affiliation</a></li>
                                    <li className="nav-item"><a className="nav-link" href="#clubs">Clubs</a></li>
                                    <li className="nav-item"><a className="nav-link" href="javascript:void(0);">Sports</a></li>
                                    <li className="nav-item"><a className="nav-link" href="javascript:void(0);">Facilities</a></li>
                                    <li className="nav-item"><a className="nav-link" href="#news">News &amp; Events</a></li>
                                    <li className="nav-item">
                                        <Link className={`nav-link ${currentUrl.includes('gallery') ? 'active' : ''}`} href="/gallery">
                                            Gallery
                                        </Link>
                                    </li>
                                </>
                            )}

                            {/* Static Admission Button */}
                            <li className="nav-item flex-shrink-0">
                                <Link className={`btn btn-premium text-nowrap ${currentUrl.includes('admission') ? 'active' : ''}`} href="/admission">
                                    Admission
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            {/* Mobile Offcanvas Drawer */}
            <div className="offcanvas offcanvas-end" tabIndex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel"
                style={{ zIndex: 9999, backgroundColor: '#fff' }}>
                <div className="offcanvas-header border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                    <img src="/images/logo.png" alt="St. Mary's Convent School, Chhallan, Ramkot" style={{ height: '45px', objectFit: 'contain' }} />
                    <button type="button" className="btn-close shadow-none fs-5" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div className="offcanvas-body px-4 py-4">
                    <div className="d-lg-none mb-4 pb-4 border-bottom">
                        <Link className="btn btn-premium w-100 py-3 d-flex justify-content-center" href="/admission" onClick={closeMobileOffcanvas}>Admission Enquiry</Link>
                    </div>

                    <ul className="navbar-nav flex-column mb-4 gap-2">
                        <li className="nav-item">
                            <Link className="nav-link text-dark" href="/" onClick={closeMobileOffcanvas}>
                                Home
                            </Link>
                        </li>

                        {dynamicMenus.length > 0 ? (
                            dynamicMenus.map((menu) => {
                                const hasChildren = Array.isArray(menu.all_children) && menu.all_children.length > 0;
                                const dropdownId = `mobileDropdown-${menu.id}`;

                                if (hasChildren) {
                                    return (
                                        <li key={menu.id} className="nav-item">
                                            <a
                                                className="nav-link text-dark d-flex justify-content-between align-items-center"
                                                data-bs-toggle="collapse"
                                                href={`#${dropdownId}`}
                                                role="button"
                                                aria-expanded="false"
                                            >
                                                {menu.name} <i className="fa-solid fa-chevron-down fs-6"></i>
                                            </a>
                                            <div className="collapse ps-3 mt-1" id={dropdownId}>
                                                <ul className="nav flex-column gap-1 border-start ps-2">
                                                    {menu.all_children.map((child) => {
                                                        const childHasChildren = Array.isArray(child.all_children) && child.all_children.length > 0;
                                                        const subDropdownId = `mobileSubDropdown-${child.id}`;

                                                        if (childHasChildren) {
                                                            return (
                                                                <li key={child.id} className="nav-item">
                                                                    <a
                                                                        className="nav-link text-muted py-1 d-flex justify-content-between align-items-center small"
                                                                        data-bs-toggle="collapse"
                                                                        href={`#${subDropdownId}`}
                                                                        role="button"
                                                                        aria-expanded="false"
                                                                    >
                                                                        {child.name} <i className="fa-solid fa-chevron-down small"></i>
                                                                    </a>
                                                                    <div className="collapse ps-2 mt-1" id={subDropdownId}>
                                                                        <ul className="nav flex-column gap-1 border-start ps-2">
                                                                            {child.all_children.map((subChild) => (
                                                                                <li key={subChild.id} className="nav-item">
                                                                                    {isInternalUrl(subChild.url, subChild.target) ? (
                                                                                        <Link
                                                                                            className="nav-link text-muted py-1 small"
                                                                                            href={getInternalPath(subChild.url)}
                                                                                            onClick={closeMobileOffcanvas}
                                                                                        >
                                                                                            {subChild.name}
                                                                                        </Link>
                                                                                    ) : (
                                                                                        <a
                                                                                            className="nav-link text-muted py-1 small"
                                                                                            href={subChild.url || '#'}
                                                                                            target={subChild.target || '_self'}
                                                                                            onClick={closeMobileOffcanvas}
                                                                                        >
                                                                                            {subChild.name}
                                                                                        </a>
                                                                                    )}
                                                                                </li>
                                                                            ))}
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            );
                                                        }

                                                        return (
                                                            <li key={child.id} className="nav-item">
                                                                {isInternalUrl(child.url, child.target) ? (
                                                                    <Link
                                                                        className="nav-link text-muted py-1"
                                                                        href={getInternalPath(child.url)}
                                                                        onClick={closeMobileOffcanvas}
                                                                    >
                                                                        {child.name}
                                                                    </Link>
                                                                ) : (
                                                                    <a
                                                                        className="nav-link text-muted py-1"
                                                                        href={child.url || '#'}
                                                                        target={child.target || '_self'}
                                                                        onClick={closeMobileOffcanvas}
                                                                    >
                                                                        {child.name}
                                                                    </a>
                                                                )}
                                                            </li>
                                                        );
                                                    })}
                                                </ul>
                                            </div>
                                        </li>
                                    );
                                }

                                return (
                                    <li key={menu.id} className="nav-item">
                                        {isInternalUrl(menu.url, menu.target) ? (
                                            <Link
                                                className="nav-link text-dark"
                                                href={getInternalPath(menu.url)}
                                                onClick={closeMobileOffcanvas}
                                            >
                                                {menu.name}
                                            </Link>
                                        ) : (
                                            <a
                                                className="nav-link text-dark"
                                                href={menu.url || '#'}
                                                target={menu.target || '_self'}
                                                onClick={closeMobileOffcanvas}
                                            >
                                                {menu.name}
                                            </a>
                                        )}
                                    </li>
                                );
                            })
                        ) : (
                            /* Fallback Mobile Items */
                            <>
                                <li className="nav-item">
                                    <a className="nav-link text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileAboutDropdown" role="button">
                                        About Us <i className="fa-solid fa-chevron-down fs-6"></i>
                                    </a>
                                    <div className="collapse ps-3 mt-1" id="mobileAboutDropdown">
                                        <ul className="nav flex-column gap-1 border-start ps-2">
                                            <li className="nav-item"><a className="nav-link text-muted py-1" href="#story" onClick={closeMobileOffcanvas}>About the School</a></li>
                                            <li className="nav-item"><a className="nav-link text-muted py-1" href="#messages" onClick={closeMobileOffcanvas}>Our Principals</a></li>
                                            <li className="nav-item"><a className="nav-link text-muted py-1" href="#messages" onClick={closeMobileOffcanvas}>Leadership Team</a></li>
                                            <li className="nav-item"><a className="nav-link text-muted py-1" href="#messages" onClick={closeMobileOffcanvas}>Our Staff</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="#clubs" onClick={closeMobileOffcanvas}>Clubs</a></li>
                                <li className="nav-item"><a className="nav-link fw-bold text-dark fs-5" href="#news" onClick={closeMobileOffcanvas}>News &amp; Events</a></li>
                                <li className="nav-item">
                                    <Link className="nav-link text-dark" href="/gallery" onClick={closeMobileOffcanvas}>
                                        Gallery
                                    </Link>
                                </li>
                            </>
                        )}
                    </ul>
                </div>
            </div>
        </>
    );
}
