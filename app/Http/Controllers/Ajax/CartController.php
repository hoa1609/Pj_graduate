<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\ProductRepositoryInterface  as ProductRepository;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends FrontendController
{
    protected $cartService;
    protected $productRepository;
    protected $language;

    public function __construct(
        CartService $cartService,
        ProductRepository $productRepository,
    ){
        $this->cartService = $cartService;
        $this->productRepository = $productRepository;
        parent::__construct(); 
    }

    public function create(Request $request){
        $flag = $this->cartService->create($request, $this->language);
        
        $cart = Cart::instance('shopping')->content();
        return response()->json([
            'cart' => $cart,
            'messages' => 'Thêm sản phẩm thành công',
            'code' => ($flag) ? 10 : 11,
        ]);
    }

    
}
