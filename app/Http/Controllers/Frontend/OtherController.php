<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;


class OtherController extends FrontendController
{
    public function intro(){
        $seo = [
            'meta_title' => 'Giới thiệu',
            'meta_keyword' => '',
            'meta_description' => '',
            'canonical' => write_url('gioi-thieu'),
        ];
        return view('frontend.intro.index', compact(
            'seo',
        ));
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
