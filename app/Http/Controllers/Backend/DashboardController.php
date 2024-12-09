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

    public function index(){
        $orderStatistic = $this->orderService->orderStatistic();
        $customrStatistic = $this->customerService->statictis();

        $config = $this->config();
        $template = 'backend.dashboard.home.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'orderStatistic',
            'customrStatistic',
        ));
    }

    private function config(){
        return [
            'js' => [
                'backend/plugins/chartJs/chart.js',
                'backend/assets/library/dashboard.js',
            ]
        ];
    }

}
