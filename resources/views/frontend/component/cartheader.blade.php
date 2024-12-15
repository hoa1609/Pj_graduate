<div id="ec-side-cart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">Giỏ hàng</span>
                <button class="ec-close">×</button>
            </div>
            @if(count($cartsC) && !is_null($cartsC))
                <div class="cart-product">
                    <div id="cart-list">
                        @include('frontend.cart.partials.cart_list', ['cart' => Cart::instance('shopping')->content()])
                    </div>
                </div>
            @endif
        </div>
        <div class="ec-cart-bottom">
            <div class="total-mount mt-3">
                <div class="total-voucher uk-flex uk-space-between">
                    <div class="text-name-price">
                        <span>Giảm giá</span>
                    </div>
                    <div class="voucher-price">-{{ convert_price($cartPromotion['discount'], true) }}₫</div>
                </div>
                <div class="total-voucher uk-flex uk-space-between">
                    <div class="text-name-price">
                        <span>Phí giao hàng</span>
                    </div>
                    <div class="shipping-price">miễn phí</div>
                </div>
                <div class="total-voucher uk-flex uk-space-between">
                    <div class="text-name-price">
                        <span>Tạm tính</span>
                    </div>
                    <div class="sumary-value cart-total">{{ convert_price($cartCaculate['cartTotal'] - $cartPromotion['discount'], true)}} đ</div>
                </div>
            </div>
            <div class="cart_btn">
                <a href="{{ route('cart.checkout') }}" class="btn btn-secondary">Thanh toán</a>
            </div>
        </div>
    </div>
</div>
