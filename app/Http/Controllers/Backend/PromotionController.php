<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\PromotionServiceInterface as PromotionService;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use App\Repositories\Interfaces\SourceRepositoryInterface as SourceRepository;

use App\Http\Requests\Promotion\StorePromotionRequest;
use App\Http\Requests\Promotion\UpdatePromotionRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class PromotionController extends Controller{

    protected $promotionService;
    protected $promotionRepository;
    protected $sourceRepository;
    protected $language;

    public function __construct(
        PromotionService $promotionService,
        PromotionRepository $promotionRepository,
        SourceRepository $sourceRepository,
    ) {
        $this->promotionService = $promotionService;
        $this->promotionRepository = $promotionRepository;
        $this->sourceRepository = $sourceRepository;

        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            $this->initialize();
            return $next($request);
        });
    }

    public function index(Request $request){
        $this->authorize('modules', 'promotion.index');
        $perPage = $request->integer('perpage');
        $promotions = $this->promotionService->paginate($request, $this->language);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.promotion.promotion.index';

        $config = $this->configIndex();
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
        $sources = $this->sourceRepository->all();

        $config = $this->configStore();
        $config['method'] = 'create';
        $config['seo'] = config('apps.promotion.create');
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.promotion.promotion.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'sources'
        ));
    }

    public function store(StorePromotionRequest $request){
        if ($this->promotionService->create($request, $this->language)) {
            return redirect()->route('promotion.index')->with('success', 'Thêm khuyến mãi thành công !');
        }
        return redirect()->route('promotion.index')->with('error', 'Thêm khuyến mãi thất bại !');
    }

    public function edit($id){
        $this->authorize('modules', 'promotion.edit');
        $sources = $this->sourceRepository->all();
        $promotion = $this->promotionRepository->findById($id);
        
        $config = $this->configStore();
        $config['method'] = 'edit';
        $config['seo'] = config('apps.promotion.edit');
        $template = 'backend.promotion.promotion.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'promotion',
            'sources'
        ));
    }
    

    public function delete($id){
        $this->authorize('modules', 'promotion.delete');
        $promotion = $this->promotionRepository->findById($id);
        $template = 'backend.promotion.promotion.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'promotion',

        ));
    }
    public function update($id, UpdatePromotionRequest $request){
        if ($this->promotionService->update($id, $request, $this->language)) {
            return redirect()->route('promotion.index')->with('success', 'Cập nhập khuyến mãi thành công !');
        }
        return redirect()->route('promotion.index')->with('error', 'Cập nhập khuyến mãi thất bại !');
    }

    public function destroy($id){
        if ($this->promotionService->destroy($id, $this->language)) {
            return redirect()->route('promotion.index')->with('success', 'Xóa khuyến mãi thành công!');
        }
        return redirect()->route('promotion.index')->with('error', 'Xóa khuyến mãi thất bại!');
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
            'model' => 'Promotion',
        ];
    }

    private function configStore(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/assets/library/finder.js',
                'backend/assets/library/seo.js',
                'backend/assets/library/promotion.js',
                'backend/plugins/ckeditor/ckeditor.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
        ];
    }

}
