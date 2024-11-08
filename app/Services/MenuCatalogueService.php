<?php

namespace App\Services;

use App\Services\Interfaces\MenuCatalogueServiceInterface;
use App\Services\BaseService;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuCatalogueService extends BaseService implements MenuCatalogueServiceInterface
{
    protected $menuCatalogueRepository;
    protected $nestedset;
    protected $language;
    protected $routerRepository;

    public function __construct(
        MenuCatalogueRepository $menuCatalogueRepository,
    ) {
        $this->menuCatalogueRepository = $menuCatalogueRepository;
    }

    public function paginate($request)
    {
        return [];
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {

            $payload = $request->only('name', 'keyword');
            $payload['keyword'] = Str::slug($payload['keyword']);
            $menuCatalogue = $this->menuCatalogueRepository->create($payload);

            DB::commit();
            return [
                'name' => $menuCatalogue->name,
                'id' => $menuCatalogue->id,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }
}
