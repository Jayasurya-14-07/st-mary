@extends('frontend.layouts.subpage')
@section('title', $page->title)
@section('content')

<section class="page-banner text-center">
    <div class="container position-relative z-10">
        @php
            $title = $page->title ?? $breadcrumbTitle ?? 'About Us';
        @endphp
        <h1 class="sub-page-title mb-3" data-aos="fade-down">
            {{ $title }}
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0" data-aos="fade-up" data-aos-delay="100">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                @if (!empty($breadcrumbs) && count($breadcrumbs))
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if (!$loop->last)
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb['url'] ?? '#' }}">
                                    {{ $breadcrumb['name'] }}
                                </a>
                            </li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $breadcrumb['name'] }}
                            </li>
                        @endif
                    @endforeach
                @endif
            </ol>
        </nav>
    </div>
</section>

<section class="bg-white subpage">
        <div class="container py-5">
            <div class="row">
                @if (($page->slug ?? null) === 'registration')
                    @include('frontend.partials.registration-form')
                @endif

                @if (!empty($page->content))
                    @foreach ($page->content as $block)
                        <div class="block-item"> {{-- Added margin-bottom for spacing --}}
                            @php
                                $dataBlock = $block['data'];
                                $content = data_get($dataBlock, 'content');
                                $alt = data_get($dataBlock, 'alt');
                                $url = data_get($dataBlock, 'url');
                                $level = data_get($dataBlock, 'level');
                                $type = data_get($dataBlock, 'type');
                                $title = data_get($dataBlock, 'title');

                                // Convert video URL if necessary
                                if ($block['type'] === 'video' && !empty($url)) {
                                    if (str_contains($url, 'youtu.be')) {
                                        $url = str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
                                    } elseif (str_contains($url, 'vimeo.com')) {
                                        $url = str_replace('vimeo.com/', 'player.vimeo.com/video/', $url);
                                    }
                                }
                            @endphp

                            @switch($block['type'])
                                @case('heading')
                                    <div class="mb-3">
                                        {!! "<$level class='section-heading'>$content</$level>" !!}
                                    </div>
                                @break

                                @case('Rich Editor')
                                @case('Tip tap editor')
                                @case('TipTap Editor')
                                @case('tiptap')
                                    <div class="content-text tiptap-content">
                                        {!! \App\Helpers\Common::renderRichContent($content) !!}
                                    </div>
                                    @break

                                @case('image')
                                    @if ($url)
                                        <div class="mb-3">
                                            <a href="{{ asset("storage/$url") }}" class="popup-image">
                                                <img src="{{ asset("storage/$url") }}" class="img-fluid" alt="{{ $alt }}">
                                            </a>
                                        </div>
                                    @endif
                                @break

                                @case('Custom Grid')
                                    @php
                                        $columns = data_get($block, 'data.columns', '2');
                                        $items = data_get($block, 'data.items', []);
                                        $colClass = 'col-md-6';
                                        if ($columns == '3') $colClass = 'col-md-4';
                                        if ($columns == '4') $colClass = 'col-md-3';
                                    @endphp
                                    @if (!empty($items))
                                        <div class="row mb-3">
                                            @foreach ($items as $item)
                                                <div class="{{ $colClass }} mb-3">
                                                    <div class="grid-item">
                                                        @if (!empty($item['image']))
                                                            <img src="{{ asset('storage/'.$item['image']) }}" class="img-fluid mb-2 rounded" alt="{{ $item['title'] ?? '' }}">
                                                        @endif
                                                        @if (!empty($item['title']))
                                                            <h5 class="fw-bold">{{ $item['title'] }}</h5>
                                                        @endif
                                                        @if (!empty($item['content']))
                                                            <div class="grid-content">{!! $item['content'] !!}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @break

                                @case('video')
                                    @php
                                        $responsive = data_get($block, 'data.responsive', true);
                                        $width = data_get($block, 'data.width', 16);
                                        $height = data_get($block, 'data.height', 9);
                                        $autoplay = data_get($block, 'data.autoplay', false);
                                        $loop = data_get($block, 'data.loop', false);
                                        $controls = data_get($block, 'data.controls', true);
                                        
                                        $finalUrl = $url;
                                        if ($finalUrl) {
                                            $separator = str_contains($finalUrl, '?') ? '&' : '?';
                                            $autoplayVal = $autoplay ? 1 : 0;
                                            $loopVal = $loop ? 1 : 0;
                                            $controlsVal = $controls ? 1 : 0;
                                            $finalUrl .= "{$separator}autoplay={$autoplayVal}&loop={$loopVal}&controls={$controlsVal}";
                                            
                                            if ($loop && str_contains($finalUrl, 'youtube.com/embed/')) {
                                                $pathParts = explode('/', parse_url($finalUrl, PHP_URL_PATH));
                                                $videoId = end($pathParts);
                                                if ($videoId) $finalUrl .= "&playlist={$videoId}";
                                            }
                                        }
                                    @endphp
                                    @if ($finalUrl)
                                        <div class="mb-3" style="{{ $responsive ? '' : "max-width: {$width}px; margin: 0 auto;" }}">
                                            <div class="{{ $responsive ? 'tiptap-video-wrapper' : '' }}" style="{{ $responsive ? '' : "aspect-ratio: {$width}/{$height};" }}">
                                                <iframe src="{{ $finalUrl }}" 
                                                    allowfullscreen 
                                                    @if($autoplay) allow="autoplay" @endif
                                                    width="100%" 
                                                    height="{{ $responsive ? '100%' : 'auto' }}"
                                                    style="border-radius: 8px; border: none;">
                                                </iframe>
                                            </div>
                                        </div>
                                    @endif
                                @break

                                {{-- Image Carousel with Popup --}}
                                @case('Image Carousel')
                                    @php
                                        $images = data_get($block, 'data.images', []);
                                    @endphp

                                    @if (!empty($images))
                                        <div class="owl-carousel owl-theme">
                                            @foreach ($images as $imageSet)
                                                @foreach ($imageSet['url'] as $image)
                                                    <div class="item">
                                                        <a href="{{ asset("storage/$image") }}" class="popup-image">
                                                            <img src="{{ asset("storage/$image") }}" class="img-fluid"
                                                                alt="{{ $imageSet['alt'] ?? 'Image' }}">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    @endif
                                @break

                                {{-- Iframe PDF Viewer --}}
                                @case('iframe')
                                    @if ($url)
                                        <div class="mb-3">
                                            <iframe src="{{ $url }}" width="100%" height="600px"
                                                style="border: none;"></iframe>
                                        </div>
                                    @endif
                                @break

                                {{-- Button --}}
                                @case('button')
                                    @if ($url)
                                        <div class="mb-3">
                                            <a href="{{ $url }}" class="btn btn-primary"
                                                @if (data_get($dataBlock, 'open_in_new_tab')) target="_blank" @endif>{{ data_get($dataBlock, 'text', 'Click Here') }}</a>

                                        </div>
                                    @endif
                                @break

                                {{-- Accordian --}}
                                @case('accordion')
                                    @php
                                        $accordionItems = data_get($block, 'data.items', []);
                                        $accordionId = 'page-accordion-' . $loop->index;
                                    @endphp
                                    @if (!empty($accordionItems))
                                        <div class="accordion content-block-accordion" id="{{ $accordionId }}">
                                            @foreach ($accordionItems as $index => $item)
                                                @php
                                                    $itemTitle = data_get($item, 'title', 'Untitled');
                                                    $itemContent = data_get($item, 'content', '');
                                                    $tabs = data_get($item, 'tabs', []);
                                                    $carousel = data_get($item, 'carousel', []);
                                                @endphp
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ $index }}"
                                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                            aria-controls="collapse{{ $index }}">
                                                            {{ $itemTitle }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse{{ $index }}"
                                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                        aria-labelledby="heading{{ $index }}"
                                                        data-bs-parent="#{{ $accordionId }}">
                                                        <div class="accordion-body">
                                                            <div class="tiptap-content">
                                                                {!! \App\Helpers\Common::renderRichContent($itemContent) !!}
                                                            </div>

                                                            {{-- Tabs inside Accordion --}}
                                                            @if (!empty($tabs))
                                                                <ul class="nav nav-tabs content-block-tabs-nav mt-3"
                                                                    id="{{ $accordionId }}-tabs-{{ $index }}" role="tablist">
                                                                    @foreach ($tabs as $tIndex => $tab)
                                                                        <li class="nav-item" role="presentation">
                                                                            <button
                                                                                class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                                                id="tab-{{ $index }}-{{ $tIndex }}-tab"
                                                                                data-bs-toggle="tab"
                                                                                data-bs-target="#tab-{{ $index }}-{{ $tIndex }}"
                                                                                type="button" role="tab"
                                                                                aria-controls="tab-{{ $index }}-{{ $tIndex }}"
                                                                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                                                {{ data_get($tab, 'title', 'Tab') }}
                                                                            </button>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                <div class="tab-content"
                                                                    id="accordionTabsContent-{{ $index }}">
                                                                    @foreach ($tabs as $tIndex => $tab)
                                                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                                            id="tab-{{ $index }}-{{ $tIndex }}"
                                                                            role="tabpanel"
                                                                            aria-labelledby="tab-{{ $index }}-{{ $tIndex }}-tab">
                                                                            <div class="tiptap-content">
                                                                                {!! \App\Helpers\Common::renderRichContent(data_get($tab, 'content', '')) !!}
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif

                                                            {{-- Carousel inside Accordion --}}
                                                            @if (!empty($carousel))
                                                                <div class="owl-carousel owl-theme mt-4">
                                                                    @foreach ($carousel as $cIndex => $imageSet)
                                                                        <div class="item">
                                                                            @foreach ($imageSet['images'] ?? [] as $image)
                                                                                <a href="{{ asset('storage/' . ($image['url'] ?? '')) }}"
                                                                                    class="popup-image me-2">
                                                                                    <img src="{{ asset('storage/' . ($image['url'] ?? '')) }}"
                                                                                        class="img-fluid"
                                                                                        alt="{{ $image['alt'] ?? 'Image' }}">
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @break

                                {{-- Tabs --}}
                                @case('tabs')
                                    @php
                                        $tabItems = data_get($block, 'data.items', []);
                                        $tabsId = 'page-tabs-' . $loop->index;
                                        $tabsContentId = $tabsId . '-content';
                                    @endphp

                                    @if (!empty($tabItems))
                                        <ul class="nav nav-tabs content-block-tabs-nav" id="{{ $tabsId }}" role="tablist">
                                            @foreach ($tabItems as $index => $tab)
                                                @php
                                                    $tabTitle = data_get($tab, 'title', 'Untitled Tab');
                                                    $tabIndexId = $tabsId . '-' . str_replace(' ', '-', strtolower($tabTitle)) . '-' . $index;
                                                @endphp
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                        id="tab-{{ $tabIndexId }}-tab" data-bs-toggle="tab"
                                                        data-bs-target="#tab-{{ $tabIndexId }}" type="button" role="tab"
                                                        aria-controls="tab-{{ $tabIndexId }}"
                                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                        {{ $tabTitle }}
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="tab-content content-block-tabs-content" id="{{ $tabsContentId }}">
                                            @foreach ($tabItems as $index => $tab)
                                                @php
                                                    $tabContent = data_get($tab, 'content', '');
                                                    $accordionItems = data_get($tab, 'accordion', []);
                                                    $tabTitle = data_get($tab, 'title', 'Untitled Tab');
                                                    $tabIndexId = $tabsId . '-' . str_replace(' ', '-', strtolower($tabTitle)) . '-' . $index;
                                                @endphp

                                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                    id="tab-{{ $tabIndexId }}" role="tabpanel"
                                                    aria-labelledby="tab-{{ $tabIndexId }}-tab">

                                                    <div class="tiptap-content">
                                                        {!! \App\Helpers\Common::renderRichContent($tabContent) !!}
                                                    </div>

                                                    @if (!empty($accordionItems))
                                                        <div class="accordion mt-4" id="accordion-{{ $tabIndexId }}">
                                                            @foreach ($accordionItems as $aIndex => $accordion)
                                                                @php
                                                                    $heading = data_get(
                                                                        $accordion,
                                                                        'heading',
                                                                        'Heading',
                                                                    );
                                                                    $body = data_get($accordion, 'body', '');
                                                                @endphp
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header"
                                                                        id="heading-{{ $tabIndexId }}-{{ $aIndex }}">
                                                                        <button class="accordion-button collapsed" type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#collapse-{{ $tabIndexId }}-{{ $aIndex }}"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapse-{{ $tabIndexId }}-{{ $aIndex }}">
                                                                            {{ $heading }}
                                                                        </button>
                                                                    </h2>
                                                                    <div id="collapse-{{ $tabIndexId }}-{{ $aIndex }}"
                                                                        class="accordion-collapse collapse"
                                                                        aria-labelledby="heading-{{ $tabIndexId }}-{{ $aIndex }}"
                                                                        data-bs-parent="#accordion-{{ $tabIndexId }}">
                                                                        <div class="accordion-body">
                                                                            <div class="tiptap-content">
                                                                                {!! \App\Helpers\Common::renderRichContent($body) !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @break

                                @default
                                    <div>{{ 'Block type not recognized.' }}</div>
                            @endswitch
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/pageblade.css') }}">
    @if (($page->slug ?? null) === 'registration')
        <style>
            .registration-section {
                background: #f7fbff;
                padding: 10px 0 35px;
                width: 100%;
            }

            .registration-shell {
                background: #fff;
                border: 1px solid #d8e6f4;
                border-radius: 8px;
                padding: 34px;
                width: 100%;
            }

            .registration-shell h3 {
                color: #292962;
                font-size: 20px;
                font-weight: 800;
                margin: 0 0 22px;
            }

            .registration-shell h3:not(:first-of-type) {
                margin-top: 34px;
            }

            .registration-shell .form-label {
                color: #292962;
                font-size: 14px;
                font-weight: 700;
                margin-bottom: 7px;
            }

            .registration-shell .form-label span {
                color: #dc3545;
            }

            .registration-shell .form-control,
            .registration-shell .form-select {
                border: 1px solid #c9d6e3;
                border-radius: 6px;
                box-shadow: none;
                min-height: 48px;
            }

            .registration-shell textarea.form-control {
                min-height: 112px;
            }

            .registration-shell .form-control:focus,
            .registration-shell .form-select:focus {
                border-color: #292962;
                box-shadow: 0 0 0 .2rem rgba(41, 41, 98, .12);
            }

            .registration-submit-btn {
                background: #1c9ccd;
                border: 0;
                border-radius: 6px;
                color: #fff;
                font-weight: 800;
                min-height: 48px;
                padding: 0 30px;
            }

            .registration-submit-btn:disabled {
                opacity: .7;
            }

            .registration-field-error {
                color: #dc3545;
                font-size: 14px;
                font-weight: 600;
                margin-top: 8px;
            }

            .registration-popup {
                align-items: center;
                background: rgba(17, 24, 39, .5);
                display: flex;
                inset: 0;
                justify-content: center;
                padding: 20px;
                position: fixed;
                z-index: 9999;
            }

            .registration-popup.d-none {
                display: none;
            }

            .registration-popup-card {
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 24px 70px rgba(17, 24, 39, .24);
                max-width: 420px;
                padding: 34px 28px;
                text-align: center;
                width: min(100%, 420px);
            }

            .registration-popup-icon {
                align-items: center;
                background: #20b86d;
                border-radius: 999px;
                color: #fff;
                display: inline-flex;
                font-size: 34px;
                font-weight: 900;
                height: 70px;
                justify-content: center;
                line-height: 1;
                margin-bottom: 18px;
                width: 70px;
            }

            .registration-popup-card h4 {
                color: #292962;
                font-size: 24px;
                font-weight: 800;
                margin: 0 0 10px;
            }

            .registration-popup-card p {
                color: #526173;
                font-size: 16px;
                line-height: 1.6;
                margin: 0;
            }

            @media (max-width: 767.98px) {
                .registration-shell {
                    padding: 26px 18px;
                }
            }
        </style>
    @endif
@endpush

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: false, // Disable navigation arrows
                dots: false, // Disable dots pagination
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });

            // Magnific Popup for Image Lightbox
            $('.popup-image').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    </script>

    @if (($page->slug ?? null) === 'registration')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('registrationForm');

                if (!form) {
                    return;
                }

                const submitBtn = document.getElementById('registrationSubmitBtn');
                const alertBox = document.getElementById('registrationAlert');
                const recaptchaError = document.getElementById('registrationRecaptchaError');
                const successPopup = document.getElementById('registrationSuccessPopup');
                const successMessage = document.getElementById('registrationSuccessMessage');
                const originalButtonText = submitBtn.textContent;
                let alertTimer = null;
                let successTimer = null;

                const showAlert = function(type, message) {
                    alertBox.className = 'alert alert-' + type;
                    alertBox.textContent = message;
                    alertBox.classList.remove('d-none');

                    clearTimeout(alertTimer);
                    alertTimer = setTimeout(function() {
                        alertBox.classList.add('d-none');
                        alertBox.textContent = '';
                    }, 6000);
                };

                const clearRecaptchaError = function() {
                    recaptchaError.textContent = '';
                    recaptchaError.classList.add('d-none');
                };

                const showRecaptchaError = function(message) {
                    recaptchaError.textContent = message;
                    recaptchaError.classList.remove('d-none');
                };

                const showSuccessPopup = function(message) {
                    successMessage.textContent = message;
                    successPopup.classList.remove('d-none');

                    clearTimeout(successTimer);
                    successTimer = setTimeout(function() {
                        successPopup.classList.add('d-none');
                    }, 6000);
                };

                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    clearRecaptchaError();

                    if (window.grecaptcha && !grecaptcha.getResponse()) {
                        showRecaptchaError('Please complete the reCAPTCHA verification.');
                        return;
                    }

                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Registering...';

                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: new FormData(form),
                    })
                        .then(async function(response) {
                            const data = await response.json();

                            if (!response.ok) {
                                if (data.errors && data.errors['g-recaptcha-response']) {
                                    showRecaptchaError(data.errors['g-recaptcha-response'][0]);
                                    throw new Error('');
                                }

                                if (data.recaptcha_error) {
                                    showRecaptchaError(data.message || 'reCAPTCHA verification failed. Please try again.');
                                    throw new Error('');
                                }

                                const errors = data.errors ? Object.values(data.errors).flat().join('\n') : data.message;
                                throw new Error(errors || 'Something went wrong. Please try again.');
                            }

                            showSuccessPopup(data.message || 'Your registration has been submitted successfully!');
                            form.reset();

                            if (window.grecaptcha) {
                                grecaptcha.reset();
                            }
                        })
                        .catch(function(error) {
                            if (error.message) {
                                showAlert('danger', error.message);
                            }

                            if (window.grecaptcha) {
                                grecaptcha.reset();
                            }
                        })
                        .finally(function() {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalButtonText;
                        });
                });
            });
        </script>
    @endif

@endpush
