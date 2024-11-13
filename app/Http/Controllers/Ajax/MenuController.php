<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;
use App\Services\Interfaces\MenuCatalogueServiceInterface as MenuCatalogueService;
use App\Http\Requests\StoreMenuCatalogueRequest;

class MenuController extends Controller
{

    protected $menuCatalogueService;
    protected $menuCatalogueRepository;

    public function __construct(
        MenuCatalogueRepository $menuCatalogueRepository,
        MenuCatalogueService $menuCatalogueService
    ) {
        $this->menuCatalogueRepository = $menuCatalogueRepository;
        $this->menuCatalogueService = $menuCatalogueService;
    }

    public function createCatalogue(StoreMenuCatalogueRequest $request)
    {
        $menuCatalogue = $this->menuCatalogueService->create($request);
        if ($menuCatalogue !== false) {
            return response()->json([
                'code' => 0,
                'message' => 'Tạo menu nhóm thành công',
                'data' => $menuCatalogue,
            ]);
        }
        return response()->json([
            'message' => 'Có vấn đề xảy ra, hãy thử lại',
            'code' => 1
        ]);
    }
}
