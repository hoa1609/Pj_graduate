<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface as AttributeCatalogueRepository;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class ProductController extends Controller{

    protected $productService;
    protected $productRepository;
    protected $language;
    protected $attributeCatalogue;

    public function __construct(
        ProductService $productService,
        ProductRepository $productRepository,
        AttributeCatalogueRepository $attributeCatalogue,
    ){
        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1; 
            $this->initialize();
            return $next($request);
        });

        $this->productService = $productService;
        $this->productRepository = $productRepository;
        $this->attributeCatalogue = $attributeCatalogue;
        $this->initialize();
        
    }


    public function index(Request $request){
        $this->authorize('modules', 'product.index');
        $config = $this->configIndex();
        $perPage = $request->integer('perpage');
        $products = $this->productService->paginate($request, $this->language);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.product.product.index';
        $config['seo'] = config('apps.product.index');
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'products',
        ));
    }


    public function create(){
        $this->authorize('modules', 'product.create');
        $attributeCatalogue = $this->attributeCatalogue->getAll($this->language);

        $config = $this->configStore();
        $config['method'] = 'create';
        $config['seo'] = config('apps.product.create');
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.product.product.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'attributeCatalogue',
        ));
    }


    public function store(ProductRequest $request){
        if ($this->productService->create($request, $this->language)) {
            return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công !');
        }
        return redirect()->route('product.index')->with('error', 'Thêm sản phẩm thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'product.edit');
        $product = $this->productRepository->getProductById($id, $this->language);

        $config = $this->configStore();
        $config['method'] = 'edit';
        $config['seo'] = config('apps.product.edit');
        $album = json_decode($product->album);
        $attributeCatalogue = $this->attributeCatalogue->getAll($this->language);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.product.product.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'product',
            'album',
            'attributeCatalogue',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'product.delete');
        $product = $this->productRepository->getProductById($id, $this->language);
        $template = 'backend.product.product.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'product',
        ));
    }


    public function update($id, UpdateProductRequest $request){
        if ($this->productService->update($id, $request, $this->language)) {
            return redirect()->route('product.index')->with('success', 'Cập nhập sản phẩm thành công !');
        }
        return redirect()->route('product.index')->with('error', 'Cập nhập sản phẩm thất bại !');
    }

    
    public function destroy($id){
        $this->authorize('modules', 'product.destroy');
        if ($this->productService->destroy($id)) {
            return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công!');
        }
        return redirect()->route('product.index')->with('error', 'Xóa sản phẩm thất bại!');
    }

    
    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 
    
   

    private function configIndex(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
            'model' => 'Product'
        ];
    }

    private function configStore(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/assets/library/variant.js',
                'backend/assets/library/formatprice-scroll/formatPrice.js',
                'backend/assets/library/formatprice-scroll/productScroll.js',
                'backend/assets/library/renameCanonical.js',
                'backend/assets/library/seo.js',
                'backend/assets/library/finder.js',
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/plugins/nice-select/js/jquery.nice-select.min.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
        ];
    }

}
