@php
    $name = $product->languages->first()->pivot->name;
    $canonical = write_url($product->languages->first()->pivot->canonical, true, true);
    $gallery = json_decode($product->album);
    $image = image($product->image);
    $hoverimage = $gallery[0] ?? $image;
    $price = getPrice($product);
    $catName = $product->product_catalogues->first()->languages->first()->pivot->name;
    $review = getReview($product);
@endphp
<div class="ec-product-inner">
    <div class="ec-pro-image-outer">
        <div class="ec-pro-image">
            <a href="{{ $canonical }}" class="image">
                <img class="main-image" src="{{ $image }}" alt="Product" loading="lazy">
                <img class="hover-image" src="{{ $hoverimage }}" alt="Product" loading="lazy">
            </a>
            @if($price['percent'] > 0)
                <span class="percentage">-{{ $price['percent'] }}%</span>
            @endif
            <div class="ec-pro-actions">
                <div class="ec-btn-group addCart" data-id="{{ $product->id }}">
                    {!! renderQuickBuy($product, $name, $canonical) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="ec-pro-content">
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
            </div>
        </div>
        <h5 class="ec-pro-title"><a class="text-truncate" href="{{ $canonical }}">{{ $name }}</a></h5>
    </div>
</div>