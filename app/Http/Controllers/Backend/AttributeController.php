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
        $config = [
            'model' => 'Attribute',
        ];
        $this->authorize('modules', 'attribute.index');
        $perPage = $request->integer('perpage');
        $attributes = $this->attributeService->paginate($request, $this->language);
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
            return redirect()->route('attribute.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('attribute.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'attribute.edit');
        $attribute = $this->attributeRepository->getAttributeById($id, $this->language);
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
            return redirect()->route('attribute.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('attribute.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }
    
    public function destroy($id){
        $this->authorize('modules', 'attribute.destroy');
        if ($this->attributeService->destroy($id, $this->language)) {
            return redirect()->route('attribute.index')->with('success', 'Xóa nhóm thành viên thành công!');
        }
        return redirect()->route('attribute.index')->with('error', 'Xóa nhóm thành viên thất bại!');
    }


    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 


}
