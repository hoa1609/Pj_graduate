@php
    $name = $product->languages->first()->pivot->name;
    $canonical = write_url($product->languages->first()->pivot->canonical, true , true);
    $image = image($product->image);
    $price = getPrice($product);
    $catName = $product->product_catalogues->first()->languages->first()->pivot->name;
    $review = getReview($product);
    $description = $product->languages->first()->pivot->description;
    $attributeCatalogue = $product->attributeCatalogue;
    $gallery = json_decode($product->album);
@endphp
<div class="modal-body">
    <div class="row">
        @if (!is_null($gallery))
            <div class="col-md-5 col-sm-12 col-xs-12 gallery-container">
                <div class="qty-product-cover">
                    @foreach ($gallery as $key => $val)
                        <div class="qty-slide">
                            <img class="img-responsive" src="{{ $val }}" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="qty-nav-thumb">
                    @foreach ($gallery as $key => $val)
                        <div class="qty-slide-thumb">
                            <img class="img-thumb" src="{{ $val }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="col-md-7 col-sm-12 col-xs-12">
            <div class="quickview-pro-content">
                <h5 class="ec-quick-title product-main-title">{{ $name }}</h5>
                <div class="ec-quickview-rating">
                    <i class="ecicon eci-star fill"></i>
                    <i class="ecicon eci-star fill"></i>
                    <i class="ecicon eci-star fill"></i>
                    <i class="ecicon eci-star fill"></i>
                    <i class="ecicon eci-star"></i>
                </div>
                <div class="ec-quickview-desc">
                    {!! $description !!}
                </div>
                <div class="item-price-detail">
                    {!! $price['html'] !!}
                </div>
                @include('frontend.product.product.component.variant')
                <div class="ec-quickview-qty">
                    <div class="qty-plus-minus">
                        <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                    </div>
                    <div class="ec-quickview-cart addToCart" data-id="{{ $product->id }}">
                        <button class="btn btn-primary">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="attributeCatalogue" value="{{ json_encode($attributeCatalogue) }}">
<input type="hidden" class="productCanonical" value="{{ write_url($product->languages->first()->pivot->canonical, true , true) }}">


{{-- Review --}}
@include('frontend.product.product.component.review', ['model' => $product, 'reviewable' => 'App\Models\Product'])
