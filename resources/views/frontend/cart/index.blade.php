@extends('frontend.homepage.layout')
@section('content')

    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-checkout-leftside col-lg-7 col-md-12 ">
                    <div class="border-checkout">
                        <div class="checkout-content">
                            <div class="ec-checkout-inner">
                                <div class="ec-checkout-wrap margin-bottom-30">
                                    <div class="ec-checkout-block ec-check-new">
                                        <form action="" method="">
                                            @csrf
                                            <div class="container-info mb-5">
                                                <div class="uk-flex uk-space-between">
                                                    <h3 class="checkout-title">Thông tin đặt hàng</h3>
                                                    <div class="login-checkout">
                                                        <span>Bạn chưa có tài khoản? <a href="" class="text-login">Đăng nhập</a></span>
                                                    </div>
                                                </div>
                                                <div class="box-infor mt-4">
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6 mb-2">
                                                            <input type="text" name="name" class="form-control border-h-5" placeholder="nhập họ và tên...">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="text" name="name" class="form-control border-h-5" placeholder="nhập số điện thoại...">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-12">
                                                            <input type="text" name="name" class="form-control border-h-5" placeholder="nhập địa chỉ email...">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 mb-2">
                                                            <select class=" form-control border-h-5 form-select province location" name="province_id" data-target="districts">
                                                                <option value="0">[Chọn thành phố]</option>
                                                                @foreach ($provinces as $key => $val)
                                                                    <option value="{{ $val->code }}">{{ $val->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4 mb-2">
                                                            <select name="district_id" id="" class="form-control form-select border-h-5 districts location" data-target="wards">
                                                                <option value="0">[Chọn Quận huyện]</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4 mb-2">
                                                            <select class="form-control border-h-5 form-select wards" name="ward_id" data-target="districts"> 
                                                                <option value="0">[Chọn phường xã]</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-12">
                                                            <input type="text" name="name" class="form-control border-h-5" placeholder="nhập ghi chú...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                            {{ ($key == 0) ? 'checked' : '' }}
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
                                                <button type="submit" value="create" name="create" class="cart-checkout">Thanh toán hóa đơn</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-checkout-rightside col-lg-5 col-md-12">
                    <form action="" method="">
                        @csrf
                        <div class="container-info mb-5">
                            <h3 class="checkout-title">Giỏ hàng</h3>
                            <div class="cart-product">
                                @for($i = 0 ; $i <2; $i++)
                                    <div class="row item-product mt-2">
                                        <div class="col-md-3 image-item">
                                            <div class="image-cart-wrapper">
                                                <img src="https://cdn.kkfashion.vn/28621-large_default/ao-thun-nu-mau-den-in-hoa-trang-asm18-12.jpg" alt="img" class="image-cart">
                                                <span class="quantity-label">
                                                    <label>4</label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="product-quantity">
                                                <h5 class="title-product text-truncate">Áo thun danh cho mùa đông lạnh</h5>
                                                <div class="quantity-control">
                                                    <input type="number" value="1" class="qty-checkout">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 uk-flex flex-column">
                                            <div class="cart-item-remove">X</div>
                                            <div class="cart-item-price">1.450.000 đ</div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="voucher-container">
                                <div class="panel-voucher uk-flex">
                                    @for($i = 0 ; $i <3; $i++)
                                    <div class="voucher-item">
                                        <div class="voucher-left"></div>
                                        <div class="voucher-right">
                                            <div class="voucher-title">PH98989</div>
                                            <div class="voucher-description">
                                                <p>khuyến mãi ngày tình yêu</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                                <div class="voucher-form">
                                    <input type="text" placeholder="chọn mã giảm giá" name="voucher" value="" >
                                    <a href="" class="apply-voucher">Áp dụng</a>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    var province_id = '{{ (isset($order->province_id)) ? $order->province_id : old('province_id') }}'
    var district_id = '{{ (isset($order->district_id)) ? $order->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($order->ward_id)) ? $order->ward_id : old('ward_id') }}'
</script>
