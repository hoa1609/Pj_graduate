<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Http\Requests\StoreCartRequest;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends FrontendController{

    protected $system;
    protected $provinceRepository;
    protected $promotionRepository;
    protected $orderRepository;
    protected $cartService;


    public function __construct(
        ProvinceRepository $provinceRepository,
        PromotionRepository $promotionRepository,
        OrderRepository $orderRepository,
        CartService $cartService,
    ){
        $this->provinceRepository = $provinceRepository;
        $this->promotionRepository = $promotionRepository;
        $this->orderRepository = $orderRepository;
        $this->cartService = $cartService;
        parent::__construct();
    }

    public function checkout(){
        $provinces = $this->provinceRepository->all();
        $carts = Cart::instance('shopping')->content();
        $carts = $this->cartService->remakeCart($carts);
        $cartConfig = $this->cartConfig();
        $cartCaculate = $this->cartService->reCaculateCart();
        $cartPromotion = $this->cartService->cartPromotion($cartCaculate['cartTotal']);

        $seo = [
            'meta_title' => 'Trang thanh toán',
            'meta_keyword' => '',
            'meta_description' => '',
            'canonical' => write_url('thanh-toan', true, true),
        ];
        $system = $this->system;
        $config = $this->config();
        return view('frontend.cart.index', compact(
            'config',
            'seo',
            'system',
            'provinces',
            'carts',
            'cartConfig',
            'cartPromotion',
            'cartCaculate',
        ));
    }

    public function store(StoreCartRequest $request){
        $system = $this->system;
        $order = $this->cartService->order($request, $system);
        if($order['flag']){
            return redirect()->route('cart.success', ['code' => $order['order']->code])->with('success', 'Đặt hàng thành công!');
        }
        return redirect()->route('cart.checkout')->with('error', 'Đặt hàng không thành công!');
    }

    public function success($code){
        $order = $this->orderRepository->findByCondition([
            ['code', '=', $code]
        ], false, ['products']);

        $seo = [
            'meta_title' => 'Trang thanh toán hóa đơn thành công',
            'meta_keyword' => '',
            'meta_description' => '',
            'canonical' => write_url('cart/success', true, true),
        ];
        $system = $this->system;
        $config = $this->config();
        return view('frontend.cart.success', compact(
            'config',
            'seo',
            'system',
            'order',
        ));
    }




    private function cartConfig(){
        return [
            'cartTotal' => Cart::instance('shopping')->total(),
        ];
    }

    private function config(){
        return [
            'language' => $this->language,
            'js' => [
                'backend/assets/library/location.js',
                'frontend/assets/library/cart.js',
            ]
        ];
    }


}
