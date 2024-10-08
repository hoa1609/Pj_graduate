<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;


class UserCatalogueController extends Controller{

    protected $userCatalogueService;
    protected $userCatalogueRepository;

    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function index(Request $request){

        $perPage = $request->integer('perpage', 10);
        $usersCatalogues = $this->userCatalogueService->paginate($request, $perPage);

        $template = 'backend.user.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'usersCatalogues',
        ));
    }


    public function create(){
        $config['method'] = 'create';

        $template = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
        ));
    }


    public function store(StoreUserCatalogueRequest $request){
        if ($this->userCatalogueService->create($request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Thêm bản ghi thành công !');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Thêm bản ghi thất bại !');
    }


    public function edit($id){
        $userCatalogue = $this->userCatalogueRepository->findById($id);

        $config['method'] = 'edit';
        $template = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'userCatalogue',
        ));
    }

    public function update($id, StoreUserCatalogueRequest $request){
        if ($this->userCatalogueService->update($id, $request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Cập nhập bản ghi thành công !');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Cập nhập bản ghi thất bại !');
    }

    public function destroy($id){
        if ($this->userCatalogueService->destroy($id)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Xóa bản ghi thành công !');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Xóa bản ghi thất bại !');
    }
}
