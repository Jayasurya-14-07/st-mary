@extends('frontend.layouts.subpage')
@section('title', 'Facilities & Infrastructure')
@section('content')

    <section class="page-banner text-center text-white">
        <div class="container position-relative z-10">
            <h2 class="display-4 sub-page-title mb-3" data-aos="fade-down">
                Facilities & Infrastructure
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0" data-aos="fade-up" data-aos-delay="100">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Facilities & Infrastructure</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @foreach ($facilities as $facility)
                        <div class="news-list-item mb-5" data-aos="fade-up">
                            <div
                                class="row g-0 align-items-center bg-white rounded-4 shadow-sm overflow-hidden border transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="col-md-4 position-relative overflow-hidden"
                                    style="min-height: 250px; align-self: stretch;">
                                    <a href="{{ $facility->slug_url }}" class="d-block w-100 h-100">
                                        <img src="{{ asset('storage/' . $facility->feature_image) }}"
                                            class="position-absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-110"
                                            alt="{{ $facility->title }}">
                                    </a>
                                    <div
                                        class="position-absolute top-4 left-4 bg-db-maroon text-white px-3 py-1 rounded-pill small fw-bold shadow-lg">
                                        {{ \Carbon\Carbon::parse($facility->publish_date ?? $facility->created_at)->format('M d, Y') }}
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="p-4 p-lg-5">

                                        <h3 class="font-serif fw-bold text-db-maroon mb-3 h2">
                                            <a href="{{ $facility->slug_url }}"
                                                style="color: inherit; text-decoration: none;">{{ $facility->title }}</a>
                                        </h3>
                                        <div class="text-muted mb-4 lead font-sans"
                                            style="font-size: 1rem; line-height: 1.7;">
                                            {!! $facility->excerpt !!}
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between pt-3 border-top border-gray-100">
                                            <a href="{{ $facility->slug_url }}"
                                                class="btn btn-secondary-custom px-4 py-2 rounded-pill fw-bold small">Read
                                                More <i class="bi bi-arrow-right ms-2"></i></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-12 flex justify-center">
                @if ($facilities instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="custom-pagination">
                        {{ $facilities->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
