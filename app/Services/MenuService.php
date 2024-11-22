<?php

namespace App\Services;

use App\Services\Interfaces\MenuServiceInterface;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class MenuService extends BaseService implements MenuServiceInterface
{
    protected $menuRepository;
    protected $nestedset;
    protected $language;
    protected $routerRepository;

    public function __construct(
        MenuRepository $menuRepository,
    ) {
        $this->menuRepository = $menuRepository;
        $this->controllerName = 'MenuController';
    }

    public function paginate($request, $languageId)
    {
        return [];
    }

    public function create($request, $languageId)
    {
        DB::beginTransaction();
        try {

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }

    private function createMenu($request)
    {
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        $menu = $this->menuRepository->create($payload);
        return $menu;
    }

    private function uploadMenu($menu, $request)
    {
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        return $this->menuRepository->update($menu->id, $payload);
    }

    private function updateLanguageForMenu($menu, $request, $languageId)
    {
        $payload = $request->only($this->payloadLanguage());
        $payload = $this->formatLanguagePayload($payload, $menu->id, $languageId);
        $menu->languages()->detach([$languageId, $menu->id]);
        return $this->menuRepository->createPivot($menu, $payload, 'languages');
    }
    private function updateCatalogueForMenu($menu, $request)
    {
        $menu->Menu_catalogues()->sync($this->catalogue($request));
    }

    private function formatLanguagePayload($payload, $menuId, $languageId)
    {
        $payload['language_id'] = $languageId;
        $payload['Menu_id'] = $menuId;
        return $payload;
    }


    private function catalogue($request)
    {
        if ($request->input('catalogue') != null) {
            return array_unique(array_merge($request->input('catalogue'), [$request->Menu_catalogue_id]));
        }
        return [$request->Menu_catalogue_id];
    }

    public function update($id, $request, $languageId)
    {
        DB::beginTransaction();
        try {
            $menu = $this->menuRepository->findById($id);
            if ($this->uploadMenu($menu, $request)) {
                $this->updateLanguageForMenu($menu, $request, $languageId);
                $this->updateCatalogueForMenu($menu, $request);
                $this->updateRouter($menu, $request, $this->controllerName, $languageId);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $menuCatalogue = $this->menuRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatus($menu = [])
    {
        DB::beginTransaction();
        try {
            $payload[$menu['field']] = (($menu['value'] == 1) ? 2 : 1);
            $menuCatalogues = $this->menuRepository->update($menu['modelId'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatusAll($menu)
    {
        DB::beginTransaction();
        try {
            $payload[$menu['field']] = $menu['value'];
            $flag = $this->menuRepository->updateByWhereIn('id', $menu['id'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    private function paginateSelect()
    {
        return [
            'Menus.id',
            'Menus.publish',
            'Menus.image',
            'Menus.order',
            'tb2.name',
            'tb2.canonical',
        ];
    }

    private function payload()
    {
        return [
            'follow',
            'publish',
            'image',
            'album',
            'Menu_catalogue_id',
        ];
    }

    private function payloadLanguage()
    {
        return [
            'name',
            'description',
            'content',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'canonical'
        ];
    }
}
