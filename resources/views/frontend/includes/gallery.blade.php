@php
    $galleryItems = collect($galleryImages ?? [])
        ->map(function ($image) {
            $url = $image->url ?? null;

            if (blank($url) && !blank($image->path ?? null)) {
                $url = asset('storage/' . ltrim($image->path, '/'));
            }

            return [
                'url' => $url,
                'alt' => $image->alt ?? $image->title ?? $image->name ?? 'Latest event gallery',
            ];
        })
        ->filter(fn ($image) => filled($image['url']))
        ->values();
@endphp

@if ($galleryItems->isNotEmpty())
    <section id="gallery-section">
        <p>&nbsp;</p>
        <div class="container">
            <div
                style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:10px;">
                <h2 class="section-title" style="margin-bottom:0;border:none;padding:0;">LATEST EVENTS GALLERY</h2>
                <a href="{{ route('frontend.pages.gallery') }}"
                    style="display:inline-flex;align-items:center;min-height:34px;margin-left:auto;padding:0 12px;background:#ef3656;color:#fff;font-size:13px;font-weight:700;text-decoration:none;position:relative;z-index:5;">
                    View All
                </a>
                <div style="display:flex;align-items:center;gap:8px;">
                    <button id="gallery-prev" class="gallery-nav-btn" aria-label="Previous gallery page">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                    <button id="gallery-next" class="gallery-nav-btn" aria-label="Next gallery page">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-grid-wrap">
                <div class="gallery-track" id="gallery-track">
                    @foreach ($galleryItems as $image)
                        <div class="gallery-item">
                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" />
                            <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="gallery-dots" style="display:flex;gap:6px;margin-top:14px;justify-content:center;"></div>
        </div>
    </section>

    <div id="lightbox" role="dialog" aria-modal="true" aria-label="Image Lightbox">
        <button id="lightbox-close" aria-label="Close lightbox"><i class="fa fa-times"></i></button>
        <button id="lightbox-prev" aria-label="Previous image"><i class="fa fa-chevron-left"></i></button>
        <img id="lightbox-img" src="" alt="Gallery Image" />
        <button id="lightbox-next" aria-label="Next image"><i class="fa fa-chevron-right"></i></button>
    </div>
@endif
