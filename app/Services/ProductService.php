<?php

namespace App\Services;

use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\BaseServiceInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductVariantLanguageRepositoryInterface as ProductVariantLanguageRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductService extends BaseService implements ProductServiceInterface
{
    protected $productRepository;
    protected $routerRepository;
    protected $productVariantLanguageRepository;


    public function __construct(
        ProductRepository $productRepository,
        RouterRepository $routerRepository,
        ProductVariantLanguageRepository $productVariantLanguageRepository,
    ){
        $this->productRepository = $productRepository;
        $this->routerRepository = $routerRepository;
        $this->productVariantLanguageRepository = $productVariantLanguageRepository;
        $this->controllerName = 'ProductController';
    }

    public function paginate ($request, $languageId){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'where' => [
                ['tb2.language_id', '=', $languageId]
            ]
        ];
        $perPage = $request->integer('perpage', 10);
        $products = $this->productRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'product/index', 'groupBy' => $this->paginateSelect()],
            ['products.id', 'DESC'],
            [
                ['product_language as tb2', 'tb2.product_id', '=', 'products.id'],
                ['product_catalogue_product as tb3', 'products.id', '=', 'tb3.product_id'],
            ],
            ['product_catalogues'],
            $this->whereRaw($request),
        );
        return $products;
    }

    private function whereRaw($request){
        $rawCondition = [];
        if($request->integer('product_catalogue_id') > 0){
            $rawCondition['whereRaw'] =  [
                [
                    'tb3.product_catalogue_id IN (
                        SELECT id
                        FROM product_catalogues
                        WHERE lft >= (SELECT lft FROM product_catalogues as pc WHERE pc.id = ?)
                        AND rgt <= (SELECT rgt FROM product_catalogues as pc WHERE pc.id = ?)
                    )',
                    [$request->integer('product_catalogue_id'), $request->integer('product_catalogue_id')]
                ]
            ];
        }
        return $rawCondition;
    }


    public function create($request, $languageId){
        DB::beginTransaction();
        try{
            $product = $this->createProduct($request);
            if($product->id > 0){
                $this->updateLanguageForProduct($product, $request, $languageId);
                $this->updateCatalogueForProduct($product, $request);
                $this->createRouter($product, $request, $this->controllerName, $languageId);

                $this->createVariant($product, $request, $languageId);
            }
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    private function createVariant($product, $request, $languageId){
        $payload = $request->only(['variant','productVariant', 'attribute']);
        $variant = $this->createVariantArray($payload);
        $product->product_variants()->delete();
        $variant = $product->product_variants()->createMany($variant);
        $variantId = $variant->pluck('id');
        $productVariantLanguage = [];
            if (count($variantId)) {
                foreach ($variantId as $key => $val) {
                    $productVariantLanguage[] = [
                        'product_variant_id' => $val,
                        'language_id' => $languageId,
                        'name' => $payload['productVariant']['name'][$key],
                    ];
                }
            }
        $variantLanguage = $this->productVariantLanguageRepository->createBatch($productVariantLanguage);
    }

    private function createVariantArray(array $payload = []): array{
        $variant = [];
        if(isset($payload['variant']['sku']) && count($payload['variant']['sku']) ){
            foreach($payload['variant']['sku'] as $key => $val){
                $variant[] = [
                    'code' =>  ($payload['attribute']['id'][$key]) ?? '',

                    'sku' => $val,
                    'quantity' => ($payload['variant']['quantity'][$key]) ?? '',
                    'price' => ($payload['variant']['price'][$key]) ? convert_price($payload['variant']['price'][$key]) : '',
                    'barcode' => ($payload['variant']['barcode'][$key]) ?? '',
                    'file_name' => ($payload['variant']['file_name'][$key]) ?? '',
                    'file_url' => ($payload['variant']['file_url'][$key]) ?? '',
                    'album' => ($payload['variant']['album'][$key]) ?? '',
                    'user_id' => Auth::id()
                ];
            }
        }
        return $variant;
    }

    private function createProduct($request){
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        $payload['album'] = $this->formatAlbum($request);
        $payload['price'] = convert_price($payload['price']);
        $payload['attributeCatalogue'] = $this->formatJson($request, 'attributeCatalogue');
        dd($payload);
        $product = $this->productRepository->create($payload);
        return $product;
    }

    private function uploadProduct($product, $request){
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        $payload['price'] = convert_price($payload['price']);
        return $this->productRepository->update($product->id, $payload);
    }

    private function updateLanguageForProduct($product, $request, $languageId){
        $payload = $request->only($this->payloadLanguage());
        $payload = $this->formatLanguagePayload($payload, $product->id, $languageId);
        $product->languages()->detach([$languageId, $product->id]);
        return $this->productRepository->createPivot($product, $payload, 'languages');
    }
    private function updateCatalogueForProduct($product, $request){
        $product->product_catalogues()->sync($this->catalogue($request));
    }

    private function formatLanguagePayload($payload, $productId, $languageId){
        $payload['canonical'] =Str::slug($payload['canonical']);
        $payload['language_id'] = $languageId;
        $payload['product_id'] = $productId;
        return $payload;
    }


    private function catalogue($request){
        if($request->input('catalogue') != null){
            return array_unique(array_merge($request->input('catalogue'), [$request->product_catalogue_id]));
        }
        return [$request->product_catalogue_id];
    }

    public function update($id, $request, $languageId){
        DB::beginTransaction();
        try{
            $product = $this->productRepository->findById($id);
            if( $this->uploadProduct($product, $request)){
                $this->updateLanguageForProduct($product, $request, $languageId);
                $this->updateCatalogueForProduct($product, $request);
                $this->updateRouter($product, $request, $this->controllerName);
            }
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try{
            $productCatalogue = $this->productRepository->delete($id);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function updateStatus($product = []){
        DB::beginTransaction();
        try{
            $payload[$product['field']] = (($product['value'] == 1)?2:1);
            $productCatalogues = $this->productRepository->update($product['modelId'], $payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    public function updateStatusAll($product){
        DB::beginTransaction();
        try{
            $payload[$product['field']] = $product['value'];
            $flag = $this->productRepository->updateByWhereIn('id', $product['id'], $payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    private function paginateSelect(){
        return [
            'products.id', 
            'products.publish',
            'products.image',
            'products.order',
            'tb2.name', 
            'tb2.canonical',
        ];
    }

    private function payload(){
        return [
            'follow',
            'publish',
            'image',
            'album',
            'price',
            'made_in',
            'code',
            'product_catalogue_id',
            'attributeCatalogue',
            'attribute',
        ];
    }

    private function payloadLanguage(){
        return [
            'name',
            'description',
            'content',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'canonical'
        ];
    }
}
