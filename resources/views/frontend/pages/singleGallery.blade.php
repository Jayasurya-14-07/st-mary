@extends('frontend.layouts.subpage')
@section('title', $galleryItem->title)

@section('content')

<section class="page-banner text-center text-white">
    <div class="container position-relative z-10">
        <h2 class="display-4 sub-page-title mb-3">{{ $galleryItem->title }}</h2>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.pages.gallery') }}">Gallery</a></li>
                <li class="breadcrumb-item active">{{ $galleryItem->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">

        <!-- ✅ Back Button RIGHT SIDE -->
        <div class="mb-4 d-flex justify-content-end go-back">
            <a href="{{ route('frontend.pages.gallery') }}" class="back-btn">
                <i class="fa fa-arrow-left"></i> Back to Albums
            </a>
        </div>

        <!-- ✅ Gallery GRID -->
        <div class="gallery-grid">

            @foreach ($galleryImages as $image)

                @php
                    $imageUrl = $image->url 
                        ?? ($image->path ? asset('storage/' . ltrim($image->path, '/')) : null);
                @endphp

                @continue(blank($imageUrl))

                <div class="gallery-card">
                    <a href="{{ $imageUrl }}" class="gallery-item-wrapper">

                        <img src="{{ $imageUrl }}" alt="">

                        <div class="gallery-overlay">
                            <i class="fa fa-search-plus"></i>
                        </div>

                    </a>
                </div>

            @endforeach

        </div>

    </div>
</section>

@endsection


<!-- ===============================
     CSS
================================= -->
<style>
/* ===============================
   3 COLUMN GRID (PERFECT FIX)
================================= */
.go-back{
    text-align: right;
    margin-bottom: 20px;
}
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* Tablet */
@media (max-width: 992px) {
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile */
@media (max-width: 576px) {
    .gallery-grid {
        grid-template-columns: repeat(1, 1fr);
    }
}

/* ===============================
   IMAGE SAME SIZE FIX
================================= */
.gallery-card {
    width: 100%;
}

.gallery-item-wrapper {
    display: block;
    width: 100%;
    height: 260px; /* 🔥 FIXED HEIGHT */
    overflow: hidden;
    border-radius: 10px;
    position: relative;
}

/* Image FULL FIT */
.gallery-item-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* 🔥 IMPORTANT */
    transition: 0.4s;
}

/* Hover zoom */
.gallery-item-wrapper:hover img {
    transform: scale(1.08);
}

/* Overlay */
.gallery-overlay {
    position: absolute;
    inset: 0;
    background: rgba(122,18,18,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: 0.3s;
}

.gallery-overlay i {
    color: #fff;
    font-size: 28px;
}

.gallery-item-wrapper:hover .gallery-overlay {
    opacity: 1;
}

/* ===============================
   BACK BUTTON RIGHT ALIGN
================================= */
.back-btn {
    background: #1e3a8a;
    color: #fff;
    padding: 10px 18px;
    border-radius: 6px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
}

.back-btn:hover {
    background: #1e3a8a;
    color: #fff;
}

.mfp-image-holder .mfp-content {
    max-width: 700px;
}

.mfp-image-holder .mfp-figure figure {
    width: 700px;
    max-width: calc(100vw - 40px);
}

.mfp-image-holder .mfp-img {
    width: 700px;
    height: 450px;
    max-width: calc(100vw - 40px);
    max-height: calc(100vh - 120px);
    object-fit: contain;
    padding: 0;
}
</style>


<!-- ===============================
     Magnific Popup
================================= -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
$(document).ready(function () {

    $('.gallery-grid').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1]
        }
    });

});
</script>

@endpush
