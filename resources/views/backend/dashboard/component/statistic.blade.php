<div class="row justify-content-center">
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Đơn hàng trong tháng</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{ $orderStatistic['orderCurrentMonth'] }}</h3>
                    </div>
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fas fa-shopping-cart align-self-center mb-0 text-secondary"></i>
                        </div>
                    </div>
                </div>
                
                <p class="mb-0 text-truncate text-muted mt-3">
                    {!! growHtml($orderStatistic['grow']) !!}
                    <span class="ms-2">So với tháng trước</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Tổng số đơn hàng</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{ $orderStatistic['totalOrder'] }}</h3>
                    </div>
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fas fa-clipboard-list align-self-center mb-0 text-secondary"></i>
                        </div>
                    </div>
                </div>
                
                <p class="mb-0 text-truncate text-muted mt-3">
                    <span class="text-success">{{ cancelRate($orderStatistic['totalOrder'], $orderStatistic['cancelOrder'] )}}%</span>
                    <span class="ms-2">Tỷ lệ hủy (số đơn hủy {{$orderStatistic['cancelOrder']}})</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Tổng doanh thu</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{convert_price($orderStatistic['revenueOrder'], true)}}</h3>
                    </div>
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fas fa-chart-line align-self-center mb-0 text-secondary"></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 text-truncate text-muted mt-3">
                    <span class="text-danger"></span>
                    Tất cả doanh thu bán được
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Tổng số khách hàng</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{$customrStatistic['totalCustomers']}}</h3>
                    </div>
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fas fa-users align-self-center mb-0 text-secondary
                            "></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 text-truncate text-muted mt-3"><span class="text-danger"></span>
                    Tất cả khách hàng</p>
            </div>
        </div>
    </div>
</div>
