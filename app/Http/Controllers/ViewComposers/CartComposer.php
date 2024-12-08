<?php

namespace App\Http\Controllers\ViewComposers;

use Illuminate\View\View;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComposer
{
    protected $cartService;

    public function __construct(
        CartService $cartService,
    ){
        $this->cartService = $cartService;
    }

    public function composer(View $view)
    {
        $cartsC = Cart::instance('shopping')->content();
        
        $cartsC = $this->cartService->remakeCart($cartsC);
        $cartConfig = $this->cartConfig();
        $cartCaculate = $this->cartService->reCaculateCart();
        $cartPromotion = $this->cartService->cartPromotion($cartCaculate['cartTotal']);
        
        $view->with(compact(
            'cartsC',
            'cartConfig',
            'cartPromotion',
            'cartCaculate',
        ));
    }


    private function cartConfig(){
        return [
            'cartTotal' => Cart::instance('shopping')->total(),
        ];
    }
}
