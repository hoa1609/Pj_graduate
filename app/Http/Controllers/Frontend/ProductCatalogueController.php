<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;


class ProductCatalogueController extends FrontendController{

    protected $language;
    protected $system;
    protected $productCatalogueRepository;

    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository
    ){
        $this->productCatalogueRepository = $productCatalogueRepository;
        parent::__construct();
     }
  


     public function index($id, $language){
        $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($id, $language);

        $system = $this->system;

        $slides = $this->slideRepository->findByCondition(...$this->slideAgrument());
        return view('frontend.homepage.home.index', compact(
            'config',
            'slides',
        ));
    }




    private function config(){
        return [];
    }


}
