<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;


class CartController extends FrontendController{

    protected $system;

    public function __construct(

    ){
        parent::__construct();
    }

    public function checkout(){
        $cart = Cart::instance('shopping')->content();
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
            
        ));
    }


    private function config(){
        return [
            'language' => $this->language,
            
        ];
    }


}
