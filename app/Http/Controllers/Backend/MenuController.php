<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\MenuServiceInterface as MenuService;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;


class MenuController extends Controller{

    protected $menuService;
    protected $menuRepository;
    protected $menuCatalogueRepository;

    public function __construct(
        MenuService $menuService,
        MenuRepository $menuRepository,
        MenuCatalogueRepository $menuCatalogueRepository,
    ) {
        $this->menuService = $menuService;
        $this->menuRepository = $menuRepository;
        $this->menuCatalogueRepository = $menuCatalogueRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'menu.index');

        $perPage = $request->integer('perPage', 10);
        $menus = $this->menuService->paginate($request, $perPage, 1);

        // $config['seo'] = __('messages.menu');
        $template = 'backend.menu.menu.index';
        return view('backend.dashboard.layout', compact(
            // 'config',
            'template',
            'menus',
        ));
    }


    public function create(){
        $this->authorize('modules', 'menu.create');
        $menuCatalogues = $this->menuCatalogueRepository->all();

        $config['method'] = 'create';
        $config['seo'] = config('apps.menu.create');

        $template = 'backend.menu.menu.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'menuCatalogues'
        ));
    }


    // public function store(StoreMenuRequest $request){
    //     if ($this->menuService->create($request)) {
    //         return redirect()->route('menu.index')->with('success', 'Thêm thành viên thành công !');
    //     }
    //     return redirect()->route('menu.index')->with('error', 'Thêm thành viên thất bại !');
    // }


    public function edit($id){
        $this->authorize('modules', 'menu.edit');

        $user = $this->menuRepository->findById($id);
        $config['method'] = 'edit';
        $config['seo'] = config('menu.user.edit');

        $template = 'backend.menu.menu.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'menu',
        ));
    }


    // public function update($id, UpdateMenuRequest $request){
    //     if ($this->menuService->update($id, $request)) {
    //         return redirect()->route('menu.index')->with('success', 'Cập nhập thành viên thành công !');
    //     }
    //     return redirect()->route('menu.index')->with('error', 'Cập nhập thành viên thất bại !');
    // }


    public function destroy($id){
        $this->authorize('modules', 'menu.destroy');

        if ($this->menuService->destroy($id)) {
            return redirect()->route('menu.index')->with('success', 'Xóa thành viên thành công !');
        }
        return redirect()->route('menu.index')->with('error', 'Xóa thành viên thất bại !');
    }
}
