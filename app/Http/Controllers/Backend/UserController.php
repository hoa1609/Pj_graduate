<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{

    protected $userService;
    protected $provinceRepository;
    protected $userRepository;

    public function __construct(
        UserService $userService,
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository,
    ){
      $this->userService = $userService;
      $this->provinceRepository = $provinceRepository;
      $this->userRepository = $userRepository;
    }

    public function index (Request $request){

        $users = $this->userService->paginate($request);
        $userCatalogues = $this->userService->getUserCatalogue();
        // $config = $this->config();
        $config['seo'] = config('apps.user');
        $template = 'backend.user.user.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'users',
            'userCatalogues'
        ));

    }

    public function create()
    {
        $userCatalogues = $this->userService->getUserCatalogue();
        $provinces = $this->provinceRepository->all();
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';
        $template = 'backend.user.user.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces',
            'userCatalogues'
        ));
    }

    public function store (StoreUserRequest $request)
    {
        if($this->userService->create($request)){
            return redirect()->route('user.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại.');
    }

    public function edit($id)
    {
        $userCatalogues = $this->userService->getUserCatalogue();
        $user = $this->userRepository->findById($id);
        $provinces = $this->provinceRepository->all();
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $template = 'backend.user.user.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces',
            'user',
            'userCatalogues'
        ));
    }

    public function update($id, UpdateUserRequest $request)
    {
        if($this->userService->update($id, $request)){
            return redirect()->route('user.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại.');
    }

    public function delete($id)
    {
        $user = $this->userRepository->findById($id);
        $config['seo'] = config('apps.user');
        $template = 'backend.user.user.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'user',
            'config'
        ));
    }

    public function destroy($id)
    {
        if($this->userService->destroy($id)){
            return redirect()->route('user.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error', 'Xóa bản ghi thất bại. Hãy thử lại');
    }
}
