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
<link href="backend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="backend/assets/css/app.min.css" rel="stylesheet" type="text/css" />
<link href="backend/assets/css/customize.css" rel="stylesheet" type="text/css" />

<link href="backend/assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
<link href="backend/assets/css/select2.min.css" rel="stylesheet" type="text/css" />

<link href="backend/plugins/jquery-ui.js" rel="stylesheet" type="text/css" />
<link href="backend/plugins/nice-select/css/nice-select.css" rel="stylesheet" type="text/css" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var BASE_URL = '{{ config('app.url') }}'
    var SUFFIX = '{{ config('apps.general.suffix') }}'
</script>

<script>
    var getMenuUrl = "{{ route('ajax.dashboard.getMenu') }}";
</script>
