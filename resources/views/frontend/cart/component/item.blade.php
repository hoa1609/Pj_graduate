@if(count($carts) && !is_null($carts))
    <div class="cart-product">
        @foreach ($carts as $keyCart => $cart)
            <div class="row item-product">
                <div class="col-md-3 image-item">
                    <div class="image-cart-wrapper">
                        <img src="{{ $cart->options->image }}" alt="{{ $cart->name }}">
                        <span class="quantity-label">
                            <label class="cart-item-number">{{ $cart->qty }}</label>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-quantity">
                        <h5 class="title-product text-truncate-2">{{ $cart->name }}</h5>
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
                        <span class="cursor cloes-remove"><ion-icon name="trash-outline" class="fs-20"></ion-icon></span>
                    </div>
                    <div class="price-item mt-5">
                        <div class="cart-price-sale">{{ convert_price($cart->price * $cart->qty, true) }}₫</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
