@extends('frontend.homepage.layout')
@section('content')
    @include('frontend.component.breadcrumb', ['model' => $productCatalogue, 'breadcrumb' => $breadcrumb])
    <section class="ec-page-content">
        <div class="container">
            <div class="col-lg-12 col-md-12 pb-5">
                @if(!is_null($products))
                    <div class="row">
                        @include('frontend.product.catalogue.component.filter')
                        <!-----  ------->
                        <div class="col-lg-10">
                            <!-----  ------->
                            @include('frontend.product.catalogue.component.fiterContent')
                            <div class="shop-pro-content">
                                <div class="shop-pro-inner">
                                    <div class="row product-catalogue">
                                        @foreach ($products as $product)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                                @include('frontend.component.product-item')
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="uk-flex uk-flex-center">
                                        @include('frontend.component.pagination', ['model' => $products])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
