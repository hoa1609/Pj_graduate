@php
    $name = $product->languages->first()->pivot->name;
    $canonical = write_url($product->languages->first()->pivot->canonical);
    $image = image($product->image);
    $price = getPrice($product);
    $catName = $product->product_catalogues->first()->languages->first()->pivot->name;
    $review = getReview($product);
@endphp
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
    <div class="ec-product-inner">
        <div class="ec-pro-image-outer">
            <div class="ec-pro-image">
                <a href="{{ $canonical }}" class="image">
                    <img class="main-image" src="{{ $image }}" alt="Product" loading="lazy">
                </a>
                @if($price['percent'] > 0)
                    <span class="percentage">-{{ $price['percent'] }}%</span>
                @endif
                {{-- <div class="ec-pro-actions">
                    <a href="#" class="ec-btn-group quickview" data-link-action="quickview" title="{{ $name }}" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal">
                        <i class="fi-rr-shopping-basket"></i>
                    </a>
                </div> --}}
            </div>
        </div>
        <div class="ec-pro-content">
            <a href="#"><h6 class="ec-pro-stitle">{{ $catName }}</h6></a>
            <h5 class="ec-pro-title"><a href="{{ $canonical }}">{{ $name }}</a></h5>
            <div class="ec-pro-rat-price">
                <span class="ec-pro-rating uk-flex uk-align-center">
                    <div class="star">
                        @for($j = 1; $j <= $review['star'] ; $j++)
                            <i class="ecicon eci-star fill"></i>
                        @endfor
                    </div>
                    <span class="rate-number">( {{ $review['count'] }} )</span>
                </span>
                <div class="price-cart uk-flex uk-space-between">
                    <div class="price-product">
                        {!! $price['html'] !!}
                    </div>
                    <a href="#" class="ec-btn-group quickview" data-link-action="quickview" title="{{ $name }}" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal">
                        <i class="fi-rr-shopping-basket"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>