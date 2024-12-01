<?php

namespace App\Http\Controllers\Payment\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
use App\Services\Interfaces\OrderServiceInterface as OrderService;

class MomoController extends FrontendController{

    protected $orderRepository;
    protected $orderService;
    public function __construct(
        OrderRepository $orderRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
        parent::__construct();
    }

    public function momo_return(Request $request)
    {
        echo 32323;die();
        
    }

    

}
