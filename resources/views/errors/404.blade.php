@extends('frontend.layouts.subpage')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('content')
    <!-- Start page-content -->
    <div class="main-content">


        <section class="page-banner text-center text-white">
            <div class="container position-relative z-10">
                <h2 class="display-4 sub-page-title mb-3" data-aos="fade-down">404 Page</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0" data-aos="fade-up" data-aos-delay="100">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">404 Page</li>
                    </ol>
                </nav>
            </div>
        </section>

        <section class="error-page py-5 bg-white subpage" class="container-fluid py-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 blog-pull-right" style="text-align:center;">
                        <p style="text-align:center;">Oops! Page Not Found</p>
                        <h1 style="text-align:center;">404</h1>
                        <p style="text-align:center;">Sorry, we can’t find the page you’re looking for</p>
                        <div class="read-more-btn mt-4">
                            <i class="fa fa-home" aria-hidden="true" style="color: #222; font-size: 20px;"></i>
                            <a href="{{ url('/') }}" onclick="window.history.back(-1);"
                                class="readon orange-btn main-home" style="color: #fff !important;">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- end page-content -->
@endsection
