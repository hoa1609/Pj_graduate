<div id="ec-side-cart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">Giỏ hàng</span>
                <button class="ec-close">×</button>
            </div>
            <div class="cart-product">
                <div id="cart-list">
                    @if(count($cartsC) && !is_null($cartsC))
                        @include('frontend.cart.partials.cart_list', ['cart' => Cart::instance('shopping')->content()])
                    @else
                        <div class="text-center">
                            <img src="frontend/assets/images/icons/product-null.svg" alt="icon" width="150px">
                        </div>
                        <p class="text-cart-null">Hiện chưa có sản phẩm trong giỏ hàng!</p>
                    @endif
                </div>
            </div>               
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