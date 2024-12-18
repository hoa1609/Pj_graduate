<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Services\Interfaces\ProductCatalogueServiceInterface as ProductCatalogueService;

class ProductCatalogueController extends FrontendController{

    protected $language;
    protected $system;
    protected $productCatalogueRepository;
    protected $productService;
    protected $productCatalogueService;


    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository,
        ProductCatalogueService $productCatalogueService,
        ProductService $productService,
    ){
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->productCatalogueService = $productCatalogueService;
        $this->productService = $productService;
        parent::__construct();
    }


    public function index($id, $request, $page = 1){
        $config = $this->config();
        $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($id, $this->language);
        $breadcrumb = $this->productCatalogueRepository->breadcrumb($productCatalogue, $this->language);

        $filters = $this->filter($productCatalogue);
        /* -----------  */ 
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
    
        $system = $this->system;
        $seo = seo($productCatalogue, $page);
    
        return view('frontend.product.catalogue.index', compact(
            'config',
            'system',
            'seo',
            'productCatalogue',
            'breadcrumb',
            'products',
            'filters',
        ));
    }

    private function filter($productCatalogue){
        $filters = null;
        if(isset($productCatalogue->attribute) && !is_null($productCatalogue->attribute)){
            $filters = $this->productCatalogueService->getFilterList($productCatalogue->attribute, $this->language);
        }
        return $filters;
    }
     

    private function config(){
        return [
            'language' => $this->language,
            'js' => [
                'frontend/assets/library/cart.js',
                'frontend/assets/library/filter.js',
                'frontend/assets/js/quickview.js',
                'frontend/assets/js/price-range.js',
            ]
        ];
    }

}
