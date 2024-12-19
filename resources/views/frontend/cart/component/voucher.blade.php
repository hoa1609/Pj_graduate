@if(!is_null($cartPromotion['selectedPromotion']))
    @php
    $name = $cartPromotion['selectedPromotion']->name;
    $code = $cartPromotion['selectedPromotion']->code;
    @endphp
        <div class="voucher-container ">
            <div class="panel-voucher uk-flex">
                <div class="voucher-item">
                    <div class="voucher-left"></div>
                    <div class="voucher-right">
                        <div class="voucher-title">{{ $code }}</div>
                        <div class="voucher-description">
                            <p>{{ $name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        <div class="voucher-form">
            <input type="text" placeholder="chọn mã giảm giá" name="voucher" value="" >
            <a href="" class="apply-voucher">Áp dụng</a>
        </div>
    </div> 
@endif