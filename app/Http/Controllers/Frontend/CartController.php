<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Http\Requests\StoreCartRequest;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Classes\Vnpay;
use App\Classes\Momo;
use Illuminate\Support\Facades\Auth;

class CartController extends FrontendController
{

    protected $system;
    protected $provinceRepository;
    protected $promotionRepository;
    protected $orderRepository;
    protected $customerRepository;
    protected $cartService;
    protected $vnpay;
    protected $momo;


    public function __construct(
        ProvinceRepository $provinceRepository,
        PromotionRepository $promotionRepository,
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository,
        CartService $cartService,
        Vnpay $vnpay,
        Momo $momo,
    ) {
        $this->provinceRepository = $provinceRepository;
        $this->promotionRepository = $promotionRepository;
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->cartService = $cartService;
        $this->vnpay = $vnpay;
        $this->momo = $momo;
        parent::__construct();
    }

    public function checkout(){
        $provinces = $this->provinceRepository->all();
        $carts = Cart::instance('shopping')->content();
        $carts = $this->cartService->remakeCart($carts);
        $cartConfig = $this->cartConfig();
        $cartCaculate = $this->cartService->reCaculateCart();
        $cartPromotion = $this->cartService->cartPromotion($cartCaculate['cartTotal']);

        $customer =  Auth::guard('customer')->user();
        $seo = [
            'meta_title' => 'Trang thanh toán',
            'meta_keyword' => '',
            'meta_description' => '',
            'canonical' => write_url('thanh-toan', true, true),
        ];
        $config = $this->config();
        return view('frontend.cart.index', compact(
            'config',
            'seo',
            'provinces',
            'carts',
            'cartConfig',
            'cartPromotion',
            'cartCaculate',
            'customer',
        ));
    }

    public function store(StoreCartRequest $request){
        $system = $this->system;
        $carts = Cart::instance('shopping')->content();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.checkout')->with('error', 'Giỏ hàng của bạn đang trống!');
        }
        $order = $this->cartService->order($request, $system);
        if ($order['flag']) {
            $response = $this->paymentMethod($request ,$order);
            $this->cartService->mail($order['order'], $system);
            Cart::instance('shopping')->destroy();

            if ($response['errorCode'] == 0) {
                return redirect()->away($response['url']);
            }
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
        
        $config = $this->config();
        $config['method'] = 'success';
        return view('frontend.cart.success', compact(
            'config',
            'seo',
            'order',
        ));
    }
     

    private function paymentMethod($request ,$order = null){
        $system = $this->system;    
        switch ($order['order']->method) {
            case 'vnpay':
                $response = $this->vnpay->payment($order['order']);
                break;
            case 'momo':
                $response = $this->momo->payment($order['order']);
                break;
            case 'cod':
                $response = [
                    'errorCode' => 0, 
                    'message' => 'Đặt hàng thành công!',
                    'url' => route('cart.success', ['code' => $order['order']->code]),
                ];
                break;
        default:
        }
        return $response;
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
                'backend/assets/js/select2_4.1.min.js',
                
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
        ];
    }

}
