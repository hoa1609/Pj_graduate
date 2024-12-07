@extends('frontend.homepage.layout')
@section('content')
    @include('frontend.homepage.home.component.slide')
    @include('frontend.homepage.home.component.productcatelogue')
    @include('frontend.homepage.home.component.otherproduct')
    @include('frontend.homepage.home.component.dealofday')
    @include('frontend.homepage.home.component.bestsale')

    @include('frontend.homepage.home.component.information')
    @include('frontend.homepage.home.component.blog')
    @include('frontend.component.quickview')
@endsection