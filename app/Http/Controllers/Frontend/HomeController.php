<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\SlideRepositoryInterface as SlideRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;

use Illuminate\Http\Request;


class HomeController extends FrontendController{

    protected $language;
    protected $slideRepository;
    protected $productRepository;

    public function __construct(
        SlideRepository $slideRepository,
        ProductRepository $productRepository
    ){
        $this->slideRepository = $slideRepository;
        $this->productRepository = $productRepository;


        parent::__construct();
     }
  


     public function index(){
        $config = $this->config();


        $slides = $this->slideRepository->findByCondition(...$this->slideAgrument());
        $products = $this->productRepository->all(['languages']);

        foreach ($products as $product) {
            foreach ($product->languages as $language) {
                $pivotName = $language->pivot['name'];
                // dd( $pivotName); 
            }
        }


        
        return view('frontend.homepage.home.index', compact(
            'config',
            'slides',
        ));
    }



    private function slideAgrument(){
        return [
            'condition' => [
                config('apps.general.defaultPublish'),
                ['keyword', '=', 'slide_main']
            ]
        ];
    }


    private function config(){
        return [];
    }


}
