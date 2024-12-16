<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Biểu đồ doanh thu năm {{ date('Y') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="dropdown">
                            <a href="#" class="btn bt btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icofont-calendar fs-5 me-1"></i>
                                Chọn mốc thời gian<i class="las la-angle-down ms-1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="">
                                <a class="dropdown-item chartButton" data-chart="1" href="#">Biểu đồ năm</a>
                                <a class="dropdown-item chartButton" data-chart="30" href="#">Tháng hiện tại</a>
                                <a class="dropdown-item chartButton" data-chart="7" href="#">7 ngày gần nhất</a>
                                <a class="dropdown-item chartButton" data-chart="today" href="#">Hôm nay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div id="audience_overview" class="apex-charts chartContainer">
                    <canvas id="barChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $data = json_encode($orderStatistic['revenueChart']['data']);
    $label = json_encode($orderStatistic['revenueChart']['label']);
@endphp

<script>
    var data = JSON.parse('{!! $data !!}');
    var label = JSON.parse('{!! $label !!}');
</script>
