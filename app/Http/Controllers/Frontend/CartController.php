<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;


class CartController extends FrontendController{

    protected $system;
    protected $provinceRepository;


    public function __construct(
        ProvinceRepository $provinceRepository,
    ){
        $this->provinceRepository = $provinceRepository;
        parent::__construct();
    }

    public function checkout(){
        $provinces = $this->provinceRepository->all();

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
            'provinces',
            
        ));
    }


    private function config(){
        return [
            'language' => $this->language,
            'js' => [
                'backend/assets/library/location.js',
            ]
        ];
    }


}
