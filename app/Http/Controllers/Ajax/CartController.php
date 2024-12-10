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
        $cartView = view('frontend.cart.partials.cart_list', compact('cart'))->render(); /*--*/

        return response()->json([
            'html' => $cartView,
            'cart' => $cart,
            'messages' => 'Thêm sản phẩm thành công!',
            'code' => ($flag) ? 10 : 11,
        ]);
    }

    public function update(Request $request){
        $response = $this->cartService->update($request);
        return response()->json([
            'response' => $response,
            'messages' => 'Cập nhật số lượng thành công!',
            'code' => (!$response) ? 11 : 10,
        ]);
    }


    public function delete(Request $request){
        $response = $this->cartService->delete($request);
        return response()->json([
            'response' => $response,
            'messages' => 'Xóa sản phẩm thành công!',
            'code' => (!$response) ? 11 : 10,
        ]);
    }

    
}
