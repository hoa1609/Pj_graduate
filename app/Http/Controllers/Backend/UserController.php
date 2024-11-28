<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;


class UserController extends Controller{

    protected $userService;
    protected $provinceRepository;
    protected $userRepository;

    public function __construct(
        UserService $userService,
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository,
    ) {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'user.index');
        $perPage = $request->integer('perPage', 10);
        $users = $this->userService->paginate($request, $perPage);
        
        $config = $this->configIndex();
        $config['seo'] = config('apps.user.index');
        $template = 'backend.user.user.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'users',
        ));
    }


    public function create(){
        $this->authorize('modules', 'user.create');
        $provinces = $this->provinceRepository->all();
        $config = $this->configStore();
        $config['method'] = 'create';
        $config['seo'] = config('apps.user.create');
        $template = 'backend.user.user.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'provinces',
        ));
    }


    public function store(StoreUserRequest $request){
        if ($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'Thêm thành viên thành công !');
        }
        return redirect()->route('user.index')->with('error', 'Thêm thành viên thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'user.edit');
        $user = $this->userRepository->findById($id);
        $provinces = $this->provinceRepository->all();
        $config = $this->configStore();
        $config['method'] = 'edit';
        $config['seo'] = config('apps.user.edit');
        $template = 'backend.user.user.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'provinces',
            'user',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'user.delete');
        $user = $this->userRepository->findById($id);
        $template = 'backend.user.user.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'user',
        ));
    }


    public function update($id, UpdateUserRequest $request){
        if ($this->userService->update($id, $request)) {
            return redirect()->route('user.index')->with('success', 'Cập nhập thành viên thành công !');
        }
        return redirect()->route('user.index')->with('error', 'Cập nhập thành viên thất bại !');
    }


    public function destroy($id){
        $this->authorize('modules', 'user.destroy');

        if ($this->userService->destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Xóa thành viên thành công !');
        }
        return redirect()->route('user.index')->with('error', 'Xóa thành viên thất bại !');
    }

    private function configIndex(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
            'model' => 'User'
        ];
    }

    private function configStore(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
                'backend/assets/library/location.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/assets/library/finder.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
        ];
    }
}
