<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\OrderServiceInterface as OrderService;
use App\Services\Interfaces\CustomerServiceInterface as CustomerService;

class DashboardController extends Controller
{

    protected $orderService;
    protected $customerService;

    public function __construct(
        OrderService $orderService,
        CustomerService $customerService,
    ) {
        $this->orderService = $orderService;
        $this->customerService = $customerService;
    }

    public function index()
    {

        $orderStatistic = $this->orderService->orderStatistic();
        $customrStatistic = $this->customerService->statictis();
        // dd($orderStatistic);

        $config = $this->config();
        $template = 'backend.dashboard.home.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'orderStatistic',
            'customrStatistic',
        ));
    }



    private function config()
    {
        return [
            'js' => [
                // 'backend/js/plugins/flot/jquery.flot.js',
                // 'backend/js/plugins/flot/jquery.flot.tooltip.min.js',
                // 'backend/js/plugins/flot/jquery.flot.spline.js',
                // 'backend/js/plugins/flot/jquery.flot.resize.js',
                // 'backend/js/plugins/flot/jquery.flot.pie.js',
                // 'backend/js/plugins/flot/jquery.flot.symbol.js',
                // 'backend/js/plugins/flot/jquery.flot.time.js',
                // 'backend/js/plugins/peity/jquery.peity.min.js',
                // 'backend/js/demo/peity-demo.js',
                // 'backend/js/inspinia.js',
                // 'backend/js/plugins/pace/pace.min.js',
                // 'backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js',
                // 'backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
                // 'backend/js/plugins/easypiechart/jquery.easypiechart.js',
                // 'backend/js/plugins/sparkline/jquery.sparkline.min.js',
                // 'backend/js/demo/sparkline-demo.js',
                // chart js
                'backend/plugins/chartJs/chart.js',
                'backend/assets/library/dashboard.js',
            ]
        ];
    }
}
