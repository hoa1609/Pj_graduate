<meta charset="utf-8" />
<base href="{{ config('app.url') }}">
<title>Dashboard - 4AM Style</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="backend/assets/images/favicon32.png">

<link href="backend/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet">
<link href="backend/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="backend/assets/css/icons.min.css" rel="stylesheet" />
<link href="backend/assets/css/app.min.css" rel="stylesheet" />
<link href="backend/assets/libs/simple-datatables/style.css" rel="stylesheet" />
<link href="backend/plugins/jquery-ui.js" rel="stylesheet" />
<link href="backend/plugins/nice-select/css/nice-select.css" rel="stylesheet" />


@if(isset($config['css']) && is_array($config['css']))
    @foreach($config['css'] as $key => $val)
        {!! '<link rel="stylesheet" href="'.$val.'"></script>' !!}
    @endforeach
@endif

<link href="backend/assets/css/customize.css" rel="stylesheet" />
<script src="backend/assets/js/jquery_3.1.min.js"></script>

<script>
    var BASE_URL = '{{ config('app.url') }}'
    var SUFFIX = '{{ config('apps.general.suffix') }}'
</script>

<script>
    var getMenuUrl = "{{ route('ajax.dashboard.getMenu') }}";
</script>
