<base href="{{ config('app.url') }}">
<meta charset="UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="robots" content="index/follow"/>
<meta name="author" content="{{ $system['homepage_company'] }}"/>
<meta http-equiv="refresh" content="1800"/>
<link rel="icon" href="{{ $system['homepage_favicon'] ?? ''}}" sizes="32x32"/>

<title>{{ $seo['meta_title'] }}</title>
<meta name="keyword" content="{{ $seo['meta_keyword'] }}"/>
<meta name="description" content="{{ $seo['meta_description'] }}"/>
<meta name="canonical" content="{{ $seo['canonical'] }}"/>
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="icon" href="frontend/assets/images/favicon/favicon.png" sizes="32x32" />

@php
    $coreCss = [
        'frontend/assets/css/plugins/animate.css',
        'frontend/assets/css/vendor/ecicons.min.css',
        "frontend/assets/css/plugins/swiper-bundle.min.css",
        "frontend/assets/css/plugins/jquery-ui.min.css",
        "frontend/assets/css/plugins/countdownTimer.css",
        "frontend/assets/css/plugins/nouislider.css",
        "frontend/assets/css/plugins/slick.min.css",
        "frontend/assets/css/plugins/owl.carousel.min.css",
        "frontend/assets/css/plugins/owl.theme.default.min.css",
        "frontend/assets/css/plugins/bootstrap.css",
        "frontend/assets/css/demo8.css",
        "frontend/assets/css/customer.css",
        'frontend/assets/toastr/toastr.min.css',
        'frontend/assets/css/gioithieu.css',
        ]
        @endphp
@foreach ($coreCss as $item)
    <link rel="stylesheet" href="{{ asset($item) }}">
@endforeach
