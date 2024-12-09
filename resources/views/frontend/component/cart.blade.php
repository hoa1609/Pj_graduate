<div id="ec-side-cart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">Giỏ hàng</span>
                <button class="ec-close">×</button>
            </div>
            
            @if(count($carts) && !is_null($carts))
    <div class="cart-product">
        @foreach ($carts as $keyCart => $cart)
            <div class="row item-product mt-2">
                <div class="col-md-3 image-item">
                    <div class="image-cart-wrapper">
                        <img src="{{ $cart->image }}">
                        <span class="quantity-label">
                            <label class="cart-item-number">{{ $cart->qty }}</label>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-quantity">
                        <h5 class="title-product text-truncate">{{ $cart->name }}</h5>
                        <div class="quantity-control">
                            <button type="button" class="btn-qty minus">-</button>
                            <input type="hidden" class="rowId" value="{{ $cart->rowId }}">
                            <input type="number"
                                value="{{ $cart->qty }}"
                                class="qty-checkout">
                            <button type="button" class="btn-qty plus">+</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 uk-flex flex-column">
                    <div class="cart-item-remove" data-row-id="{{ $cart->rowId }}">
                        <span>X</span>
                    </div>
                    <div class="price-item mt-5">
                        {{-- @if($cart->price != $cart->priceOriginal)
                            <div class="cart-price-old">{{ convert_price($cart->priceOriginal, true) }}₫</div>
                        @endif --}}
                        <div class="cart-price-sale">{{ convert_price($cart->price * $cart->qty, true) }}₫</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif



        </div>
        <div class="ec-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                        <tr>
                            <td class="text-left">Tổng giá :</td>
                            <td class="text-right">{{ convert_price($cartCaculate['cartTotal'], true) }}đ</td>
                        </tr>
                        <tr>
                            <td class="text-left">KM :</td>
                            <td class="text-right">-{{ convert_price($cartPromotion['discount'], true) }}đ</td>
                        </tr>
                        <tr>
                            <td class="text-left">Tổng thanh toán :</td>
                            <td class="text-right primary-color">{{ convert_price($cartCaculate['cartTotal'] - $cartPromotion['discount'], true)}} đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart_btn">
                <a href="{{ route('cart.checkout') }}" class="btn btn-secondary">Thanh toán</a>
            </div>
        </div>
    </div>
</div>