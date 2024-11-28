<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\AttributeCatalogueServiceInterface as AttributeCatalogueService;
use App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface as AttributeCatalogueRepository;
use App\Http\Requests\AttributeCatalogueRequest;
use App\Http\Requests\UpdateAttributeCatalogueRequest;
use App\Http\Requests\DeleteAttributeCatalogueRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;
use App\Models\Language;


class AttributeCatalogueController extends Controller{

    protected $attributeCatalogueService;
    protected $attributeCatalogueRepository;
    protected $language;


    public function __construct(
        AttributeCatalogueService $attributeCatalogueService,
        AttributeCatalogueRepository $attributeCatalogueRepository,
    ) {
        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1; 
            $this->initialize();
            return $next($request);
        });


        $this->attributeCatalogueService = $attributeCatalogueService;
        $this->attributeCatalogueRepository = $attributeCatalogueRepository;
    }


    public function index(Request $request){
        $this->authorize('modules', 'attribute.catalogue.index');
        $config = $this->configIndex();
        $config['seo'] = config('apps.attributecatalogue.index');
        $perPage = $request->integer('perpage');
        $attributeCatalogues = $this->attributeCatalogueService->paginate($request, $this->language);
        $template = 'backend.attribute.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'attributeCatalogues',
        ));
    }


    public function create(){
        $this->authorize('modules', 'attribute.catalogue.create');

        $config = $this->configStore();
        $config['method'] = 'create';
        $config['seo'] = config('apps.attributecatalogue.create');
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.attribute.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
        ));
    }


    public function store(AttributeCatalogueRequest $request){
        if ($this->attributeCatalogueService->create($request, $this->language)) {
            return redirect()->route('attribute.catalogue.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('attribute.catalogue.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'attribute.catalogue.edit');
        $attributeCatalogue = $this->attributeCatalogueRepository->getAttributeCatalogueById($id, $this->language);

        $config = $this->configStore();
        $config['method'] = 'edit';
        $config['seo'] = config('apps.attributecatalogue.edit');
        $album = json_decode($attributeCatalogue->album);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.attribute.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'attributeCatalogue',
            'album',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'attribute.catalogue.destroy');
        $attributeCatalogue = $this->attributeCatalogueRepository->getAttributeCatalogueById($id, $this->language);
        $template = 'backend.attribute.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'attributeCatalogue',
        ));
    }



    public function update($id, UpdateAttributeCatalogueRequest $request){
        if ($this->attributeCatalogueService->update($id, $request, $this->language)) {
            return redirect()->route('attribute.catalogue.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('attribute.catalogue.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }

    
    public function destroy(DeleteAttributeCatalogueRequest $request, $id){
        $this->authorize('modules', 'attribute.catalogue.destroy');
        if ($this->attributeCatalogueService->destroy($id, $this->language)) {
            return redirect()->route('attribute.catalogue.index')->with('success', 'Xóa nhóm thành viên thành công!');
        }
        return redirect()->route('attribute.catalogue.index')->with('error', 'Xóa nhóm thành viên thất bại!');
    }

    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'attribute_catalogues',
            'foreignkey' => 'attribute_catalogue_id',
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
                'backend/assets/library/formatprice-scroll/catalogueScroll.js',
                'backend/assets/library/finder.js',
                'backend/assets/library/seo.js',
                'backend/plugins/ckeditor/ckeditor.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
        ];
    }
}
