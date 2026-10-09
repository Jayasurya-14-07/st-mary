<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('panel.site_title'))</title>
    <meta name="description"
        content="Don Bosco Renewal Centre (DBRC), Bangalore — A Salesian International Training Centre offering courses in ongoing formation for Priests, Religious and Laity.">
    @include('frontend.includes.headerLink')
    @include('frontend.includes.headerLink')
    @production
        @include('frontend.includes.ga')
    @endproduction
</head>

<body>
    @include('frontend.includes.header')

    @include('frontend.includes.slider')

    @include('frontend.includes.about')

    @include('frontend.includes.ourProgramme')

    @include('frontend.includes.whatWeOffer')

    @include('frontend.includes.ourCampus')

    @include('frontend.includes.resources')

    @include('frontend.includes.testimonial')

    @include('frontend.includes.footer')
</body>

</html>
