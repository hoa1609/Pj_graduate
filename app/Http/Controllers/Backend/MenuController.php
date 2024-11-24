<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\MenuServiceInterface as MenuService;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;
use App\Services\Interfaces\MenuCatalogueServiceInterface as MenuCatalogueService;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\StoreMenuChildrenRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Language;
use App\Models\Menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{

    protected $menuService;
    protected $menuRepository;
    protected $menuCatalogueRepository;
    protected $menuCatalogueService;

    public function __construct(
        MenuService $menuService,
        MenuRepository $menuRepository,
        MenuCatalogueRepository $menuCatalogueRepository,
        MenuCatalogueService $menuCatalogueService,
    ) {
        $this->menuService = $menuService;
        $this->menuRepository = $menuRepository;
        $this->menuCatalogueRepository = $menuCatalogueRepository;
        $this->menuCatalogueService = $menuCatalogueService;
        $this->middleware(function ($request, $next) {
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $this->authorize('modules', 'menu.index');

        $perPage = $request->integer('perPage', 10);
        $menuCatalogues = $this->menuCatalogueService->paginate($request, $perPage, 1);


        // $config['seo'] = __('messages.menu');
        $template = 'backend.menu.menu.index';
        return view('backend.dashboard.layout', compact(
            // 'config',
            'template',
            'menuCatalogues',
        ));
    }


    public function create()
    {
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


    public function store(StoreMenuRequest $request)
    {
        if ($this->menuService->save($request, $this->language)) {
            $menuCatalogueId = $request->input('menu_catalogue_id');
            return redirect()->route('menu.edit', ['id' => $menuCatalogueId])->with('success', 'Cập nhật bản ghi thành công !');
        }
    }
    public function edit($id)
    {
        $this->authorize('modules', 'menu.update');
        $language = $this->language;
        $menus = $this->menuRepository->findByCondition([
            ['menu_catalogue_id', '=', $id]
        ], TRUE, [
            'languages' => function ($query) use ($language) {
                $query->where('language_id', $language);
            }
        ], ['order', 'DESC']);

        $menuCatalogue = $this->menuCatalogueRepository->findById($id);

        $config['method'] = 'edit';
        $config['seo'] = config('menu.user.edit');

        $template = 'backend.menu.menu.show';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'menus',
            'id',
            'menuCatalogue',
        ));
    }

    public function delete($id)
    {
        $menuCatalogue = $this->menuCatalogueRepository->findById($id);

        if (!$menuCatalogue) {
            return redirect()->route('menu.index')->with('error', 'Menu không tồn tại.');
        }

        return view('backend.dashboard.layout', [
            'template' => 'backend.menu.menu.delete',
            'menuCatalogue' => $menuCatalogue,
        ]);
    }


    public function destroy($id)
    {
        $this->authorize('modules', 'menu.destroy');

        if ($this->menuService->destroy($id)) {
            return redirect()->route('menu.index')->with('success', 'Xóa menu thành công !');
        }

        return redirect()->route('menu.index')->with('error', 'Xóa menu thất bại !');
    }


    public function children($id)
    {
        $this->authorize('modules', 'menu.create');
        $language = $this->language;
        $menu = $this->menuRepository->findById($id, ['*'], ['languages' => function ($query) use ($language) {
            $query->where('language_id', $language);
        }]);

        $menuList = $this->menuService->getAndConvertMenu($menu, $this->language);
        // dd($menuList);

        $config['method'] = 'children';
        $config['seo'] = config('apps.menu.create');
        $template = 'backend.menu.menu.children';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'menu',
            'menuList',
        ));
    }

    public function saveChildren(storeMenuChildrenRequest $request, $id)
    {
        $menu = $this->menuRepository->findByID($id);

        if (!$menu) {
            return redirect()->route('menu.edit', ['id' => $menu->menu_catalogue_id])->with('error', 'Menu không tồn tại!');
        }

        if ($this->menuService->saveChildren($request, $this->language, $menu)) {
            return redirect()->route('menu.edit', ['id' => $menu->menu_catalogue_id])->with('success', 'Thêm mới bản ghi thành công !');
        }

        return redirect()->route('menu.edit', ['id' => $menu->menu_catalogue_id])->with('error', 'Thêm bản ghi thất bại!');
    }

    public function editMenu($id)
    {
        $this->authorize('modules', 'menu.update');
        $language = $this->language;
        $menus = $this->menuRepository->findByCondition([
            ['menu_catalogue_id', '=', $id],
            ['parent_id', '=', 0],
        ], TRUE, [
            'languages' => function ($query) use ($language) {
                $query->where('language_id', $language);
            }
        ], ['order', 'DESC']);
        $menuList = $this->menuService->convertMenu($menus);
        $menuCatalogues = $this->menuCatalogueRepository->all();
        $menuCatalogue = $this->menuCatalogueRepository->findById($id);
        $config['method'] = 'edit';
        $config['seo'] = config('apps.menu.create');
        $template = 'backend.menu.menu.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'menuList',
            'menuCatalogues',
            'menuCatalogue',
            'id',
        ));
    }
}
