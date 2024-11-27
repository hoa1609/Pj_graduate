<div class="row justify-content-center">
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Đơn hàng trong tháng</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{ $orderStatistic['orderCurrentMonth'] }}</h3>
                    </div>
                    <!--end col-->
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fas fa-shopping-cart h1 align-self-center mb-0 text-secondary"></i>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <p class="mb-0 text-truncate text-muted mt-3">
                    {!! growHtml($orderStatistic['grow']) !!}
                    So với tháng trước
                </p>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Tổng số đơn hàng</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{ $orderStatistic['totalOrder'] }}</h3>
                    </div>
                    <!--end col-->
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fas fa-clipboard-list h1 align-self-center mb-0 text-secondary"></i>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <p class="mb-0 text-truncate text-muted mt-3"><span
                        class="text-success">{{ cancelRate($orderStatistic['totalOrder'], $orderStatistic['cancelOrder'] )}}%</span>
                    Tỷ lệ hủy (số đơn hủy {{$orderStatistic['cancelOrder']}})</p>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Tổng doanh thu</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{convert_price($orderStatistic['revenueOrder'], true)}}</h3>
                    </div>
                    <!--end col-->
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fas fa-chart-line h1 align-self-center mb-0 text-secondary"></i>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <p class="mb-0 text-truncate text-muted mt-3">
                    <span class="text-danger"></span>
                    Tất cả doanh thu bán được
                </p>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Tổng số khách hàng</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{$customrStatistic['totalCustomers']}}</h3>
                    </div>
                    <!--end col-->
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fas fa-users h1 align-self-center mb-0 text-secondary
                            "></i>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <p class="mb-0 text-truncate text-muted mt-3"><span class="text-danger"></span>
                    Tất cả khách hàng</p>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
