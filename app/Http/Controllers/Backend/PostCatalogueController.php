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

class PostCatalogueController extends Controller{

    protected $postCatalogueService;
    protected $postCatalogueRepository;
    protected $language;

    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository,
    ) {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => 1,
        ]);
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request){

        $perPage = $request->integer('perpage');
        $postCatalogues = $this->postCatalogueService->paginate($request);
        $template = 'backend.post.catalogue.index';
        
        return view('backend.dashboard.layout', compact(
            'template',
            'postCatalogues',
        ));
    }


    public function create(){
        $config['method'] = 'create';
        $dropdown = $this->nestedset->Dropdown();
        $config['seo'] = config('apps.post.create');


        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
        ));
    }


    public function store(PostCatalogueRequest $request){
        if ($this->postCatalogueService->create($request)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($id, $this->language);
       
        $config['method'] = 'edit';
        $config['seo'] = config('apps.post.edit');
        $dropdown = $this->nestedset->Dropdown();

        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'postCatalogue',
        ));
    }


    public function update($id, UpdatePostCatalogueRequest $request){

        if ($this->postCatalogueService->update($id, $request)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }










    
    public function destroy(DeletePostCatalogueRequest $request, $id){
        
        if ($this->postCatalogueService->destroy($id)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Xóa nhóm thành viên thành công!');
        }

        return redirect()->route('post.catalogue.index')->with('error', 'Xóa nhóm thành viên thất bại!');
    }


}
