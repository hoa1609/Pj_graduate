<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserRoleServiceInterface as UserRoleService;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as UserRoleRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRoleRequest;
use Illuminate\Http\Request;


class UserRoleController extends Controller{

    protected $userRoleService;
    protected $userRoleRepository;
    protected $permissionRepository;

    public function __construct(
        UserRoleService $userRoleService,
        UserRoleRepository $userRoleRepository,
        PermissionRepository $permissionRepository,
    ) {
        $this->userRoleService = $userRoleService;
        $this->userRoleRepository = $userRoleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'user.role.index');

        $perPage = $request->integer('perpage', 10);
        $userRoles = $this->userRoleService->paginate($request, $perPage);
        $config = $this->configIndex();
        $config['seo'] = config('apps.userRole.index');
        $template = 'backend.user.role_user.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'userRoles',
        ));
    }


    public function create(){
        $this->authorize('modules', 'user.role.create');

        $config['method'] = 'create';
        $config['seo'] = config('apps.userRole.create');

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
        $this->authorize('modules', 'user.role.edit');

        $userRoles = $this->userRoleRepository->findById($id);

        $config['method'] = 'edit';
        $config['seo'] = config('apps.userRole.edit');
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

    public function delete($id){
        $this->authorize('modules', 'user.role.delete');
        $userRole = $this->userRoleRepository->findById($id);
        $template = 'backend.user.role_user.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'userRole',
        ));
    }


    public function destroy($id){
        $this->authorize('modules', 'user.role.destroy');
        if ($this->userRoleService->destroy($id)) {
            return redirect()->route('user.role.index')->with('success', 'Xóa nhóm thành viên thành công !');
        }
        return redirect()->route('user.role.index')->with('error', 'Xóa nhóm thành viên thất bại !');
    }


    public function permission(){
        $this->authorize('modules', 'user.role.permission');
        $template = 'backend.user.role_user.permission';
        $config['seo'] = config('apps.permission.index');
        $config['method'] = 'create';

        $userCatalogues = $this->userRoleRepository->all(['permissions']);
        $permissions = $this->permissionRepository->all();
        return view('backend.dashboard.layout', compact(
            'template',
            'userCatalogues',
            'permissions',
            'config',
        ));
    }

    public function updatePermission(Request $request){
        $this->authorize('modules', 'user.role.updatePermission');
        if($this->userRoleService->setPermission($request)){
            return redirect()->route('user.role.permission')->with('success', 'Cập nhập quyền thành công !');
        }
        return redirect()->route('user.role.permission')->with('error', 'Cập nhập quyền thất bại !');
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
