@extends('frontend.homepage.layout')
@section('content')
    @php
        $total = 0;
    @endphp
    <section class="ec-page-content section-fixed-top">
        <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <div class="container" style="margin-top: 20px">
                <div class="row pb-3">
                    <div class="ec-checkout-leftside col-lg-7 col-md-12 ">
                        <div class="border-checkout">
                            <div class="checkout-content">
                                <div class="ec-checkout-inner">
                                    <div class="ec-checkout-wrap margin-bottom-30">
                                        <div class="ec-checkout-block ec-check-new">
                                                @include('frontend.cart.component.information')
                                                @include('frontend.cart.component.method')
                                                <button type="submit" value="create" name="create" class="cart-checkout">Thanh toán hóa đơn</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ec-checkout-rightside col-lg-5 col-md-12">
                        <div class="container-info">
                            <div class="header-title mb-4">
                                <h3 class="checkout-title">Giỏ hàng</h3>
                            </div>
                            @include('frontend.cart.component.item')
                            @include('frontend.cart.component.voucher')
                            @include('frontend.cart.component.summary')
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

<script>
    var province_id = '{{ (isset($order->province_id)) ? $order->province_id : old('province_id') }}'
    var district_id = '{{ (isset($order->district_id)) ? $order->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($order->ward_id)) ? $order->ward_id : old('ward_id') }}'
</script>
