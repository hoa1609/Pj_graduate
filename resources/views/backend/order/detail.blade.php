<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">{{ $config['seo']['title'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title mb-0">Đơn hàng #{{ $order->code }}</h4>
                            <p class="mb-0 text-muted mt-1">
                                {{ array_column(__('payment.method'), 'title', 'name')[$order->method] ?? '-' }}
                            </p>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-secondary-subtle text-secondary fs-12">
                                <i class="fas fa-clock me-1"></i> {{ __('cart.delivery')[$order->delivery] }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Đơn hàng</th>
                                    <th class="text-end">Giá</th>
                                    <th class="text-end">Số lượng</th>
                                    <th class="text-end">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $key => $val)
                                    @php
                                        $name = $val->pivot->name;
                                        $qty = $val->pivot->qty;
                                        $price = convert_price($val->pivot->priceOriginal, true);
                                        $subtotal = convert_price($val->pivot->price * $qty, true);
                                        $image = $val->image;
                                    @endphp
                                    <tr>
                                        <td>
                                            <img src="{{ $image }}" class="me-1" alt="" height="120">

                                        </td>
                                        <td>
                                            <p class="d-inline-block align-middle mb-0">
                                                <span
                                                    class="d-block align-middle mb-0 product-name text-body">{{ $name }}</span>
                                                <span class="text-muted font-13">Chất liệu</span>
                                            </p>
                                        </td>
                                        <td class="text-end">{{ $price }} đ</td>
                                        <td class="text-end">{{ $qty }}</td>
                                        <td class="text-end"> {{ $subtotal }} đ </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="cofirm-box">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title title-confirm">{{__('order.confirm') [$order->confirm]}}</h4>
                            </div>
                            <div class="col-auto d-flex">
                                <div class="cancle-block me-3">
                                    {{ ($order->confirm == 'cancle') ? 'Đã hủy đơn hàng' : '' }}
                                </div>
                                <div class="confirm-block">
                                    @if ($order->confirm == 'pending')
                                        <button class="btn btn-primary confirm updateField" data-field="confirm"
                                            data-value="confirm" data-title="Đã xác nhận - Đang chờ giao hàng"> Xác nhận</button>
                                    @else
                                        Đã xác nhận
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if ($order->confirm == 'confirm')
                            <div class="position-relative m-4">
                                <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                                <div class="position-absolute top-0 start-0 translate-middle bg-primary text-white rounded-pill thumb-md"><i class="iconoir-home"></i></div>
                                <div class="position-absolute top-0 start-50 translate-middle bg-primary text-white rounded-pill thumb-md"><i class="fas fa-check"></i></div>
                                <div class="position-absolute top-0 start-100 translate-middle bg-primary-subtle text-primary rounded-pill thumb-md"><i class="iconoir-delivery-truck"></i></div>
                            </div>
                            <div class="row row-cols-3">
                                <div class="col text-start">
                                    <h6 class="mb-1">Đã tạo đơn hàng</h6>
                                </div>
                                <div class="col text-center">
                                    <h6 class="mb-1">Đã xác nhận</h6>
                                </div>
                                <div class="col text-end">
                                    <h6 class="mb-1">Chờ vận chuyển</h6>
                                </div>
                            </div>
                        @else
                            <div class="position-relative m-4">
                                <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
                                    <div class="progress-bar-customer" style="width: 50%"></div>
                                </div>
                                <div class="position-absolute top-0 start-0 translate-middle bg-danger text-white rounded-pill thumb-md">
                                    <i class="iconoir-home"></i>
                                </div>
                                <div class="position-absolute top-0 start-50 translate-middle bg-danger-subtle text-danger rounded-pill thumb-md">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="position-absolute top-0 start-100 translate-middle bg-light text-dark rounded-pill thumb-md">
                                    <i class="iconoir-map-pin"></i>
                                </div>
                            </div>
                            <div class="row row-cols-3">
                                <div class="col text-start">
                                    <h6 class="mb-1">Đã tạo đơn hàng</h6>
                                    {{-- <p class="mb-0 text-muted fs-12 fw-medium">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</p> --}}
                                </div>
                                <div class="col text-center">
                                    <h6 class="mb-1">Chờ xác nhận</h6>
                                    {{-- <p class="mb-0 text-muted fs-12 fw-medium">20/11/2024</p> --}}
                                </div>
                                <div class="col text-end">
                                    <h6 class="mb-1">Dự kiến</h6>
                                    {{-- <p class="mb-0 text-muted fs-12 fw-medium">23/11/2024</p> --}}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">

                    <div class="ibox">
                        <div class="text-end mt-3">
                            <div class="text-secondary edit edit-order" data-target="description">
                                <i class="fas fa-pen me-1"></i> Sửa
                            </div>
                        </div>
                        <div class="bg-primary-subtle p-2 border-dashed border-primary rounded mt-1">
                            <div class="ibox-content">
                                <span class="text-primary fw-semibold">Ghi chú :</span>
                                <span class="text-primary fw-normal description-content">
                                    {{ $order->description ?? 'Không có ghi chú!' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 order-aside">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Tóm tắt đơn hàng</h4>
                        </div>
                        <div class="col-auto">
                            <span class="badge rounded text-warning bg-warning-subtle fs-12 p-1">
                                {{ __('cart.payment')[$order->payment] }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold">Tổng tiền :</p>
                            <p class="text-body-emphasis fw-semibold">
                                {{-- {{ convert_price($order->cart['cartTotal'], true) }} đ --}}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold">Giảm giá :</p>
                            <p class="text-danger fw-semibold">
                                {{-- {{ convert_price($order->promotion['discount'], true) }} đ --}}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold mb-0">Chi phí vận chuyển :</p>
                            <p class="text-body-emphasis fw-semibold mb-0">0 đ</p>
                        </div>
                    </div>
                    <hr class="hr-dashed">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Tổng :</h4>
                        <h4 class="mb-0">
                            {{-- {{ convert_price($order->cart['cartTotal'] - $order->promotion['discount'] , true) }} đ --}}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card ibox">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Thông tin đặt hàng</h4>
                        </div>
                        <div class="col-auto">
                            <div class="text-secondary edit edit-order" data-target="customerInfo">
                                <i class="fas fa-pen me-1"></i> Sửa
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="ibox-content order-customer-information">
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i
                                    class="iconoir-people-tag text-secondary fs-20 align-middle me-1"></i>Họ và tên :
                            </p>
                            <p class="text-body-emphasis fw-semibold">
                                <span class="fullname">{{ $order->fullname }}</span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i
                                    class="iconoir-mail text-secondary fs-20 align-middle me-1"></i>Email :</p>
                            <p class="text-body-emphasis fw-semibold">
                                <span class="email">{{ $order->email }}</span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i
                                    class="las la-phone-volume text-secondary fs-20 align-middle me-1"></i>Số điện
                                thoại :</p>
                            <p class="text-body-emphasis fw-semibold">
                                <span class="phone text-primary">{{ $order->phone }}</span>
                            </p>
                        </div>
                        {{-- <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-calendar text-secondary fs-20 align-middle me-1"></i>Ngày đặt hàng :</p>
                            <p class="text-body-emphasis fw-semibold">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</p>
                        </div> --}}
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold"><i
                                    class="iconoir-map-pin text-secondary fs-20 align-middle me-1"></i>Địa chỉ :</p>
                            <p class="text-body-emphasis fw-semibold">
                                <span class="address"> {{ $order->address }}</span>
                                {{ $order->ward_name }}<br>

                                {{ $order->district_name }}

                                {{ $order->province_name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<input type="hidden" class="orderId" value="{{ $order->id }}">
<input type="hidden" class="ward_id " value="{{ $order->ward_id }}">
<input type="hidden" class="district_id " value="{{ $order->district_id }}">
<input type="hidden" class="province_id " value="{{ $order->province_id }}">


<script>
    var provinces = @json(
        $provinces->map(function ($item) {
                return [
                    'id' => $item->code,
                    'name' => $item->name,
                ];
            })->values());
</script>
