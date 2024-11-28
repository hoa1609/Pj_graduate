<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

// use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Requests\TranslateRequest;

class LanguageController extends Controller{

    protected $languageService;
    protected $languageRepository;

    public function __construct(
        LanguageService $languageService,
        LanguageRepository $languageRepository,
    ) {
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'language.index');

        $config = $this->configIndex();
        $languages = $this->languageService->paginate($request);
        $config['seo'] = config('apps.language.index');
        $template = 'backend.language.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'languages',
        ));
    }


    public function create(){
        $this->authorize('modules', 'language.create');

        $config['method'] = 'create';
        $config['seo'] = config('apps.language.create');
        $template = 'backend.language.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
        ));
    }


    public function store(LanguageRequest $request){
        if ($this->languageService->create($request)) {
            return redirect()->route('language.index')->with('success', 'Thêm ngôn ngữ thành công !');
        }
        return redirect()->route('language.index')->with('error', 'Thêm ngôn ngữ thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'language.edit');

        $language = $this->languageRepository->findById($id);
        $config['seo'] = config('apps.language.edit');
        $config['method'] = 'edit';
        $template = 'backend.language.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'language',
        ));
    }

    public function update($id, UpdateLanguageRequest $request){
        if ($this->languageService->update($id, $request)) {
            return redirect()->route('language.index')->with('success', 'Cập nhập ngôn ngữ thành công !');
        }
        return redirect()->route('language.index')->with('error', 'Cập nhập ngôn ngữ thất bại !');
    }

    public function delete($id){
        $this->authorize('modules', 'language.delete');
        $language = $this->languageRepository->findById($id);
        $template = 'backend.language.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'language',
        ));
    }


    public function destroy($id){
        $this->authorize('modules', 'language.destroy');
        if ($this->languageService->destroy($id)) {
            return redirect()->route('language.index')->with('success', 'Xóa ngôn ngữ thành công !');
        }
        return redirect()->route('language.index')->with('error', 'Xóa ngôn ngữ thất bại !');
    }

    public function swicthBackendLanguage($id){
        $language = $this->languageRepository->findById($id);
        if($this->languageService->switch($id)){
            session(['app_locale' => $language->canonical]);
            App::setLocale($language->canonical);
        }
        return redirect()->back();
    }

    public function translate($id = 0, $languageId = 0, $model = '') {
        if (!session()->has('app_locale')) {
            session(['app_locale' => 'tv']); // mặc định khi chưa chọn language là tiếng việt
        }

        $repositoryInstance = $this->repositoryInstance($model);
        $languageInstance = $this->repositoryInstance('Language');
        $currentLanguage = $languageInstance->findByCondition([
            ['canonical', '=', session('app_locale')]
        ]);

        $method = 'get'.$model.'ById';

        $object = $repositoryInstance->{$method}($id, $currentLanguage->id);
        $objectTranslate = $repositoryInstance->{$method}($id, $languageId);
        // dd($objectTranslate);
        $this->authorize('modules', 'language.translate');
        $option = [
            'id' => $id,
            'languageId' => $languageId,
            'model' => $model,
        ];
        $config['seo'] = config('app.language');
        $template = 'backend.language.translate';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'object',
            'objectTranslate',
            'option',
        ));
    }

    public function storeTranslate(TranslateRequest $request) {
        $option = $request->input('option');
        if ($this->languageService->saveTranslate($option, $request)) { // bấm lưu thông tin dịch sẽ chạy vào hàm này
            return redirect()->back()->with('success', 'Cập nhật bản dịch thành công');
        }
        return redirect()->back()>with('error', 'Có vấn đề xảy ra, hãy thử lại');
    }

    private function repositoryInstance($model) {
        $repositoryNamespace = '\App\Repositories\\' . ucfirst($model) . 'Repository';
        if (class_exists($repositoryNamespace)) {
            $repositoryInstance = app($repositoryNamespace);
        }
        return $repositoryInstance ?? null;
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

}
