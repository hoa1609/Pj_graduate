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
        $perPage = $request->integer('perPage', 10);
        $users = $this->userService->paginate($request, $perPage);
        
        $template = 'backend.user.user.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'users',
        ));
    }


    public function create(){
        $provinces = $this->provinceRepository->all();
        $config['method'] = 'create';

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
        $user = $this->userRepository->findById($id);
        $provinces = $this->provinceRepository->all();

        $config['method'] = 'edit';
        $template = 'backend.user.user.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'provinces',
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
        if ($this->userService->destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Xóa thành viên thành công !');
        }
        return redirect()->route('user.index')->with('error', 'Xóa thành viên thất bại !');
    }
}
