@extends('frontend.layouts.subpage')
@section('title', 'Video Gallery')
@section('content')

    <div class="page-banner-area bg-2">
        <div class="container">
            <div class="page-banner-content">
                <h1>Video Gallery</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Video Gallery</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="contact-info-area pt-100 pb-70">
        <div class="container">
            @if (!empty($videos) && count($videos) > 0)
                <div class="row">
                    @foreach ($videos as $video)
                        @php
                            $videoId = $video['snippet']['resourceId']['videoId'] ?? $video['id']['videoId'] ?? null;
                        @endphp
                        @if ($videoId)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow">
                                    <iframe class="card-img-top" height="200" src="https://www.youtube.com/embed/{{ $videoId }}"
                                        allowfullscreen></iframe>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video['snippet']['title'] }}</h5>
                                        <p class="card-text small text-muted">
                                            {{ \Illuminate\Support\Str::limit($video['snippet']['description'], 100) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="view-all text-center">
                    <a href="" class="btn btn-primary">View All</a>
                </div>
            @else
                <div class="alert alert-warning">
                    🚫 Failed to load videos. Please try again later.
                </div>
            @endif

        </div>

    </div>
@endsection