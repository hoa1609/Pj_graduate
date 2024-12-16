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
            <span>Tổng đơn hàng</span>
        </div>
        <div class="sumary-value cart-total">{{ (count($carts) && !is_null($carts)) ? convert_price($cartCaculate['cartTotal'] - $cartPromotion['discount'], true) : 0 }}₫</div>
    </div>
</div>