<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\LanguageRequest;
use Illuminate\Http\Request;


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

        $perPage = $request->integer('perpage', 10);
        $languages = $this->languageService->paginate($request, $perPage);

        $template = 'backend.language.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'languages',
        ));
    }


    public function create(){
        $config['method'] = 'create';

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
        $language = $this->languageRepository->findById($id);

        $config['method'] = 'edit';
        $template = 'backend.language.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'language',
        ));
    }

    public function update($id, LanguageRequest $request){
        if ($this->languageService->update($id, $request)) {
            return redirect()->route('language.index')->with('success', 'Cập nhập ngôn ngữ thành công !');
        }
        return redirect()->route('language.index')->with('error', 'Cập nhập ngôn ngữ thất bại !');
    }

    public function destroy($id){
        if ($this->languageService->destroy($id)) {
            return redirect()->route('language.index')->with('success', 'Xóa ngôn ngữ thành công !');
        }
        return redirect()->route('language.index')->with('error', 'Xóa ngôn ngữ thất bại !');
    }

}
