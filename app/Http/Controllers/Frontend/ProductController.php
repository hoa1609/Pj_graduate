<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use Illuminate\Http\Request;


class ProductController extends FrontendController{

    protected $language;
    protected $system;
    protected $productCatalogueRepository;
    protected $productRepository;
    protected $productService;


    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository,
        ProductRepository $productRepository,
        ProductService $productService,
    ){
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        parent::__construct();
     }


     public function index($id, $request){
        $language = $this->language;
        $product =$this->productRepository->getProductById($id, $this->language);
        $product = $this->productService->combineProductsAndPromotion([$id], $product, true);
        $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($product->product_catalogue_id, $this->language);
        $breadcrumb = $this->productCatalogueRepository->breadcrumb($productCatalogue, $this->language);
        /*---------------*/
        $product = $this->productService->getAttribute($product, $this->language);
        $category = recursive($this->productCatalogueRepository->all(['languages']));

        $config = $this->config();
        $system = $this->system;
        $seo = seo($product);
    
        return view('frontend.product.product.index', compact(
            'config',
            'system',
            'seo',
            'productCatalogue',
            'breadcrumb',
            'product',
            'category',
            'language',
        ));
     }
     


    private function config(){
        return [
            'language' => $this->language,
            'js' => [
                'frontend/assets/library/cart.js',
            ]
        ];
    }


}
