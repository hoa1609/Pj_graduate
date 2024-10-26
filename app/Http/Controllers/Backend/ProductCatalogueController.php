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

class ProductCatalogueController extends Controller{

    protected $productCatalogueService;
    protected $productCatalogueRepository;
    protected $language;

    public function __construct(
        ProductCatalogueService $productCatalogueService,
        ProductCatalogueRepository $productCatalogueRepository,
    ) {
        $this->productCatalogueService = $productCatalogueService;
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' => 1,
        ]);
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request){
        // $this->authorize('modules', 'product.catalogue.index');

        $config['seo'] = config('apps.productcatalogue.index');
        $perPage = $request->integer('perpage');
        $productCatalogues = $this->productCatalogueService->paginate($request);
        $template = 'backend.product.catalogue.index';
        
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'productCatalogues',
        ));
    }


    public function create(){
        // $this->authorize('modules', 'product.catalogue.create');

        $config['method'] = 'create';
        $config['seo'] = config('apps.productcatalogue.create');
        $dropdown = $this->nestedset->Dropdown();

        $template = 'backend.product.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
        ));
    }


    public function store(ProductCatalogueRequest $request){
        if ($this->productCatalogueService->create($request)) {
            return redirect()->route('product.catalogue.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('product.catalogue.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        // $this->authorize('modules', 'product.catalogue.edit');

        $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($id, $this->language);
        $config['method'] = 'edit';
        $config['seo'] = config('apps.productcatalogue.edit');
        $album = json_decode($productCatalogue->album);
        $dropdown = $this->nestedset->Dropdown();

        $template = 'backend.product.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'productCatalogue',
            'album',
        ));
    }


    public function update($id, UpdateProductCatalogueRequest $request){
        if ($this->productCatalogueService->update($id, $request)) {
            return redirect()->route('product.catalogue.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('product.catalogue.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }

    
    public function destroy(DeleteProductCatalogueRequest $request, $id){
        // $this->authorize('modules', 'product.catalogue.destroy');
        
        if ($this->productCatalogueService->destroy($id)) {
            return redirect()->route('product.catalogue.index')->with('success', 'Xóa nhóm thành viên thành công!');
        }

        return redirect()->route('product.catalogue.index')->with('error', 'Xóa nhóm thành viên thất bại!');
    }


}
