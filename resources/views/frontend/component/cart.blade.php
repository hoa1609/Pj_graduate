<div id="ec-side-cart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">Giỏ hàng</span>
                <button class="ec-close">×</button>
            </div>
            
            <ul class="eccart-pro-items">
                @foreach ($cartsComposer as $key => $val)

                @php
                    $count = Cart::count();
                @endphp

                <li>
                    <a href="product-left-sidebar.html" class="sidecart_pro_img">
                        <img src="{{ $val->image }}" alt="product"></a>
                    <div class="ec-pro-content">
                        <a href="product-left-sidebar.html" class="cart_pro_title">{{ $val->name }}</a>
                        <span class="cart-price"><span>{{ convert_price($val->price, true)}} &ensp;</span> x {{ $val->qty }}</span>
                        {{-- <div class="qty-plus-minus">
                            <input class="qty-input" type="text" name="ec_qtybtn" value="{{ $val->qty }}" />
                        </div> --}}
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                @endforeach
            </ul>


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