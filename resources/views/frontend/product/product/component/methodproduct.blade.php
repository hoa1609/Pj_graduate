<div class="item-pro-detail-method mb-3">
    <div class="item-method uk-flex uk-align-center uk-content-center mb-2">
        @foreach (__('payment.method') as $key => $val)
            <img src="{{ $val['image'] }}" alt="{{ $val['name'] }}" class="pro-detail-method">
        @endforeach
    </div>
    <div class="text-commit">
        Đảm bảo thanh toán an toàn và bảo mật
    </div>
</div>