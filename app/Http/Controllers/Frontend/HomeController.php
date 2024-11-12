<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\SlideRepositoryInterface as SlideRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Services\Interfaces\WidgetServiceInterface as WidgetService;

use Illuminate\Http\Request;


class HomeController extends FrontendController{

    protected $language;
    protected $slideRepository;
    protected $productRepository;
    protected $widgetService;

    public function __construct(
        SlideRepository $slideRepository,
        ProductRepository $productRepository,
        WidgetService $widgetService,
    ){
        $this->slideRepository = $slideRepository;
        $this->productRepository = $productRepository;
        $this->widgetService = $widgetService;

        parent::__construct();
     }
  


     public function index(){
         $config = $this->config();

         $widget = [
            'category' => $this->widgetService->findWidgetByKeyword('category', $this->language, ['children' => true]),
         ];

        $slides = $this->slideRepository->findByCondition(...$this->slideAgrument());
        $products = $this->productRepository->all(['languages', 'product_variants']);
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
