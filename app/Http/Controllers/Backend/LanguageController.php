<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;

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
        $this->authorize('modules', 'language.update');
        if ($this->languageService->update($id, $request)) {
            return redirect()->route('language.index')->with('success', 'Cập nhập ngôn ngữ thành công !');
        }
        return redirect()->route('language.index')->with('error', 'Cập nhập ngôn ngữ thất bại !');
    }


    public function destroy($id){
        if ($this->languageService->destroy($id)) {
        $this->authorize('modules', 'language.destroy');
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

}
