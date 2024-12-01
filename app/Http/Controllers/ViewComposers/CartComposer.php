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
        $cartsComposer = Cart::instance('shopping')->content();
        $cartsComposer = $this->cartService->remakeCart($cartsComposer);
        $cartConfig = $this->cartConfig();
        $cartCaculate = $this->cartService->reCaculateCart();
        $cartPromotion = $this->cartService->cartPromotion($cartCaculate['cartTotal']);

        // dd($cartPromotion);
        $view->with(compact(
            'cartsComposer',
             'cartConfig',
             'cartCaculate',
             'cartPromotion',
            ));
    }


    private function cartConfig()
    {
        return [
            'cartTotal' => Cart::instance('shopping')->total(),
        ];
    }
}
