@extends('frontend.homepage.layout')
@section('content')
@include('frontend.component.breadcrumb')
    <div class="container">
        @include('frontend.product.product.component.detail', ['product' => $product, 'productCatalogue' => $productCatalogue])
    </div>
@endsection

