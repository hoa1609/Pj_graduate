@php
    $sku = $product->code;
    $rating = $product->average_star;
    $rangeStartTotal = $rating /5 * 100;
    $name = $product->languages->first()->pivot->name;
    $canonical = write_url($product->languages->first()->pivot->canonical, true , true);
    $image = image($product->image);
    $price = getPrice($product);
    $catName = $product->product_catalogues->first()->languages->first()->pivot->name;
    $review = getReview($product);
    $description = $product->languages->first()->pivot->description;
    $content = $product->languages->first()->pivot->content;
    $attributeCatalogue = $product->attributeCatalogue;
    $gallery = json_decode($product->album);
@endphp
<div class="modal-body mb-3">
    <div class="row">
        @if (!is_null($gallery))
            <div class="col-md-1 col-sm-6 col-xs-6 gallery-container">
                <div class="qty-nav-thumb">
                    @foreach ($gallery as $key => $val)
                        <div class="qty-slide-thumb">
                            <img class="img-thumb" src="{{ $val }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 gallery-container ps-0">
                <div class="qty-product-cover zoom-image-hover">
                    @foreach ($gallery as $key => $val)
                        <div class="qty-slide">
                            <img class="img-responsive" src="{{ $val }}" alt="" class="zoomImg">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="col-md-5 col-sm-12 col-xs-12 ps-5">
            <div class="quickview-pro-content pb-1">
                <h5 class="ec-quick-title product-main-title">{{ $name }}</h5>
                <div class="ec-quickview-rating uk-flex uk-align-center">
                    <div class="sku info me-3 cursor">
                        <span id="sku-text-dt">{{ $sku }}</span>
                        <ion-icon name="copy-outline" class="fs-20" id="copy-sku-dt"></ion-icon>
                    </div>
                    <div class="item-star">
                        <div class="stars-layout">
                            <div class="stars-active-layout" style="width: {{ $rangeStartTotal }}%;"></div>
                        </div>
                        <span>({{ $rating }})</span>
                    </div>
                </div>
                <div class="item-price-detail">
                    {!! $price['html'] !!}
                </div>
                @include('frontend.product.product.component.variant')
                <div class="ec-quickview-qty w-100 uk-flex uk-space-between mb-2">
                    <div class="qty-plus-minus">
                        <input class="qty-input" type="text" name="ec_qtybtn" value="1">
                    </div>
                    <div class="add-to-cart addToCart  w-100" data-id="{{ $product->id }}">
                        <button class="btn btn-danger  w-100">Thêm vào giỏ hàng</button>
                    </div>
                </div>
                <a href="{{ write_url('thanh-toan', true, true) }}">
                    <button class="btn btn-light w-100">Mua ngay</button>
                </a>
            </div>
            @include('frontend.product.product.component.methodship')
        </div>
    </div>
</div>
<input type="hidden" class="attributeCatalogue" value="{{ json_encode($attributeCatalogue) }}">
<input type="hidden" class="productCanonical" value="{{ write_url($product->languages->first()->pivot->canonical, true , true) }}">

<div class="ec-single-pro-tab mb-1">
    <div class="ec-single-pro-tab-wrapper">
        <div class="ec-single-pro-tab-nav">
            <ul class="nav nav-tabs uk-flex" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details" role="tab" aria-selected="true">Chi tiết sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review" role="tab" aria-selected="false">Đánh giá sản phẩm</a>
                </li>
            </ul>
        </div>
        <div class="tab-content ec-single-pro-tab-content">
            <div id="ec-spt-nav-details" class="tab-pane fade show active">
                <div class="ec-single-pro-tab-desc">
                  @if($content != null && empty($content) )
                    {!! $content !!}
                  @else
                      <h3>Chưa có chi tiết sản phẩm</h3>
                  @endif
                </div>
            </div>
            <div id="ec-spt-nav-review" class="tab-pane fade">
                @include('frontend.product.product.component.review', ['model' => $product, 'reviewable' => 'App\Models\Product'])
            </div>
        </div>
    </div>
</div>
@include('frontend.product.product.component.relation')
