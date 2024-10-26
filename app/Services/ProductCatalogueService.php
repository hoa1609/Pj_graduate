<?php

namespace App\Services;

use App\Services\Interfaces\ProductCatalogueServiceInterface;
use App\Services\Interfaces\BaseServiceInterface;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Str;

/**
 * Class ProductCatalogueService
 * @package App\Services
 */
class ProductCatalogueService extends BaseService implements ProductCatalogueServiceInterface
{
    protected $productCatalogueRepository;
    protected $routerRepository;
    protected $nestedset;
    protected $language;
    protected $controllerName = 'ProductCatalogueController';
    

    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository,
        RouterRepository $routerRepository,
    ){
        $this->language = $this->currentLanguage();
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->routerRepository = $routerRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' => $this->language,
        ]);
    }

    public function paginate ($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'where' => [
                ['tb2.language_id', '=', $this->language]
            ]
        ];
        $perPage = $request->integer('perpage', 10);
        $productCatalogues = $this->productCatalogueRepository->pagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'product/catalogue/index'], 
            ['product_catalogues.lft','ASC'],
            [
                ['product_catalogue_language as tb2', 'tb2.product_catalogue_id', '=', 'product_catalogues.id']
            ] , 
        );
        return $productCatalogues;
    }

    public function create($request){
        DB::beginTransaction();
        try{
            $productCatalogue = $this->createCatalogue($request);
            if($productCatalogue->id >0){
                $this->updateLanguageForCatalogue($productCatalogue, $request);
                $this->createRouter($productCatalogue, $request, $this->controllerName);
                $this->nestedset();
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

    private function createCatalogue($request){
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        $payload['user_id'] = Auth::id();
        $productCatalogue = $this->productCatalogueRepository->create($payload);
        return $productCatalogue;
    }

    private function updateLanguageForCatalogue($productCatalogue, $request){
        $payload = $this->formatLanguagePayload($productCatalogue, $request);
        $productCatalogue->languages()->detach($this->language, $productCatalogue->id);
        $language = $this->productCatalogueRepository->createPivot($productCatalogue, $payload, 'languages');
        return $language;
    }

    private function formatLanguagePayload($productCatalogue, $request){
        $payload = $request->only($this->payloadLanguage());
        $payload['canonical'] =Str::slug($payload['canonical']);
        $payload['language_id'] = $this->currentLanguage();
        $payload['product_catalogue_id'] = $productCatalogue->id;
        return $payload;

    }
    
    private function updateCatalogue($productCatalogue, $request){
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        $flag = $this->productCatalogueRepository->update($productCatalogue->id, $payload);
        return $flag;
    }

    public function update($id, $request){
        DB::beginTransaction();
        try{
            $productCatalogue = $this->productCatalogueRepository->findById($id);
            $flag = $this->updateCatalogue($productCatalogue, $request);
            if($flag == TRUE){
                $this->updateLanguageForCatalogue($productCatalogue, $request);
                $this->updateRouter($productCatalogue, $request, $this->controllerName);
                $this->nestedset();
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

    public function destroy($id){
        DB::beginTransaction();
        try{
            $productCatalogue = $this->productCatalogueRepository->delete($id);
            $this->nestedset->Get('level ASC, order ASC');
            $this->nestedset->Recursive(0, $this->nestedset->Set());
            $this->nestedset->Action();

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
            $productCatalogues = $this->productCatalogueRepository->update($product['modelId'], $payload);
            // $this->changeUserStatus($product, $payload[$product['field']]);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function updateStatusAll($product){
        DB::beginTransaction();
        try{
            $payload[$product['field']] = $product['value'];
            $flag = $this->productCatalogueRepository->updateByWhereIn('id', $product['id'], $payload);
            // $this->changeUserStatus($product, $product['value']);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    
  
    private function paginateSelect(){
        return [
            'product_catalogues.id', 
            'product_catalogues.publish',
            'product_catalogues.image',
            'product_catalogues.level',
            'product_catalogues.order',
            'tb2.name', 
            'tb2.canonical',
        ];
    }

    private function payload(){
        return [
            'parent_id',
            'follow',
            'publish',
            'image',
            'album',
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
