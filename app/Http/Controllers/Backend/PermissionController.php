<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\PermissionServiceInterface as PermissionService;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller{

    protected $permissionService;
    protected $permissionRepository;


    
    public function __construct(
        PermissionService $permissionService,
        PermissionRepository $permissionRepository,
    ) {
        $this->permissionService = $permissionService;
        $this->permissionRepository = $permissionRepository;
    }



    public function index(Request $request){
        $this->authorize('modules', 'permission.index');
        $permissions = $this->permissionService->paginate($request);
        $config['seo'] = config('apps.permission.index');
        $template = 'backend.permission.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'permissions',
        ));
    }


    public function create(){
        $this->authorize('modules', 'permission.create');
        $config['method'] = 'create';
        $config['seo'] = config('apps.permission.create');
        $template = 'backend.permission.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
        ));
    }


    public function store(PermissionRequest $request){
        if ($this->permissionService->create($request)) {
            return redirect()->route('permission.create')->with('success', 'Thêm bản ghi thành công !');
        }
        return redirect()->route('permission.index')->with('error', 'Thêm bản ghi thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'permission.edit');
        $permission = $this->permissionRepository->findById($id);
        $config['seo'] = config('apps.permission.edit');
        $config['method'] = 'edit';
        $template = 'backend.permission.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'permission',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'permission.delete');
        $permission = $this->permissionRepository->findById($id);
        $template = 'backend.permission.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'permission',
        ));
    }


    public function update($id, UpdatePermissionRequest $request){
        if ($this->permissionService->update($id, $request)) {
            return redirect()->route('permission.index')->with('success', 'Cập nhập bản ghi thành công !');
        }
        return redirect()->route('permission.index')->with('error', 'Cập nhập bản ghi thất bại !');
    }

    public function destroy($id){
        $this->authorize('modules', 'permission.destroy');
        if ($this->permissionService->destroy($id)) {
            return redirect()->route('permission.index')->with('success', 'Xóa bản ghi thành công !');
        }
        return redirect()->route('permission.index')->with('error', 'Xóa bản ghi thất bại !');
    }

}
