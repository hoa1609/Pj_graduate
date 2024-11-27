@extends('frontend.homepage.layout')
@section('content')
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row mb-4">
                <div class="card-head">
                    <h3 class="title-invoice">Xác nhận đơn hàng thành công</h3>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col uk-flex uk-content-center">
                    <span class="prive-other-pr">
                        <a href="" class="text-iv-pro">Xem sản phẩm khác tại đây!</a>
                    </span>
                </div>
            </div>
            <div class="row uk-flex uk-content-center">
                <div class="col-md-6">
                    <div class="invoice-container mt-4">
                        <div class="item-header-invoice mb-3">
                            <h4 class="header-inv">Thông tin hóa đơn</h4>
                        </div>
                        <div class="inf-pro">
                            <div class="code-item uk-flex uk-space-between">
                                <div class="code-product">Mã #{{ $order->code }}</div>
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
                                        // dd($pro);
                                    @endphp
                                    @foreach ($carts as $key => $val)
                                    @php
                                        $name = $val->pivot->name;
                                        $qty = $val->pivot->qty;
                                        $price = convert_price($val->pivot->price, true);
                                        $priceOriginal = convert_price($val->pivot->priceOriginal, true);
                                        $subtotal = convert_price($val->pivot->price * $qty, true);
                                    @endphp
                                    <tr class="bg-danger-bur">
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
                                        <td colspan="4" class="price-iv">Mã giảm giá</td>
                                        <td class="text-end">{{ $order->promotion['code'] }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="price-iv">Tổng giá trị</td>
                                        <td class="text-end">{{ convert_price($order->promotion['discount'] + $order->cart['cartTotal'], true) }}₫</td>
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
                                        <td class="text-end total-iv">{{ convert_price($order->cart['cartTotal'], true) }}₫</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
                            <div class="text-bold">Khác: </div>
                        </div>
                        <p class="invoice-footer">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection