<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;

use App\Http\Requests\AttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class AttributeController extends Controller{

    protected $attributeService;
    protected $attributeRepository;
    protected $language;

    public function __construct(
        AttributeService $attributeService,
        AttributeRepository $attributeRepository,
    ) {
        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            $this->initialize();
            return $next($request);
        });

        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
    }




    public function index(Request $request){
        $this->authorize('modules', 'attribute.index');
        $perPage = $request->integer('perpage');
        $attributes = $this->attributeService->paginate($request, $this->language);

        $config = $this->configIndex();
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.attribute.attribute.index';
        $config['seo'] = config('apps.attribute.index');

        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'attributes',
        ));
    }


    public function create(){
        $this->authorize('modules', 'attribute.create');

        $config = $this->configStore();
        $config['method'] = 'create';
        $config['seo'] = config('apps.attribute.create');
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.attribute.attribute.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
        ));
    }


    public function store(AttributeRequest $request){
        if ($this->attributeService->create($request, $this->language)) {
            return redirect()->route('attribute.index')->with('success', 'Thêm nhóm bản ghi thành công !');
        }
        return redirect()->route('attribute.index')->with('error', 'Thêm nhóm bản ghi thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'attribute.edit');
        $attribute = $this->attributeRepository->getAttributeById($id, $this->language);

        $config = $this->configStore();
        $config['method'] = 'edit';
        $config['seo'] = config('apps.attribute.edit');
        $album = json_decode($attribute->album);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.attribute.attribute.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'attribute',
            'album',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'attribute.delete');
        $attribute = $this->attributeRepository->getAttributeById($id, $this->language);
        $template = 'backend.attribute.attribute.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'attribute',
        ));
    }

    public function update($id, UpdateAttributeRequest $request){
        if ($this->attributeService->update($id, $request, $this->language)) {
            return redirect()->route('attribute.index')->with('success', 'Cập nhập nhóm bản ghi thành công !');
        }
        return redirect()->route('attribute.index')->with('error', 'Cập nhập nhóm bản ghi thất bại !');
    }

    public function destroy($id){
        $this->authorize('modules', 'attribute.destroy');
        if ($this->attributeService->destroy($id, $this->language)) {
            return redirect()->route('attribute.index')->with('success', 'Xóa nhóm bản ghi thành công!');
        }
        return redirect()->route('attribute.index')->with('error', 'Xóa nhóm bản ghi thất bại!');
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
            'model' => 'Attribute'
        ];
    }

    private function configStore(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/assets/library/formatprice-scroll/catalogueScroll.js',
                'backend/assets/library/variant.js',
                'backend/assets/library/finder.js',
                'backend/assets/library/seo.js',
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/plugins/nice-select/js/jquery.nice-select.min.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
        ];
    }
}
