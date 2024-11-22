@extends('frontend.homepage.layout')
@section('content')
@include('frontend.component.breadcrumb')
    <div class="container">
        @include('frontend.component.product-detail', ['product' => $product, 'productCatalogue' => $productCatalogue])
    </div>
@endsection

