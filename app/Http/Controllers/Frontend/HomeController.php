<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\SlideRepositoryInterface as SlideRepository;
use App\Services\Interfaces\WidgetServiceInterface as WidgetService;
use App\Services\Interfaces\SlideServiceInterface as SlideService;

use Illuminate\Http\Request;
use App\Enums\SlideEnum;


class HomeController extends FrontendController{

    protected $language;
    protected $slideRepository;
    protected $widgetService;
    protected $slideService;

    public function __construct(
        SlideRepository $slideRepository,
        WidgetService $widgetService,
        SlideService $slideService,
    ){
        $this->slideRepository = $slideRepository;
        $this->widgetService = $widgetService;
        $this->slideService = $slideService;

        parent::__construct();
     }
  

    public function index(){
        $config = $this->config();

        $widgets = $this->widgetService->getWidget([
            ['keyword' =>'category', 'countObject' => true],
            ['keyword' =>'product'],
            ['keyword' =>'other-product', 'children' => true, 'promotion' => true, 'object' => true],
            ['keyword' =>'best-seller'],
            ['keyword' =>'blog', 'object' => true],
        ], $this->language);

    
        $slides = $this->slideService->getSlide([SlideEnum::MAIN, SlideEnum::SELLER], $this->language);
        $system = $this->system;
        $seo = [
            'meta_title' => $system['seo_meta_title'],
            'meta_keyword' => $system['seo_meta_keyword'],
            'meta_description' => $system['seo_meta_description'],
            'canonical' => config('app.url'),
        ];
        return view('frontend.homepage.home.index', compact(
            'config',
            'slides',
            'widgets',
            'system',
            'seo',
        ));
    }


    private function config(){
        return [
            'language' => $this->language,
        ];
    }


}
// ['keyword' => 'category','children' => true, 'promotion' => true,'object' => true, 'countObject' => true], 