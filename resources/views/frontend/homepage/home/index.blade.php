@extends('frontend.homepage.layout')
@section('content')
    @include('frontend.homepage.home.component.slide')
    @include('frontend.homepage.home.component.productcatelogue')
    @include('frontend.homepage.home.component.newproduct')
    @include('frontend.homepage.home.component.groupproduct2')
    @include('frontend.homepage.home.component.bannerlazy')
    @include('frontend.homepage.home.component.groupproduct1')
    @include('frontend.homepage.home.component.dealofday')
    @include('frontend.homepage.home.component.bestsale')


    @include('frontend.homepage.home.component.blog')
@endsection