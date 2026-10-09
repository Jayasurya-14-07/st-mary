@extends('frontend.layouts.subpage')
@section('title', $post->title)
@section('content')

    <section class="page-banner text-center text-white">
    <div class="container position-relative z-10">

        <h2 class="display-4 sub-page-title mb-3" data-aos="fade-down">
            {{ $post->categories->pluck('name')->join(', ') }}
        </h2>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0"
                data-aos="fade-up"
                data-aos-delay="100">

                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>

                @php
                    $categoryNames = $post->categories->pluck('name')->map(fn($item) => strtolower($item));
                @endphp

                @if($categoryNames->contains('special events') || $categoryNames->contains('upcoming events'))
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">News & Events</a>
                    </li>
                @endif

                <li class="breadcrumb-item active">
                    {{ $post->categories->pluck('name')->join(', ') }}
                </li>

            </ol>
        </nav>

    </div>
</section>

    <section class="history-content py-5 subpage">
        <div class="container">
          <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="row">
                    <div class="block-item">
                        <h2>{{ $post->title }}</h2>
                    </div>
                    <div class="news-meta-item">
                        <i class="fas fa-calendar" style="font-size:13px;"></i>
                        <span
                            style="font-size:13px;">{{ \Carbon\Carbon::parse($post->publish_date ?? $post->created_at)->format('d M, Y') }}</span>
                    </div>

                    @if (!empty($post->content))
                        @foreach ($post->content as $index => $block)
                            @php
                                $dataBlock = $block['data'];
                                $content = data_get($dataBlock, 'content');
                                $alt = data_get($dataBlock, 'alt');
                                $url = data_get($dataBlock, 'url');
                                $level = data_get($dataBlock, 'level');
                                $type = data_get($dataBlock, 'type');

                                // Convert video URL if necessary
                                if ($block['type'] === 'video' && !empty($url)) {
                                    if (str_contains($url, 'youtu.be')) {
                                        $url = str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
                                    } elseif (str_contains($url, 'vimeo.com')) {
                                        $url = str_replace('vimeo.com/', 'player.vimeo.com/video/', $url);
                                    }
                                }
                            @endphp

                            <div class="block-item">
                                @switch($block['type'])
                                    @case('heading')
                                        {!! "<$level class='section-heading'>$content</$level>" !!}
                                        <div class="block-spacer"></div>
                                    @break

                                    @case('Rich Editor')
                                    @case('Tip tap editor')
                                    @case('TipTap Editor')
                                    @case('tiptap')
                                    <div class="content-text tiptap-content mb-3">
                                        {!! \App\Helpers\Common::renderRichContent($content) !!}
                                    </div>
                                    <div class="block-spacer"></div>
                                    @break

                                    @case('image')
                                        @if ($url)
                                            <div class="mb-3">
                                                <a href="{{ asset("storage/$url") }}" class="popup-image">
                                                    <img src="{{ asset("storage/$url") }}" class="img-fluid"
                                                        alt="{{ $alt }}">
                                                </a>
                                            </div>
                                            <div class="block-spacer"></div>
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
                                            <div class="row">
                                                @foreach ($items as $item)
                                                    <div class="{{ $colClass }} mb-3">
                                                        <div class="grid-item">
                                                            @if (!empty($item['url']))
                                                                <img src="{{ asset('storage/'.$item['url']) }}" class="img-fluid mb-2 rounded" alt="{{ $item['title'] ?? '' }}">
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
                                            <div class="block-spacer"></div>
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
                                            <div class="block-spacer"></div>
                                        @endif
                                    @break

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
                                            <div class="block-spacer"></div>
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
                                            $accordionId = 'post-accordion-' . $loop->index;
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
                                            $tabsId = 'post-tabs-' . $loop->index;
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
                                                            data-bs-target="#tab-{{ $tabIndexId }}" type="button"
                                                            role="tab" aria-controls="tab-{{ $tabIndexId }}"
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
                                                    @endphp

                                                    @php
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
                                                                            <button class="accordion-button collapsed"
                                                                                type="button" data-bs-toggle="collapse"
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
        </div>
    </section>

    @endsection

    @push('scripts')

        <!-- Owl Carousel & Magnific Popup CSS -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

        <style>
            .block-item {
                padding-bottom: 20px;
                /* border-bottom: 1px solid #ddd; */
            }

            .section-heading {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .rich-text,
            .tiptap-content {
                font-size: 16px;
                line-height: 1.6;
            }

            .image-gallery {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .popup-image img {
                transition: transform 0.3s ease;
                cursor: pointer;
            }

            .popup-image img:hover {
                transform: scale(1.05);
            }

            /* Accordion Custom Styles */
            .accordion-button {
                width: 100%;
                background-color: #007bff;
                color: white;
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                padding: 15px;
                border: none;
            }

            .accordion-button:focus {
                box-shadow: none;
            }

            .accordion-button:not(.collapsed) {
                background-color: #0056b3;
                color: white;
            }

            .accordion-body {
                background-color: #f8f9fa;
                padding: 15px;
                border: 1px solid #ddd;
                border-top: none;
            }

            /* Tabs Custom Styles */
            .nav-tabs .nav-link {
                background-color: #007bff;
                color: white;
                font-weight: bold;
                padding: 10px 20px;
                border-radius: 5px 5px 0 0;
            }

            .nav-tabs .nav-link.active {
                background-color: #0056b3;
                color: white;
            }

            .nav-tabs .nav-link:hover {
                background-color: #0056b3;
                color: white;
            }

            /* Ensure tab content is justified */
            .tab-content {
                background-color: #f8f9fa;
                /* Light background */
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 0 0 5px 5px;
                text-align: justify;
                word-wrap: break-word;
                overflow-wrap: break-word;

            }

            /* Fix scrollbar issue */
            .tab-pane {
                white-space: normal !important;
                overflow-x: hidden !important;
            }
        </style>

        <!-- jQuery & Plugin JS -->
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

    @endpush
