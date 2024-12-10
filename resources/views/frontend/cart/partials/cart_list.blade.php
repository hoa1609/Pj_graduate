@if ($cart->isNotEmpty())
    @foreach ($cart as $item)
        <div class="row item-product">
            <div class="col-md-3 image-item">
                <div class="image-cart-wrapper">
                    <img src="{{ $item->options->image }}" alt="{{ $item->name }}">
                    <span class="quantity-label">
                        <label class="cart-item-number">{{ $item->qty }}</label>
                    </span>
                </div>
            </div>
            <div class="col-md-6 px-0">
                <div class="product-quantity">
                    <h5 class="title-product text-truncate">{{ $item->name }}</h5>
                    <div class="quantity-control">
                        <button type="button" class="btn-qty minus">-</button>
                        <input type="hidden" class="rowId" value="{{ $item->rowId }}">
                        <input type="number"
                            value="{{ $item->qty }}"
                            class="qty-checkout">
                        <button type="button" class="btn-qty plus">+</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 uk-flex flex-column">
                <div class="cart-item-remove" data-row-id="{{ $item->rowId }}">
                    <span class="cursor cloes-remove">X</span>
                </div>
                <div class="price-item mt-5">
                    <div class="cart-price-sale">{{ convert_price($item->price * $item->qty, true) }}₫</div>
                </div>
            </div>
        </div>
    @endforeach
@endif