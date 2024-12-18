<?php

namespace App\Http\Controllers\Ajax;

use App\Repositories\Interfaces\ProductRepositoryInterface  as ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepositoryInterface  as ProductVariantRepository;
use App\Repositories\Interfaces\PromotionRepositoryInterface  as PromotionRepository;
use App\Services\Interfaces\ProductServiceInterface as ProductService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;


class ProductController extends Controller
{
    protected $productRepository;
    protected $productVariantRepository;
    protected $promotionRepository;
    protected $productService;
    protected $language;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        PromotionRepository $promotionRepository,
        ProductService $productService,
    ){
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->promotionRepository = $promotionRepository;
        $this->productService = $productService;
        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            return $next($request);
        });
    }

    //-------------- Khuyến mãi-------------
    public function loadProductPromotion(Request $request) {
        $get = $request->input();
        $loadClass = loadClass($get['model']);

        if($get['model'] == 'Product'){

            $condition = [
                ['tb2.language_id', '=', $this->language]
            ];
            if(isset($get['keyword']) && $get['keyword'] !='' ) {
                $keywordCondition = ['tb2.name', 'LIKE', '%'.$get['keyword'].'%'];
                array_push($condition, $keywordCondition);
            }

            $objects = $this->productRepository->findProductForPromotion($condition);
        }else if($get['model'] == 'ProductCatalogue'){
            $conditonArray['keyword'] = ($get['keyword']) ?? null;
            $conditonArray['where'] = [
                ['tb2.language_id', '=', $this->language]
            ];
            $objects = $loadClass->pagination(
                [
                    'product_catalogues.id',
                    'tb2.name'
                ],
                $conditonArray,
                20,
                ['path' => 'product.catalogue.index'],
                ['product_catalogue_id', 'DESC'],
                [
                    ['product_catalogue_language as tb2', 'tb2.product_catalogue_id', '=',
                    'product_catalogues.id']
                ],
                []
            );
         }

        return response()->json([
            'model' => ($get['model']) ??'Product',
            'objects' => $objects,
        ]);
    }

    public function loadVariant(Request $request){
        $get = $request->input();
        $attributeId = $get['attribute_id'];
        
        $attributeId = sorAttributeId($attributeId);
        $variant  = $this->productVariantRepository->findVariant($attributeId, $get['product_id'], $get['language_id']);

        $variantPromotion = $this->promotionRepository->findPromotionByVariantUuid($variant->uuid);
        $variantPrice = getVariantPrice($variant, $variantPromotion);

        return response()->json([
            'variant' => $variant,
            'variantPrice' => $variantPrice,
        ]);
    }


    public function filter(Request $request){
        $products = $this->productService->filter($request);
        $productId = $products->pluck('id')->toArray();
        if(count($productId) && !is_null($productId)) {
            $products = $this->productService->combineProductsAndPromotion($productId, $products);
        }

        $html = '';
        if($products->isEmpty()) {
            $html .= '<div class="text-center">';
            $html .= '<img src="frontend/assets/images/icons/product-null.svg" alt="icon" width="180px">';
            $html .= '</div>';
            $html .= '<p class="text-cart-null">Không tìm thấy sản phẩm!</p>';
            return response()->json([
                'data' => $html,
            ]);
        }

        foreach ($products as $product) {
            $html .= '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">';
            $html .= view('frontend.component.product-item', compact('product'))->render();
            $html .= '</div>';
            $html .= $products->links('pagination::bootstrap-4');
        }
    
        return response()->json([
            'data' => $html,
        ]);
    }

}
