<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserRoleServiceInterface as UserRoleService;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as UserRoleRepository;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRoleRequest;
use Illuminate\Http\Request;


class UserRoleController extends Controller{

    protected $userRoleService;
    protected $userRoleRepository;

    public function __construct(
        UserRoleService $userRoleService,
        UserRoleRepository $userRoleRepository,
    ) {
        $this->userRoleService = $userRoleService;
        $this->userRoleRepository = $userRoleRepository;
    }

    public function index(Request $request){

        $perPage = $request->integer('perpage', 10);
        $userRoles = $this->userRoleService->paginate($request, $perPage);

        $template = 'backend.user.role_user.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'userRoles',
        ));
    }


    public function create(){
        $config['method'] = 'create';

        $template = 'backend.user.role_user.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
        ));
    }


    public function store(UserRoleRequest $request){
        if ($this->userRoleService->create($request)) {
            return redirect()->route('user.role.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('user.role.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        $userRoles = $this->userRoleRepository->findById($id);

        $config['method'] = 'edit';
        $template = 'backend.user.role_user.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'userRoles',
        ));
    }

    public function update($id, UserRoleRequest $request){
        if ($this->userRoleService->update($id, $request)) {
            return redirect()->route('user.role.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('user.role.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }

    public function destroy($id){
        if ($this->userRoleService->destroy($id)) {
            return redirect()->route('user.role.index')->with('success', 'Xóa nhóm thành viên thành công !');
        }
        return redirect()->route('user.role.index')->with('error', 'Xóa nhóm thành viên thất bại !');
    }

}
