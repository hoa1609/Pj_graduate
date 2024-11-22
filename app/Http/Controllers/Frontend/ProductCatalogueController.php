<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Services\Interfaces\ProductServiceInterface as ProductService;


use Illuminate\Http\Request;


class ProductCatalogueController extends FrontendController{

    protected $language;
    protected $system;
    protected $productCatalogueRepository;
    protected $productService;


    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository,
        ProductService $productService,
    ){
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->productService = $productService;
        parent::__construct();
     }


     public function index($id, $request, $page = 1)
     {
         $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($id, $this->language);
         $breadcrumb = $this->productCatalogueRepository->breadcrumb($productCatalogue, $this->language);
     
         $products = $this->productService->paginate(
             $request,
             $this->language,
             $productCatalogue,
             ['path' => $productCatalogue->canonical],
             $page
         );
     
         $productId = $products->pluck('id')->toArray();
     
         if (count($productId) && !is_null($productId)) {
             $products = $this->productService->combineProductsAndPromotion($productId, $products);
         }
     
         $config = $this->config();
         $system = $this->system;
         $seo = seo($productCatalogue, $page);
     
         return view('frontend.product.catalogue.index', compact(
             'config',
             'system',
             'seo',
             'productCatalogue',
             'breadcrumb',
             'products'
         ));
     }
     




    private function config(){
        return [
            'language' => $this->language,
        ];
    }


}
