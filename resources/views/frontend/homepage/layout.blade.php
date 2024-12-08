<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.component.head')
</head>
    <body>
        @include('frontend.component.header')
        @include('frontend.component.cartheader')
        
        @yield('content')

        @include('frontend.component.footer')
        @include('frontend.component.script')
    </body>
</html>