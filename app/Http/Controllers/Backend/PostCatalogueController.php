<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\PostCatalogueRequest;
use Illuminate\Http\Request;


class PostCatalogueController extends Controller{

    protected $postCatalogueService;
    protected $postCatalogueRepository;

    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository,
    ) {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }

    public function index(Request $request){

        $perPage = $request->integer('perpage', 10);
        $postCatalogues = $this->postCatalogueService->paginate($request, $perPage);

        $template = 'backend.post.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'postCatalogues',
        ));
    }


    public function create(){
        $config['method'] = 'create';

        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
        ));
    }


    public function store(PostCatalogueRequest $request){
        if ($this->postCatalogueService->create($request)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        $postCatalogues = $this->postCatalogueRepository->findById($id);

        $config['method'] = 'edit';
        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'postCatalogues',
        ));
    }

    public function update($id, PostCatalogueRequest $request){
        if ($this->postCatalogueService->update($id, $request)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }

    public function destroy($id){
        if ($this->postCatalogueService->destroy($id)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Xóa nhóm thành viên thành công !');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Xóa nhóm thành viên thất bại !');
    }

}
