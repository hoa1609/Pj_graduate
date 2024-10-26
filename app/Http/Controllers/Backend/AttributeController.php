<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;

use App\Http\Requests\AttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;

class AttributeController extends Controller{

    protected $attributeService;
    protected $attributeRepository;
    protected $language;

    public function __construct(
        AttributeService $attributeService,
        AttributeRepository $attributeRepository,
    ) {
        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'attribute_catalogues',
            'foreignkey' => 'attribute_catalogue_id',
            'language_id' => 1,
        ]);
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request){
        // $this->authorize('modules', 'attribute.index');

        $config = [
            'model' => 'Attribute',
        ];
        $perPage = $request->integer('perpage');
        $attributes = $this->attributeService->paginate($request);
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
        // $this->authorize('modules', 'attribute.create');

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
        if ($this->attributeService->create($request)) {
            return redirect()->route('attribute.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('attribute.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        // $this->authorize('modules', 'attribute.edit');

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


    public function update($id, UpdateAttributeRequest $request){
        if ($this->attributeService->update($id, $request)) {
            return redirect()->route('attribute.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('attribute.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }

    
    public function destroy($id){
        // $this->authorize('modules', 'attribute.destroy');
        if ($this->attributeService->destroy($id)) {
            return redirect()->route('attribute.index')->with('success', 'Xóa nhóm thành viên thành công!');
        }

        return redirect()->route('attribute.index')->with('error', 'Xóa nhóm thành viên thất bại!');
    }


}
