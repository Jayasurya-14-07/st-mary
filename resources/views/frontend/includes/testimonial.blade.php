<section class="testimonials-section" id="comments">
    <div class="section-container">
        <div class="section-header-centered reveal">
            <div class="section-label">PARTICIPANTS SPEAK</div>
            <h2 class="section-heading">Comments &amp; Testimonials</h2>
        </div>

        <!-- Swiper Carousel -->
        <div class="swiper testimonials-swiper reveal">
            <div class="swiper-wrapper">

                @foreach ($testimoinals as $testimoinal)
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="quote-icon"><i class="ri-double-quotes-l"></i></div>
                            <p class="testimonial-text">{!! $testimoinal->excerpt !!}</p>
                            <div class="testimonial-author">— {!! $testimoinal->title !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="testimonials-controls-wrap">
                <button class="testimonials-nav testimonials-prev" aria-label="Previous slide"><i
                        class="ri-arrow-left-s-line"></i></button>
                <div class="swiper-pagination testimonials-pagination"></div>
                <button class="testimonials-nav testimonials-next" aria-label="Next slide"><i
                        class="ri-arrow-right-s-line"></i></button>
            </div>
        </div>
    </div>
</section>
