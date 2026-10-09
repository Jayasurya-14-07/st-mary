@php
    $sliderImages = collect();

    if (isset($sliders) && $sliders) {
        $records = $sliders instanceof \Illuminate\Support\Collection || is_array($sliders)
            ? $sliders
            : [$sliders];

        foreach ($records as $record) {
            if (!$record) {
                continue;
            }

            $images = is_array($record->image) ? $record->image : [$record->image];

            foreach ($images as $img) {
                if (is_array($img)) {
                    $img = $img['url'] ?? $img['path'] ?? collect($img)->first();
                }

                if (empty($img)) {
                    continue;
                }

                $sliderImages->push(
                    \Illuminate\Support\Str::startsWith($img, ['http://', 'https://'])
                        ? $img
                        : asset('storage/' . ltrim($img, '/'))
                );
            }
        }
    }
@endphp

<section class="hero-slider-section">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">

            @forelse($sliderImages as $imageUrl)
                <div class="swiper-slide hero-slide" style="background-image: url('{{ $imageUrl }}');">
                </div>
            @empty
                {{-- Fallback default images --}}
                <div class="swiper-slide hero-slide"
                    style="background-image: url('{{ asset('frontend/images/slider/slider-1.jpg') }}');">
                </div>
                <div class="swiper-slide hero-slide"
                    style="background-image: url('{{ asset('frontend/images/slider/slider-2.jpg') }}');">
                </div>
                <div class="swiper-slide hero-slide"
                    style="background-image: url('{{ asset('frontend/images/slider/slider-3.jpg') }}');">
                </div>
            @endforelse

        </div>

        {{-- Navigation --}}
        <button class="hero-nav hero-prev" type="button" aria-label="Previous slide">
            <i class="ri-arrow-left-s-line"></i>
        </button>

        <button class="hero-nav hero-next" type="button" aria-label="Next slide">
            <i class="ri-arrow-right-s-line"></i>
        </button>

        {{-- Pagination --}}
        <div class="swiper-pagination hero-pagination"></div>
    </div>
</section>
