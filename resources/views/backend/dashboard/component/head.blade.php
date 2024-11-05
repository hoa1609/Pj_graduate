<meta charset="utf-8" />
    <base href="{{ env('APP_URL') }}">

            <title>{{$config['seo']['index']['table'] ?? ''}} </title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
            <meta content="" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="shortcut icon" href="/backend/assets/images/favicon32.png">



     <link rel="stylesheet" href="/backend/assets/libs/jsvectormap/css/jsvectormap.min.css">

     <link href="/backend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="/backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="/backend/assets/css/app.min.css" rel="stylesheet" type="text/css" />
     <link href="/backend/assets/css/customize.css" rel="stylesheet" type="text/css" />
     <link href="/backend/assets/css/style.css" rel="stylesheet" type="text/css" />
     <link href="/backend/assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />


     {{-- Custom --}}
     <script src="/backend/plugins/jquery-ui.css"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>


    <script>
        // var BASE_URL = '{{ env('APP_URL') }}'
        var BASE_URL = '{{ url('/') }}';
        var SUFFIX = '{{ config('apps.general.suffix') }}'

        console.log("BASE_URL:", BASE_URL);
    </script>


