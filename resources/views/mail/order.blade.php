<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mail đơn hàng</title>
    <style>
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            border: 1.5px solid #1e1e1e !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .invoice-header p {
            margin: 5px 0;
            color: #555;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            color: #313131;
            font-size: 15px;
        }
        .invoice-tr-center{
            border-top-left-radius: 10px;
        }
        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f4f4f4;
            color: #373737;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 20px;
            font-style: italic;
            font-size: 13px;
            color: #222222;
        }
        .title-invoice{
            font-size: 20px !important;
            color: #1e1e1e;
            text-align: center;
        }
        .invoice-tr-center th{
            text-align: center;
        }
        .header-inv{
            font-size: 18px;
            color: #222222;
            text-align: center;
            text-transform: uppercase;
        }
        .prive-other-pr{
            border: 1.5px solid #60a5fa;
            padding: 10px 30px;
            border-radius: 30px;
            background-color: #3b82f6;
        }
        .text-iv-pro{
            color: #f1f1f1;
            font-size: 15px;
            font-weight: 400;
        }
        .text-iv-pro:hover{
            color: #f7f7f7;
        }
        .prive-other-pr:hover{
            background-color: #1d4ed8;
            transition: .2s ease;
        }
        .code-product, .time-product{
            font-weight: 500;
            margin: 5px;
        }
        table, th, td {
            border: 0 !important;
        }
        .footer-iv{
            border: 1px dashed #a1a1a1;
            border-radius: 20px !important;
        }
        .price-iv{
            font-weight: 500;
            text-align: end;
        }
        .footer-iv td{
            padding: 3px 10px !important;
        }
        .iv-total{
            font-size: 18px;
            font-weight: 600;
        }
        .total-iv{
            font-size: 16px;
            font-weight: 600;
            color: #c91c08c7 !important;
        }
        .bg-danger-bur{
            background-color: #ff51001a;
        }
        .info-receiver{
            padding: 20px;
            border: 1px solid #313131;
            border-radius: 20px;
        }
        .text-bold{
            font-weight: bold;
        }
        .text-normal{
            font-weight: normal;
        }
        .text-end{
            text-align: end;
        }
        .text-center{
            text-align: center;
        }
        .mt-5{
            margin-top: 30px
        }
        .uk-flex{
            display: flex;
        }
        .uk-content-center{
            justify-content: center;
        }
        .uk-space-between{
            justify-content: space-between;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-top: 0;
            margin-right: -15px;
            margin-left: -15px;
        }
        .mb-4 {
            margin-bottom: 20px;
        }
        .col {

            flex: 1 0 0%;
        }
    </style>
</head>
    <body>
        <section class="ec-page-content section-space-p">
            <div class="container">
                <div class="row mb-4">
                    <div class="card-head">
                        <h3 class="title-invoice">Xác nhận đơn hàng thành công</h3>
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
                                    <div class="code-product">Mã #{{ $data['order']->code }}</div>
                                    <div class="time-product">{{ convertDateTime($data['order']->created_at) }}</div>
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
                                        @foreach ($data['cart'] as $key => $val)
                                            @php
                                                $name = $val->name;
                                                $qty = $val->qty;
                                                $price = convert_price($val->price, true);
                                                $priceOriginal = convert_price($val->priceOriginal, true);
                                                $subtotal = convert_price($val->price * $qty, true);
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
                                            <td colspan="4" class="price-iv">Mã giảm giá</td>
                                            <td class="text-end">
                                                {{ isset($data['cartPromotion']['selectedPromotion']) ? $data['cartPromotion']['selectedPromotion']->code : ' ' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="price-iv">Tổng giá trị</td>
                                            <td class="text-end">{{ convert_price($data['cartCaculate']['discount'] + $data['cartCaculate']['cartTotal'], true) }}₫</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="price-iv">Khuyến mãi</td>
                                            <td class="text-end">-{{ convert_price($data['cartCaculate']['discount'], true) }}₫</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="price-iv">Phí giao hàng</td>
                                            <td class="text-end">0₫</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="iv-total">Tổng thanh toán</td>
                                            <td class="text-end total-iv">{{ convert_price($data['cartCaculate']['cartTotal'], true) }}₫</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="info-receiver mt-5">
                                <div class="text-bold">Tên người nhận:
                                    <span class="text-normal">{{ $data['order']->fullname }}</span>
                                </div>
                                <div class="text-bold">Email:
                                    <span class="text-normal">{{ $data['order']->email }}</span>
                                </div>
                                <div class="text-bold">Địa chỉ:
                                    <span class="text-normal">{{ $data['order']->address }}</span>
                                </div>
                                <div class="text-bold">Số điện thoại:
                                    <span class="text-normal">{{ $data['order']->phone }}</span>
                                </div>
                                <div class="text-bold">Hình thức thanh toán:
                                    <span class="text-normal">{{ array_column(__('payment.method'), 'title', 'name')[$data['order']->method] }}</span>
                                </div>
                                <div class="text-bold">Khác: </div>
                            </div>
                            <p class="invoice-footer">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col uk-flex uk-content-center">
                        <span class="prive-other-pr">
                            <a href="" class="text-iv-pro">Xem sản phẩm khác tại đây!</a>
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
