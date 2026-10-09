@php
    $mainMenus = \App\Helpers\Common::getMenus();
    $currentPath = trim(request()->path(), '/');

    $isMenuActive = function ($menu) use (&$isMenuActive, $currentPath): bool {
        $url = \App\Helpers\Common::getMenuUrl($menu);
        $path = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');

        if ($path !== '' && $path !== '#' && ($currentPath === $path || \Illuminate\Support\Str::startsWith($currentPath, $path . '/'))) {
            return true;
        }

        if ($menu->allChildren && $menu->allChildren->isNotEmpty()) {
            foreach ($menu->allChildren as $child) {
                if ($isMenuActive($child)) {
                    return true;
                }
            }
        }

        return false;
    };
@endphp

<div class="top-bar">
    <div class="container-fluid top-bar-inner">
        <div class="top-bar-left">
            <span class="top-info-item"><i class="ri-phone-fill"></i> +91 93538 60013</span>
            <span class="top-info-item"><i class="ri-mail-fill"></i> admitdbrc@gmail.com</span>
            <span class="top-info-item"><i class="ri-map-pin-2-fill"></i> Bangalore – 560 076, India</span>
        </div>

        <div class="top-header-schedule" aria-label="Course schedule announcement">
            <div class="schedule-pill"><i class="ri-calendar-schedule-line"></i> Course Schedule 2025 – 2026</div>
            <div class="schedule-marquee" aria-hidden="true">
                <div class="schedule-track">
                    <span>Personal Growth and Renewal</span>
                    <span>Animation of Lay Mission Partners</span>
                    <span>Preparation for the Salesian Rector</span>
                    <span>Renewal Course and Retreat for Silver Jubilarians</span>
                    <span>Counselling Skills and Practice</span>
                    <span>Spiritual Direction and Pastoral Accompaniment</span>
                    <span>Guided Retreat</span>
                    <span>Formation of Formators</span>
                    <span>Preparation for Final Vows</span>
                    <span>Animation of Young Salesian Priests and Brothers</span>
                    <span>Personal Growth and Renewal</span>
                    <span>Animation of Lay Mission Partners</span>
                    <span>Preparation for the Salesian Rector</span>
                    <span>Renewal Course and Retreat for Silver Jubilarians</span>
                    <span>Counselling Skills and Practice</span>
                    <span>Spiritual Direction and Pastoral Accompaniment</span>
                    <span>Guided Retreat</span>
                    <span>Formation of Formators</span>
                    <span>Preparation for Final Vows</span>
                    <span>Animation of Young Salesian Priests and Brothers</span>
                </div>
            </div>
        </div>

        <div class="top-bar-right">
            <span class="top-divider">|</span>
            <div class="top-socials">
                <a href="https://facebook.com" target="_blank" aria-label="Facebook" class="top-social-btn"><i
                        class="ri-facebook-fill"></i></a>
                <a href="https://instagram.com" target="_blank" aria-label="Instagram" class="top-social-btn"><i
                        class="ri-instagram-line"></i></a>
                <a href="https://youtube.com" target="_blank" aria-label="YouTube" class="top-social-btn"><i
                        class="ri-youtube-fill"></i></a>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-xl sticky-top" id="navbar">
    <div class="container-fluid nav-container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('frontend/logo/logo.png') }}" alt="Don Bosco Renewal Centre Logo">
            <div class="brand-text">
                <span class="brand-name-main">DON BOSCO RENEWAL CENTRE</span>
                <span class="brand-name-sub">— Bangalore —</span>
                <span class="brand-name-affil">(Formerly known as DON BOSCO YUVA PRACHODINI)</span>
            </div>
            <img src="{{ asset('frontend/logo/logo2.png') }}" alt="DBRC Logo"
                class="brand-logo-secondary d-none d-sm-block">
        </a>
        <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas"
            aria-label="Toggle navigation">
            <span class="burger-menu"><span></span><span></span><span></span></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-center">
                @if($mainMenus->isNotEmpty())
                    @foreach($mainMenus as $menu)
                        @php
                            $hasChildren = $menu->allChildren && $menu->allChildren->isNotEmpty();
                            $url = \App\Helpers\Common::getMenuUrl($menu);
                            $target = ($menu->is_url && $menu->target) ? $menu->target : '_self';
                            $active = $isMenuActive($menu) ? 'active' : '';
                        @endphp

                        @if($hasChildren)
                            <li class="nav-item dropdown">
                                <a href="{{ $url }}" class="nav-link dropdown-toggle {{ $active }}" @if($menu->is_url && $target !== '_self') target="{{ $target }}" rel="noopener noreferrer" @endif>
                                    {{ $menu->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($menu->allChildren as $child)
                                        @php
                                            $childHasChildren = $child->allChildren && $child->allChildren->isNotEmpty();
                                            $childUrl = \App\Helpers\Common::getMenuUrl($child);
                                            $childTarget = ($child->is_url && $child->target) ? $child->target : '_self';
                                            $childActive = $isMenuActive($child) ? 'active' : '';
                                        @endphp
                                        @if($childHasChildren)
                                            <li class="dropdown-submenu">
                                                <a class="dropdown-item dropdown-toggle {{ $childActive }}" href="{{ $childUrl }}" @if($child->is_url && $childTarget !== '_self') target="{{ $childTarget }}" rel="noopener noreferrer" @endif>
                                                    {{ $child->name }}
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @foreach($child->allChildren as $subChild)
                                                        @php
                                                            $subChildUrl = \App\Helpers\Common::getMenuUrl($subChild);
                                                            $subChildTarget = ($subChild->is_url && $subChild->target) ? $subChild->target : '_self';
                                                        @endphp
                                                        <li>
                                                            <a class="dropdown-item {{ $isMenuActive($subChild) ? 'active' : '' }}" href="{{ $subChildUrl }}" @if($subChild->is_url && $subChildTarget !== '_self') target="{{ $subChildTarget }}" rel="noopener noreferrer" @endif>
                                                                {{ $subChild->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a class="dropdown-item {{ $childActive }}" href="{{ $childUrl }}" @if($child->is_url && $childTarget !== '_self') target="{{ $childTarget }}" rel="noopener noreferrer" @endif>
                                                    {{ $child->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ $url }}" class="nav-link {{ $active }}" @if($menu->is_url && $target !== '_self') target="{{ $target }}" rel="noopener noreferrer" @endif>
                                    {{ $menu->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @else
                    {{-- Default fallback when DB menus are empty --}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle">About Us</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Our Centre</a></li>
                            <li><a class="dropdown-item" href="#">Director's Message</a></li>
                            <li><a class="dropdown-item" href="#">Vision &amp; Mission</a></li>
                            <li><a class="dropdown-item" href="#">Management</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Faculty</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Facilities</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Registration</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Courses</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Alumni</a></li>
                    <li class="nav-item"><a href="{{ url('contact-us') }}" class="nav-link">Contact Us</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="responsive-navbar offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvas">
    <div class="offcanvas-header">
        <a href="{{ url('/') }}"><img src="{{ asset('frontend/logo/logo-phone.png') }}" alt="logo"
                style="height:48px;"></a>
        <button type="button" class="close-btn" data-bs-dismiss="offcanvas"><i class="ri-close-line"></i></button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion" id="mobileNav">
            @if($mainMenus->isNotEmpty())
                @foreach($mainMenus as $menu)
                    @php
                        $hasChildren = $menu->allChildren && $menu->allChildren->isNotEmpty();
                        $url = \App\Helpers\Common::getMenuUrl($menu);
                        $target = ($menu->is_url && $menu->target) ? $menu->target : '_self';
                        $collapseId = 'mob-menu-' . $menu->id;
                    @endphp

                    @if($hasChildren)
                        <div class="accordion-item border-0 mb-3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#{{ $collapseId }}">
                                {{ $menu->name }}
                            </button>
                            <div id="{{ $collapseId }}" class="accordion-collapse collapse" data-bs-parent="#mobileNav">
                                <div class="accordion-body">
                                    @foreach($menu->allChildren as $child)
                                        @php
                                            $childHasChildren = $child->allChildren && $child->allChildren->isNotEmpty();
                                            $childUrl = \App\Helpers\Common::getMenuUrl($child);
                                            $childTarget = ($child->is_url && $child->target) ? $child->target : '_self';
                                        @endphp
                                        @if($childHasChildren)
                                            <div class="nested-mobile-menu ps-2 mb-2">
                                                <strong class="d-block py-1 text-primary">{{ $child->name }}</strong>
                                                @foreach($child->allChildren as $subChild)
                                                    @php
                                                        $subChildUrl = \App\Helpers\Common::getMenuUrl($subChild);
                                                        $subChildTarget = ($subChild->is_url && $subChild->target) ? $subChild->target : '_self';
                                                    @endphp
                                                    <a href="{{ $subChildUrl }}" class="ps-2 py-1 d-block" @if($subChild->is_url && $subChildTarget !== '_self') target="{{ $subChildTarget }}" rel="noopener noreferrer" @endif>
                                                        {{ $subChild->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <a href="{{ $childUrl }}" @if($child->is_url && $childTarget !== '_self') target="{{ $childTarget }}" rel="noopener noreferrer" @endif>
                                                {{ $child->name }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="accordion-item border-0 mb-3">
                            <a class="accordion-button without-icon" href="{{ $url }}" @if($menu->is_url && $target !== '_self') target="{{ $target }}" rel="noopener noreferrer" @endif>
                                {{ $menu->name }}
                            </a>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="accordion-item border-0 mb-3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mob-about">About Us</button>
                    <div id="mob-about" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <a href="#">Our Centre</a><br>
                            <a href="#">Director's Message</a><br>
                            <a href="#">Vision &amp; Mission</a><br>
                            <a href="#">Management</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-3"><a class="accordion-button without-icon" href="#">Faculty</a></div>
                <div class="accordion-item border-0 mb-3"><a class="accordion-button without-icon" href="#">Facilities</a></div>
                <div class="accordion-item border-0 mb-3"><a class="accordion-button without-icon" href="#">Registration</a></div>
                <div class="accordion-item border-0 mb-3"><a class="accordion-button without-icon" href="#">Courses</a></div>
                <div class="accordion-item border-0 mb-3"><a class="accordion-button without-icon" href="#">Alumni</a></div>
                <div class="accordion-item border-0 mb-3"><a class="accordion-button without-icon" href="{{ url('contact-us') }}">Contact Us</a></div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Multi-level Dropdown Styling for Desktop */
    .navbar .dropdown-submenu {
        position: relative;
    }
    .navbar .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: 0;
        display: none;
    }
    .navbar .dropdown-submenu:hover > .dropdown-menu {
        display: block;
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .navbar .dropdown-submenu > .dropdown-item::after {
        content: '\ea6e';
        font-family: 'remixicon';
        float: right;
        font-size: 13px;
        margin-left: 10px;
    }
</style>
