<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\OrderServiceInterface as OrderService;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
// use App\Repositories\Interfaces\OrderCatalogueRepositoryInterface as OrderCatalogueRepository;


class OrderController extends Controller{

    protected $orderService;
    protected $orderRepository;
    // protected $orderCatalogueRepository;

    public function __construct(
        OrderService $orderService,
        OrderRepository $orderRepository,
        // OrderCatalogueRepository $orderCatalogueRepository,
    ) {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
        $this->orderCatalogueRepository = $orderCatalogueRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'order.index');

        $perPage = $request->integer('perPage', 10);
        $orders = $this->orderService->paginate($request, $perPage, 1);

        // $config['seo'] = __('messages.order');
        $template = 'backend.order.order.index';
        return view('backend.dashboard.layout', compact(
            // 'config',
            'template',
            'orders',
        ));
    }
}
