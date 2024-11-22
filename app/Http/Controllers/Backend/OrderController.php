<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\OrderServiceInterface as OrderService;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;

use Illuminate\Http\Request;


class OrderController extends Controller{

    protected $orderService;
    protected $orderRepository;

    public function __construct(
        OrderService $orderService,
        OrderRepository $orderRepository,
    ) {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'order.index');

        $perPage = $request->integer('perPage', 10);
        $orders = $this->orderService->paginate($request, $perPage, 1);

        // $config['seo'] = __('messages.menu');
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
        $order = $this->orderRepository->findByCondition([
            ['id', '=', $id],
        ], false, ['products']);

        $order = $this->orderService->getOrderItemImage($order);
        $config['seo'] = config('apps.order.detail');
        $template = 'backend.order.detail';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'order',

        ));
    }
}
