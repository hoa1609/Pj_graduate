<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Interfaces\OrderServiceInterface as OrderService;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;

class OrderController extends Controller {

    protected $orderService;
    protected $orderRepository;
    public function __construct(OrderService $orderService, OrderRepository $orderRepository)
    {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
    }

    public function update(Request $request)
    {

        if($this->orderService->update($request)) {

            $order = $this->orderRepository->getOrderById($request->input('id'));
            return response()->json([
                'error' => 10,
                'messages' => 'Cập nhật dữ liệu thành công',
                'order' => $order
            ]);
        }

        return response()->json([
            'error' => 11,
            'messages' => 'Cập nhật dữ liệu thất bại'
        ]);

    }

    public function chart(Request $request){
        $chart = $this->orderService->ajaxOrderChart($request);
    }

}
