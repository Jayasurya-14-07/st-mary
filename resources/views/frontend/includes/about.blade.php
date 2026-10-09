<div class="tagline-banner">
    <div class="tagline-inner">
        <span class="tagline-badge"><i class="ri-award-line"></i> An International Institute of On-going
            Formation</span>
        <span class="tagline-text">Offers Courses in Ongoing Formation for <strong>Priests, Religious and
                Laity</strong></span>
        <a href="#" class="tagline-cta">Register Now <i class="ri-arrow-right-line"></i></a>
    </div>
</div>

<section class="about-vm-section" id="about">
    <div class="section-container about-three-col">
        @if ($aboutus)
            <div class="about-card reveal">
                <div class="section-label">WHO WE ARE</div>
                <h2 class="section-heading">About Us</h2>
                <p class="about-body">
                    {!! $aboutus->excerpt !!}
                </p>
                <a href="{{ url('about-us') }}" class="btn-primary-dbrc">Read More <i
                        class="ri-arrow-right-line"></i></a>
            </div>
        @endif

        <div class="about-img-col reveal">
            @if ($aboutus)
                <div class="about-dual-images">
                    <div class="about-img-box img-primary">
                        <img src="{{ asset('storage/' . $aboutus->feature_image) }}" alt="Don Bosco Renewal Centre">
                        <div class="about-img-shine"></div>
                    </div>

                    <div class="about-img-box img-secondary">
                        <img src="{{ asset('storage/' . $aboutus->feature_image_new) }}"
                            alt="Don Bosco Renewal Centre Formation">
                        <div class="about-img-shine"></div>
                    </div>
                    <div class="about-floating-badge">
                        <div class="badge-icon-wrap">
                            <i class="ri-shield-check-line"></i>
                        </div>
                        <div class="badge-text-wrap">
                            <span class="badge-title">Ongoing Formation</span>
                            <span class="badge-subtitle">National Training Centre</span>
                        </div>
                    </div>
                    <div class="about-bg-ring"></div>
                </div>
            @endif
        </div>

        <div class="vm-stack reveal">
            <div class="vm-card vm-vision">
                <div class="vm-icon"><i class="ri-eye-line"></i></div>
                <h3 class="vm-title">Our Vision</h3>
                <p class="vm-text">A Church led and served by freer, happier, more human Christ-like priests and
                    religious
                    who will share God's tender love with today's women, men, youth and children, especially the
                    least and
                    the lost.</p>
            </div>
            <div class="vm-card vm-mission">
                <div class="vm-icon"><i class="ri-focus-3-line"></i></div>
                <h3 class="vm-title">Our Mission</h3>
                <p class="vm-text">To help priests, religious and other committed ministers in their personal and
                    professional update, through a clarification of their vision and ideals, healing of inner wounds
                    and
                    blocks, and finding new strength and meaning for their onward journey.</p>
            </div>
        </div>
    </div>
</section>
