(function ($) {
    "use strict";
    var HT = {};

    HT.createChart = (label, data) => {
        let canvas = document.getElementById('barChart');
        let ctx = canvas.getContext('2d');

        if (window.myBarChart) {
            window.myBarChart.destroy();
        }

        let chartData = {
            labels: label,
            datasets: [
                {
                    label: 'Doanh thu', 
                    backgroundColor: 'rgba(26,179,148,0.5)', 
                    borderColor: 'rgba(26,179,148,0.7)', 
                    pointBackgroundColor: 'rgba(26,179,148,1)', 
                    pointBorderColor: '#fff', 
                    borderRadius: 10, 
                    data: data, 
                }
            ]
        };

        let chartOptions = {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: ' ',
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh thu (VND)',
                    }
                }
            }
        };
        window.myBarChart = new Chart(ctx, {
            type: 'bar', 
            data: chartData,
            options: chartOptions,
        });
    };

    HT.changeChart = () => {
        $(document).on('click', '.chartButton', function (e) {
            e.preventDefault();
            let button = $(this)
            let chartType = button.attr('data-chart')
            $('.chartButton').removeClass('active')
            button.addClass('active')
            HT.callChart(chartType)
        })
    };

    HT.callChart = (chartType) => {
        console.log(chartType)
        $.ajax({
            type:  'GET',
            url:   'ajax/order/chart',
            data: {
                chartType: chartType
            },
            dataType: 'json',
            success: function (response) {
                HT.createChart(response.label, response.data);
            }
        });
    };

    $(document).ready(function () {
        HT.createChart(label, data);
        HT.changeChart();
    });



})(jQuery);
