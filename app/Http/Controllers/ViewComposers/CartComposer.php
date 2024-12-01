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
        $carts = Cart::instance('shopping')->content();
        $carts = $this->cartService->remakeCart($carts);
        $cartConfig = $this->cartConfig();
        $cartCaculate = $this->cartService->reCaculateCart();
        $cartPromotion = $this->cartService->cartPromotion($cartCaculate['cartTotal']);

        // dd($cartPromotion);
        $view->with(compact(
            'carts',
            'cartConfig',
            'cartPromotion',
            'cartCaculate',
        ));
    }


    private function cartConfig()
    {
        return [
            'cartTotal' => Cart::instance('shopping')->total(),
        ];
    }
}
