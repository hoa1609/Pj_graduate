<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Http\Requests\PostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;
use App\Http\Requests\DeletePostCatalogueRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;
use App\Models\Language;


class PostCatalogueController extends Controller{

    protected $postCatalogueService;
    protected $postCatalogueRepository;
    protected $language;


    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository,
    ){
        $this->middleware(function ($request, $next) {
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            $this->initialize();
            return $next($request);
        });


        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }


    public function index(Request $request){
        $this->authorize('modules', 'post.catalogue.index');
        $config['seo'] = config('apps.postcatalogue.index');
        $perPage = $request->integer('perpage');
        $postCatalogues = $this->postCatalogueService->paginate($request, $this->language);
        $template = 'backend.post.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'postCatalogues',
        ));
    }


    public function create(){
        $this->authorize('modules', 'post.catalogue.create');
        $config['method'] = 'create';
        $config['seo'] = config('apps.postcatalogue.create');
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
        ));
    }


    public function store(PostCatalogueRequest $request){
        if ($this->postCatalogueService->create($request, $this->language)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'post.catalogue.edit');
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($id, $this->language);
        $config['method'] = 'edit';
        $config['seo'] = config('apps.postcatalogue.edit');
        $album = json_decode($postCatalogue->album);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'postCatalogue',
            'album',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'post.catalogue.delete');
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($id, $this->language);
        $template = 'backend.post.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'postCatalogue',
        ));
    }



    public function update($id, UpdatePostCatalogueRequest $request){
        if ($this->postCatalogueService->update($id, $request, $this->language)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }

    
    public function destroy(DeletePostCatalogueRequest $request, $id){
        $this->authorize('modules', 'post.catalogue.destroy');
        if ($this->postCatalogueService->destroy($id, $this->language)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Xóa nhóm thành viên thành công!');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Xóa nhóm thành viên thất bại!');
    }

    
    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => 1,
        ]);
    } 


}
