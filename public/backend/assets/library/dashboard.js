(function ($) {
    "use strict";
    var HT = {};

    HT.createChart = (labels, data) => {
        let canvas = document.getElementById('barChart');
        let ctx = canvas.getContext('2d');

        // Hủy biểu đồ cũ nếu có
        if (window.myBarChart) {
            window.myBarChart.destroy();
        }

        // Dữ liệu cho biểu đồ
        let chartData = {
            labels: labels, // Danh sách nhãn trục X
            datasets: [
                {
                    label: 'Doanh thu', // Chú thích biểu đồ
                    backgroundColor: 'rgba(26,179,148,0.5)', // Màu nền
                    borderColor: 'rgba(26,179,148,0.7)', // Màu viền
                    pointBackgroundColor: 'rgba(26,179,148,1)', // Màu điểm
                    pointBorderColor: '#fff', // Màu viền điểm
                    data: data, // Dữ liệu trục Y
                }
            ]
        };

        // Tùy chọn cho biểu đồ
        let chartOptions = {
            responsive: true,
            plugins: {
                legend: {
                    display: true, // Hiển thị chú thích
                    position: 'top',
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tháng',
                    }
                },
                y: {
                    beginAtZero: true, // Bắt đầu từ 0
                    title: {
                        display: true,
                        text: 'Doanh thu (VND)',
                    }
                }
            }
        };

        // Tạo biểu đồ
        window.myBarChart = new Chart(ctx, {
            type: 'bar', // Loại biểu đồ
            data: chartData,
            options: chartOptions,
        });
    };

    // HT.changeChart = () => {
    //     $(document).on('click', '.chartButton', function (e) {
    //         e.preventDefault();
    //         let button = $(this)
    //         let chartType = button.attr('data-chart')
    //         $('.chartButton').removeClass('active')
    //         button.addClass('active')
    //         HT.callChart(chartType)
    //     })
    // };

    // HT.callChart = (chartType) => {
    //     $.ajax({
    //         type: 'GET',
    //         url: 'ajax/order/chart',
    //         data: {
    //             chartType: chartType
    //         },
    //         dataType: 'json',
    //         success: function (response) {
    //             HT.createChart(response.labels, response.data);
    //         }
    //     });
    // };

    $(document).ready(function () {
        HT.createChart(label, data);
        // HT.changeChart();
    });



})(jQuery);
