<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\PromotionServiceInterface as PromotionService;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;

use App\Http\Requests\PromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class PromotionController extends Controller{

    protected $promotionService;
    protected $promotionRepository;
    protected $language;

    public function __construct(
        PromotionService $promotionService,
        PromotionRepository $promotionRepository,
    ) {
        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            $this->initialize();
            return $next($request);
        });

        $this->promotionService = $promotionService;
        $this->promotionRepository = $promotionRepository;
    }




    public function index(Request $request){
        $config = [
            'model' => 'Promotion',
        ];
        $this->authorize('modules', 'promotion.index');
        $perPage = $request->integer('perpage');
        $promotions = $this->promotionService->paginate($request, $this->language);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.promotion.promotion.index';
        $config['seo'] = config('apps.promotion.index');

        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'promotions',
        ));
    }


    public function create(){
        $this->authorize('modules', 'promotion.create');
        $config['method'] = 'create';
        $config['seo'] = config('apps.promotion.create');
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.promotion.promotion.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
        ));
    }


    public function store(PromotionRequest $request){
        if ($this->promotionService->create($request, $this->language)) {
            return redirect()->route('promotion.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('promotion.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'promotion.edit');
        $promotion = $this->promotionRepository->getPromotionById($id, $this->language);
        $config['method'] = 'edit';
        $config['seo'] = config('apps.promotion.edit');
        $album = json_decode($promotion->album);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.promotion.promotion.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'promotion',
            'album',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'promotion.delete');
        $promotion = $this->promotionRepository->getPromotionById($id, $this->language);
        $template = 'backend.promotion.promotion.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'promotion',
        ));
    }

    public function update($id, UpdatePromotionRequest $request){
        if ($this->promotionService->update($id, $request, $this->language)) {
            return redirect()->route('promotion.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('promotion.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }

    public function destroy($id){
        $this->authorize('modules', 'promotion.destroy');
        if ($this->promotionService->destroy($id, $this->language)) {
            return redirect()->route('promotion.index')->with('success', 'Xóa nhóm thành viên thành công!');
        }
        return redirect()->route('promotion.index')->with('error', 'Xóa nhóm thành viên thất bại!');
    }


    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    }


}
