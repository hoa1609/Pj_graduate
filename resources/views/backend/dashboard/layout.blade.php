<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<head>
    @include('backend.dashboard.component.head')
</head>

<body>

    @include('backend.dashboard.component.nav')
    @include('backend.dashboard.component.sidebar')

    <div class="page-wrapper">
        <div class="page-content">
            
            @include($template)
            @include('backend.dashboard.component.footer')

        </div>
    </div>
    
    @include('backend.dashboard.component.script')

</body>
</html>
