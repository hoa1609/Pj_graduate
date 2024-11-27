<div class="container-method">
    <div class="uk-flex uk-space-between mb-3">
        <h3 class="checkout-title">Hình thức thanh toán</h3>
    </div>
    @foreach (__('payment.method') as $key => $val)
        <div class="cart-method mb-3">
            <label>
                <input type="radio" 
                name="method" 
                value="{{ $val['name'] }}" 
                @if(old('method', '') == $val['name'] || (!old('method') && $key == 0)) checked  @endif
                id="{{ $val['name'] }}"
                >
                <span class="image"><img src="{{ $val['image'] }}" alt=""></span>
                <span class="text-name">{{ $val['title'] }}</span>
            </label>
        </div>
    @endforeach
    <div class="text-center cart-return">
        <span>Nếu bạn không hài với sản phẩm của <strong>4Am Style</strong>? Bạn có thể hoàn toàn gửi trả lại sản phẩm chúng tôi 
            <a href="" class="bold-h">Tại đây!</a>
        </span>
    </div>
</div>