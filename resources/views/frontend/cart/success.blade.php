@extends('frontend.homepage.layout')
@section('content')
    <section class="ec-page-content section-space-p">
        <div class="container section-fixed-top">
            @if($config['method'] == 'success')
                <div class="row mb-4">
                    <div class="card-head">
                        <h3 class="title-invoice">Xác nhận đơn hàng thành công</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="container uk-flex uk-content-center">
                        <div class="item-check">
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-success" viewBox="0 0 24 24">
                                <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                                <circle class="success-circle-outline" cx="12" cy="12" r="11.5"/>
                                <circle class="success-circle-fill" cx="12" cy="12" r="11.5"/>
                                <polyline class="success-tick" points="17,8.5 9.5,15.5 7,13"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            @endif
            @if($config['method'] == 'find')
                @include('frontend.cart.component.statusfind')
            @endif
            <div class="row uk-flex uk-content-center">
                <div class="col-md-6">
                    <div class="invoice-container mt-4">
                        <div class="item-header-invoice mb-3">
                            <h4 class="header-inv">Thông tin hóa đơn</h4>
                        </div>
                        <div class="inf-pro">
                            <div class="code-item uk-flex uk-space-between">
                                <div class="code-product">Mã <span class="sku-succes">#{{ $order->code }}</span></div>
                                <div class="time-product">{{ convertDateTime($order->created_at) }}</div>
                            </div>
                            <table class="invoice-table">
                                <thead>
                                    <tr class="invoice-tr-center">
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá niêm yết</th>
                                    <th>Giá bán</th>
                                    <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $carts = $order->products;
                                        $pro = $order->promotion;
                                    @endphp
                                    @foreach ($carts as $key => $val)
                                    @php
                                        $name = $val->pivot->name;
                                        $qty = $val->pivot->qty;
                                        $price = convert_price($val->pivot->price, true);
                                        $priceOriginal = convert_price($val->pivot->priceOriginal, true);
                                        $subtotal = convert_price($val->pivot->price * $qty, true);
                                    @endphp
                                    <tr>
                                        <td>{{ $name }}</td>
                                        <td class="text-center">{{ $qty }}</td>
                                        <td class="text-center">{{ $priceOriginal }}₫</td>
                                        <td class="text-center">{{ $price }}₫</td>
                                        <td class="text-end">{{ $subtotal }}₫</td>
                                    </tr>
                                    @endforeach
                                    <tr> <td colspan="4"></td> </tr>
                                </tbody>
                                <tfoot class="footer-iv">
                                    <tr>
                                        <td colspan="4" class="price-iv">Tổng giá trị</td>
                                        <td class="text-end">{{ convert_price($order->cart['cartTotal'], true) }}₫</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="price-iv">Mã khuyến mãi</td>
                                        <td class="text-end">
                                            {{ ($order['promotion']['code'] ?? ' ') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="price-iv">Khuyến mãi</td>
                                        <td class="text-end">-{{ convert_price($order->promotion['discount'], true) }}₫</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="price-iv">Phí giao hàng</td>
                                        <td class="text-end">0₫</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="iv-total">Tổng thanh toán</td>
                                        <td class="text-end total-iv">{{ convert_price($order->cart['cartTotal'] - $order->promotion['discount'], true) }}₫</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        @if($config['method'] == 'success')
                            <div class="info-receiver mt-5">
                                <div class="text-bold">Tên người nhận:
                                    <span class="text-normal">{{ $order->fullname }}</span>
                                </div>
                                <div class="text-bold">Email:
                                    <span class="text-normal">{{ $order->email }}</span>
                                </div>
                                <div class="text-bold">Địa chỉ:
                                    <span class="text-normal">{{ $order->address }}</span>
                                </div>
                                <div class="text-bold">Số điện thoại:
                                    <span class="text-normal">{{ $order->phone }}</span>
                                </div>
                                <div class="text-bold">Hình thức thanh toán:
                                    <span class="text-normal">{{ array_column(__('payment.method'), 'title', 'name')[$order->method] }}</span>
                                </div>
                                @if(isset($template) && !is_null($template))
                                    @include($template ?? '')
                                @endif
                                <div class="text-bold">Khác: </div>
                            </div>
                        @endif
                        <p class="invoice-footer">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
                    </div>
                </div>
            </div>
            <div class="row mb-4 mt-2">
                <div class="col uk-flex uk-content-center">
                    <span class="prive-other-pr">
                        <a href="" class="text-iv-pro">Xem sản phẩm khác tại đây!</a>
                    </span>
                </div>
            </div>
        </div>
    </section>
@endsection
