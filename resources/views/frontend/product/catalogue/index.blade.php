@extends('frontend.homepage.layout')
@section('content')
    @include('frontend.component.breadcrumb', ['model' => $productCatalogue, 'breadcrumb' => $breadcrumb])
    <section class="ec-page-content">
        <div class="container">
            <div class="row">
                <div class="ec-pro-list-top d-flex">
                    <div class="col-md-6 ec-grid-list">
                        <div class="ec-gl-btn">
                            <div class="ec-select-inner">
                                <select name="ec-select" id="ec-select">
                                    <option value="5">20 san phẩm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ec-sort-select">
                        <div class="ec-select-inner">
                            <select name="ec-select" id="ec-select">
                                <option selected disabled>Lọc kết quả</option>
                                <option value="1">Relevance</option>
                                <option value="2">Name, A to Z</option>
                                <option value="3">Name, Z to A</option>
                                <option value="4">Price, low to high</option>
                                <option value="5">Price, high to low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @if(!is_null($products))
                <div class="shop-pro-content section-space-p">
                    <div class="shop-pro-inner">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                    @include('frontend.component.product-item')
                                </div>
                            @endforeach
                        </div>
                        <div class="uk-flex uk-flex-center">
                            @include('frontend.component.pagination', ['model' => $products])
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
