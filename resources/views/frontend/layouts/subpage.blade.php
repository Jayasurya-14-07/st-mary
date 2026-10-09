<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('panel.site_title')) - {{ trans('panel.site_title_full') }}</title>
    <meta name="description"
        content="Don Bosco Renewal Centre (DBRC), Bangalore — A Salesian International Training Centre offering courses in ongoing formation for Priests, Religious and Laity.">
    @include('frontend.includes.headerLink')
    @stack('styles')
    @production
        @include('frontend.includes.ga')
    @endproduction

    <link rel="stylesheet" href="{{ asset('frontend/filament.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/pageblade.css') }}">
</head>

<body>
    @include('frontend.includes.header')

    @yield('content')

    @include('frontend.includes.footer')
    @stack('scripts')
</body>

</html>
