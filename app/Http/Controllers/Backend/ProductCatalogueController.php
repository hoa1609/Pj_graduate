<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ProductCatalogueServiceInterface as ProductCatalogueService;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;

use App\Http\Requests\ProductCatalogueRequest;
use App\Http\Requests\UpdateProductCatalogueRequest;
use App\Http\Requests\DeleteProductCatalogueRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;
use App\Models\Language;


class ProductCatalogueController extends Controller {

    protected $productCatalogueService;
    protected $productCatalogueRepository;
    protected $language;


    public function __construct(
        ProductCatalogueService $productCatalogueService,
        ProductCatalogueRepository $productCatalogueRepository,
    ) {
        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1; 
            $this->initialize();
            return $next($request);
        });

        $this->productCatalogueService = $productCatalogueService;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }

    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 

    
    public function index(Request $request){
        $this->authorize('modules', 'product.catalogue.index');
        $perPage = $request->integer('perpage');
        $productCatalogues = $this->productCatalogueService->paginate($request, $this->language);

        $config = $this->configIndex();
        $config['seo'] = config('apps.productcatalogue.index');
        $template = 'backend.product.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'productCatalogues',
        ));
    }


    public function create(){
        $this->authorize('modules', 'product.catalogue.create');
        $config = $this->configStore();
        $config['method'] = 'create';
        $dropdown = $this->nestedset->Dropdown();
        $config['seo'] = config('apps.productcatalogue.create');
        $template = 'backend.product.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
        ));
    }


    public function store(ProductCatalogueRequest $request){
        if ($this->productCatalogueService->create($request, $this->language)) {
            return redirect()->route('product.catalogue.index')->with('success', 'Thêm thành công !');
        }
        return redirect()->route('product.catalogue.index')->with('error', 'Thêm thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'product.catalogue.edit');
        $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($id, $this->language);
        $album = json_decode($productCatalogue->album);
        $dropdown = $this->nestedset->Dropdown();
        
        $config = $this->configStore();
        $config['seo'] = config('apps.productcatalogue.edit');
        $config['method'] = 'edit';
        $template = 'backend.product.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'productCatalogue',
            'album',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'product.catalogue.delete');
        $config['method'] = 'delete';
        $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($id, $this->language);
        $template = 'backend.product.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'productCatalogue',
        ));
    }


    public function update($id, UpdateProductCatalogueRequest $request){
        if ($this->productCatalogueService->update($id, $request, $this->language)) {
            return redirect()->route('product.catalogue.index')->with('success', 'Cập nhập thành công !');
        }
        return redirect()->route('product.catalogue.index')->with('error', 'Cập nhập thất bại !');
    }

    
    public function destroy(DeleteProductCatalogueRequest $request, $id){
        $this->authorize('modules', 'product.catalogue.destroy');
        if ($this->productCatalogueService->destroy($id, $this->language)) {
            return redirect()->route('product.catalogue.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('product.catalogue.index')->with('error', 'Xóa thất bại!');
    }

    private function configIndex(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
        ];
    }

    private function configStore(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/assets/library/formatprice-scroll/catalogueScroll.js',
                'backend/assets/library/finder.js',
                'backend/assets/library/seo.js',
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/assets/library/renameCanonical.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
        ];
    }

}
