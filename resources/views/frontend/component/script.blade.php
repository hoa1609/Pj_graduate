 @php
    $coreScript = [
        'frontend/assets/js/vendor/jquery-3.5.1.min.js',
        'frontend/assets/toastr/toastr.min.js',
        'frontend/assets/js/vendor/popper.min.js',
        'frontend/assets/js/vendor/bootstrap.min.js',
        'frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js',
        'frontend/assets/js/vendor/modernizr-3.11.2.min.js',
        'frontend/assets/js/plugins/jquery.sticky-sidebar.js',
        'frontend/assets/js/plugins/swiper-bundle.min.js',
        'frontend/assets/js/plugins/countdownTimer.min.js',
        'frontend/assets/js/plugins/nouislider.js',
        'frontend/assets/js/plugins/scrollup.js',
        'frontend/assets/js/plugins/jquery.zoom.min.js',
        'frontend/assets/js/plugins/slick.min.js',
        'frontend/assets/js/plugins/owl.carousel.min.js',
        'frontend/assets/js/plugins/infiniteslidev2.js',
        'frontend/assets/js/plugins/click-to-call.js',
        'frontend/assets/js/plugins/wow1.1.2.min.js',
        'frontend/assets/js/vendor/index.js',
        'frontend/assets/js/demo-8.js',
        'frontend/assets/function.js',
        'frontend/assets/js/review.js',
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'

        ];
    if(isset($config['js'])){
        foreach ($config['js'] as $key => $value) {
            array_push($coreScript, $value);
        }
    }
    @endphp

    @foreach ($coreScript as $item)
        <script src="{{ asset($item) }}"></script>
    @endforeach
    <script src=""></script>
    <script src=""></script>
