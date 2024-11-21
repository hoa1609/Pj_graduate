<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Models\System;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;

use Illuminate\Http\Request;


class ProductCatalogueController extends FrontendController{

    protected $language;
    protected $system;
    protected $productCatalogueRepository;


    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository,
    ){
        $this->productCatalogueRepository = $productCatalogueRepository;
        parent::__construct();
     }


     public function index($id){
        $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($id, $this->language);
        
        $config = $this->config();
        $system = $this->system;
       
        $seo = [
            
        ];
        return view('frontend.product.catalogue.index', compact(
            'config',
            'system',
            'seo',
            'productCatalogue',
        ));
    }




    private function config(){
        return [
            'language' => $this->language,
        ];
    }


}
