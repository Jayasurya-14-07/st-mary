@extends('frontend.layouts.subpage')
@section('title', 'Media Gallery')
@section('content')

    <section class="page-banner text-center text-white">
        <div class="container position-relative z-10">
            <h2 class="display-4 sub-page-title mb-3" data-aos="fade-down">Gallery</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0" data-aos="fade-up" data-aos-delay="100">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-5">
            @if ($galleries->count() > 0)
                <div class="row g-4">
                    @foreach ($galleries as $gallery)
                        @php
                            $coverImage = $gallery->images->first();
                            $coverUrl = $coverImage?->url
                                ?? ($coverImage?->path ? asset('storage/' . ltrim($coverImage->path, '/')) : null);
                        @endphp

                        <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                            <a href="{{ route('gallery.show', $gallery->slug) }}"
                                class="gallery-album-card d-block text-decoration-none text-dark">
                                <div class="gallery-album-image">
                                    @if ($coverUrl)
                                        <img src="{{ $coverUrl }}" alt="{{ $gallery->title }}">
                                    @else
                                        <div class="gallery-album-empty">
                                            <i class="fa fa-images"></i>
                                        </div>
                                    @endif
                                    <div class="gallery-album-overlay">
                                        <i class="fa fa-folder-open"></i>
                                    </div>
                                </div>
                                <div class="gallery-album-body">
                                    <h3>{{ $gallery->title }}</h3>
                                    <p>{{ $gallery->images->count() }} Images</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <div class="text-muted mb-3">
                            <i class="fa fa-images" style="font-size:58px;"></i>
                        </div>
                        <h3>No albums found</h3>
                        <p>We haven't added any photos yet. Please check back later.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <style>
        .gallery-album-card {
            border: 1px solid #e5e5e5;
            background: #fff;
            overflow: hidden;
            transition: box-shadow .25s ease, transform .25s ease;
        }

        .gallery-album-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(0, 0, 0, .14);
        }

        .gallery-album-image {
            position: relative;
            height: 250px;
            background: #f3f3f3;
            overflow: hidden;
        }
        .gallery-album-body h3 a {
            text-decoration: none !important;
            color: inherit;
        }
        .gallery-album-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .35s ease;
        }

        .gallery-album-card:hover .gallery-album-image img {
            transform: scale(1.06);
        }

        .gallery-album-empty,
        .gallery-album-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-album-empty {
            color: #aaa;
            font-size: 44px;
        }

        .gallery-album-overlay {
            background: rgba(6, 29, 48, .42);
            color: #fff;
            font-size: 32px;
            opacity: 0;
            transition: opacity .25s ease;
        }

        .gallery-album-card:hover .gallery-album-overlay {
            opacity: 1;
        }

        .gallery-album-body {
            padding: 16px;
        }

        .gallery-album-body h3 {
            margin: 0 0 6px;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            color: #111;
        }

        .gallery-album-body p {
            margin: 0;
            color: #666;
            font-size: 14px;
            text-align: center;
        }
    </style>
@endsection
