@extends('frontend.homepage.layout')
@section('content')
    @include('frontend.component.breadcrumb', ['model' => $productCatalogue, 'breadcrumb' => $breadcrumb])
    <section class="ec-page-content">
        <div class="container">
            <div class="col-lg-12 col-md-12">
                @if(!is_null($products))
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="filter-item">
                                <div class="filter-body">
                                    <div class="filter-choose">
                                        <input type="checkbox" id="attribute-1" class="input-checkbox filtering">
                                        <label for="">Vàng</label>
                                    </div>
                                </div>
                            </div>
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Giá</h3>
                                </div>
                                <div class="ec-sb-block-content es-price-slider">
                                    <div class="ec-price-filter">
                                        <div id="ec-sliderPrice" class="filter__slider-price" data-min="0"
                                            data-max="250" data-step="10"></div>
                                        <div class="ec-price-input">
                                            <label class="filter__label"><input type="text"
                                                    class="filter__input"></label>
                                            <span class="ec-price-divider"></span>
                                            <label class="filter__label"><input type="text"
                                                    class="filter__input"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  --}}
                        <div class="col-lg-10 border">
                            <div class="drop-sort-fitter">
                                <span>Sắp xếp theo:</span>
                                <div class="col-md-2">
                                    <select name="publish" class="form-control form-select">
                                        <option selected="" value="0">--Chọn tình trạng--</option>
                                        <option value="1">Đang tắt</option>
                                        <option value="2">Đang bật</option>
                                    </select>
                                </div>
                            </div>
                            <div class="shop-pro-content section-space-p">
                                <div class="shop-pro-inner">
                                    <div class="row">
                                        @foreach ($products as $product)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
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
