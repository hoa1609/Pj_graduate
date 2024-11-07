<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Language;

class FrontendController extends Controller{

   protected $language;

    public function __construct(
        
    ){
        $this->middleware(function($request, $next){
            $locale = app()->getLocale(); 
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            return $next($request);
        });
     }
}
