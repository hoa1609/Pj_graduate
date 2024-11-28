<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\OrderServiceInterface as OrderService;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;

use Illuminate\Http\Request;


class OrderController extends Controller{

    protected $orderService;
    protected $orderRepository;
    protected $provinceRepository;

    public function __construct(
        OrderService $orderService,
        OrderRepository $orderRepository,
        ProvinceRepository $provinceRepository,
    ) {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'order.index');
        $orders = $this->orderService->paginate($request);

        // $config['seo'] = __('messages.menu');
        $config = $this->configIndex();
        $template = 'backend.order.index';
        $config['seo'] = config('apps.order.index');
        return view('backend.dashboard.layout', compact(
            // 'config',
            'template',
            'config',
            'orders',
        ));
    }

    public function detail(Request $request, $id) {
        $order = $this->orderRepository->getOrderById($id, ['products']);
        $order = $this->orderService->getOrderItemImage($order);
        $provinces = $this->provinceRepository->all();

        $config = $this->configIndex();

        $config['seo'] = config('apps.order.detail');
        $template = 'backend.order.detail';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'order',
            'provinces',

        ));
    }

    private function configIndex(){
        return [
            'js' => [
                'backend/assets/library/order.js',
                'backend/assets/js/select2_4.1.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'

            ],
            'model' => 'Order'
        ];
    }

}
