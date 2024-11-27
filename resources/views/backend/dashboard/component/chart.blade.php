<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Biểu đồ doanh thu năm {{ date('Y') }}</h4>
                    </div>
                    <!--end col-->
                    {{-- <div class="col-auto">
                        <button type="button" class=" chartButton" data-chart="1">Biểu đồ
                            năm</button>
                        <button type="button" class=" chartButton" data-chart="30">Tháng hiện
                            tại</button>
                        <button type="button" class=" chartButton" data-chart="7">7 ngày gần
                            nhất</button>
                    </div> --}}
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end card-header-->
            <div class="card-body pt-0">
                <div id="audience_overview" class="apex-charts chartContainer">
                    <canvas id="barChart" height="100"></canvas>
                </div>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>

@php
    $data = json_encode($orderStatistic['revenueChart']['data']);
    $label = json_encode($orderStatistic['revenueChart']['label']);
@endphp

<script>
    var data = JSON.parse('{!! $data !!}');
    var label = JSON.parse('{!! $label !!}');
</script>
