<meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>4AM Style - Fashion</title>

   <link rel="icon" href="frontend/assets/images/favicon/favicon-8.png" sizes="32x32" />
   <link rel="apple-touch-icon" href="frontend/assets/images/favicon/favicon-8.png" />
   <meta name="msapplication-TileImage" content="frontend/assets/images/favicon/favicon-8.png" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
    ]
@endphp
@foreach ($coreCss as $item)
    <link rel="stylesheet" href="{{ asset($item) }}">
@endforeach


