@extends('frontend.layouts.subpage')

@section('title', $item->title)

@section('content')
    <section class="page-banner text-center text-white">
        <div class="container position-relative z-10">
            <h2 class="display-4 sub-page-title mb-3" data-aos="fade-down">
                Lives of Saints
            </h2>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0" data-aos="fade-up" data-aos-delay="100">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Lives of Saints</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $item->title }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    @include('frontend.partials.news-events-detail', ['item' => $item])
@endsection
