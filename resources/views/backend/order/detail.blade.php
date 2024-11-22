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
                            <h4 class="card-title">Đơn hàng #234755</h4>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary"></i> Xác nhận</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                              <tr>
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
                                            <img src="{{ $image }}" class="me-1" alt="" height="40">
                                            <p class="d-inline-block align-middle mb-0">
                                                <span class="d-block align-middle mb-0 product-name text-body">{{ $name }}</span>
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
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Đã mua - Đang chờ giao hàng</h4>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="text-secondary"><i class="fas fa-download me-1"></i> Tải xuống hóa đơn</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="position-relative m-4">
                        <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
                          <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <div class="position-absolute top-0 start-0 translate-middle bg-primary text-white rounded-pill thumb-md"><i class="iconoir-home"></i></div>
                        <div class="position-absolute top-0 start-50 translate-middle bg-primary-subtle text-primary rounded-pill thumb-md"><i class="iconoir-delivery-truck"></i></div>
                        <div class="position-absolute top-0 start-100 translate-middle bg-light text-dark rounded-pill thumb-md"><i class="iconoir-map-pin"></i></div>
                    </div>
                    <div class="row row-cols-3">
                        <div class="col text-start">
                            <h6 class="mb-1">Đã tạo đơn hàng</h6>
                            <p class="mb-0 text-muted fs-12 fw-medium">20/11/2024</p>
                        </div>
                        <div class="col text-center">
                            <h6 class="mb-1">Đang giao hàng</h6>
                            <p class="mb-0 text-muted fs-12 fw-medium">20/11/2024</p>
                        </div>
                        <div class="col text-end">
                            <h6 class="mb-1">Dự kiến</h6>
                            <p class="mb-0 text-muted fs-12 fw-medium">23/11/2024</p>
                        </div>
                    </div> <!-- end row -->
                    <div class="bg-primary-subtle p-2 border-dashed border-primary rounded mt-3">
                        <span class="text-primary fw-semibold">Ghi chú :</span><span class="text-primary fw-normal"> {{ $order->description ?? 'Không có ghi chú!' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Tóm tắt đơn hàng</h4>
                        </div>
                        <div class="col-auto">
                            <span class="badge rounded text-warning bg-warning-subtle fs-12 p-1">Chưa giao</span>
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
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Thông tin đặt hàng</h4>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="text-secondary"><i class="fas fa-pen me-1"></i> Sửa</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div>

                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-people-tag text-secondary fs-20 align-middle me-1"></i>Họ và tên :</p>
                            <p class="text-body-emphasis fw-semibold">
                                {{ $order->fullname }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-mail text-secondary fs-20 align-middle me-1"></i>Email :</p>
                            <p class="text-body-emphasis fw-semibold">
                                {{ $order->email }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="las la-phone-volume text-secondary fs-20 align-middle me-1"></i>Số điện thoại :</p>
                            <p class="text-body-emphasis fw-semibold"><span class="text-primary">{{ $order->phone }}</span></p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-calendar text-secondary fs-20 align-middle me-1"></i>Ngày đặt hàng :</p>
                            <p class="text-body-emphasis fw-semibold">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold"><i class="iconoir-map-pin text-secondary fs-20 align-middle me-1"></i>Địa chỉ :</p>
                            <p class="text-body-emphasis fw-semibold">
                                {{ $order->address }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



