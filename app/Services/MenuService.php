<?php

namespace App\Services;

use App\Classes\Nestedsetbie;
use App\Services\Interfaces\MenuServiceInterface;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MenuService extends BaseService implements MenuServiceInterface
{
    protected $menuRepository;
    protected $menuCatalogueRepository;
    protected $nestedset;
    protected $language;
    protected $routerRepository;

    public function __construct(
        MenuRepository $menuRepository,
        MenuCatalogueRepository $menuCatalogueRepository,
    ) {
        $this->menuRepository = $menuRepository;
        $this->menuCatalogueRepository = $menuCatalogueRepository;
        $this->controllerName = 'MenuController';
    }

    public function paginate($request, $languageId)
    {
        return [];
    }

    private function initialize($languageId)
    {
        $this->nestedset = new Nestedsetbie([
            'table' => 'menus',
            'foreignkey' => 'menu_id',
            'isMenu' => TRUE,
            'language_id' =>  $languageId,
        ]);
    }

    public function save($request, $languageId)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only('menu', 'menu_catalogue_id');
            if (count($payload['menu']['name'])) {
                foreach ($payload['menu']['name'] as $key => $value) {
                    $menuId = $payload['menu']['id'][$key];
                    $menuArray = [
                        'menu_catalogue_id' => $payload['menu_catalogue_id'] ?? null,
                        'order' => $payload['menu']['order'][$key] ?? 0,
                        'user_id' => Auth::id(),
                    ];

                    if ($menuId == 0) {
                        $menuSave = $this->menuRepository->create($menuArray);
                    } else {
                        $menuSave = $this->menuRepository->update($menuId, $menuArray);
                        if ($menuSave->rgt - $menuSave->lft > 1) {
                            $this->menuRepository->updateByWhere(
                                [
                                    ['lft', '>', $menuSave->lft],
                                    ['rgt', '<', $menuSave->rgt],
                                ],
                                ['menu_catalogue_id' => $payload['menu_catalogue_id']]
                            );
                        }
                    }

                    if ($menuSave->id > 0) {
                        $menuSave->languages()->detach([$languageId, $menuSave->id]);
                        $payloadLanguage = [
                            'language_id' => $languageId,
                            'name' => $value,
                            'canonical' => $payload['menu']['canonical'][$key] ?? '',
                        ];
                        $this->menuRepository->createPivot($menuSave, $payloadLanguage, 'languages');
                    }
                }
                $this->initialize($languageId);
                $this->nestedset();
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
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

    public function saveChildren($request, $languageId, $menu){
        DB::beginTransaction();
        try {
            $payload = $request->only('menu');
            if (count($payload['menu']['name'])) {
                foreach ($payload['menu']['name'] as $key => $value) {
                    $menuId = $payload['menu']['id'][$key];
                    $menuArray = [
                        'menu_catalogue_id' => $menu->menu_catalogue_id,
                        'parent_id' => $menu->id,
                        'order' => $payload['menu']['order'][$key],
                        'user_id' => Auth::id(),
                    ];

                    $menuSave = ($menuId == 0) ? $this->menuRepository->create($menuArray) : $this->menuRepository->update($menuId, $menuArray);

                    if ($menuSave->id > 0) {
                        $menuSave->languages()->detach([$languageId, $menuSave->id]);
                        $payloadLanguage = [
                            'language_id' => $languageId,
                            'name' => $value,
                            'canonical' => $payload['menu']['canonical'][$key] ?? '',
                        ];
                        $this->menuRepository->createPivot($menuSave, $payloadLanguage, 'languages');
                    }
                }
                $this->initialize($languageId);
                $this->nestedset();
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function dragUpdate(array $json = [], int $menuCatalogueId = 0, int $languageId = 1, $parentId = 0){
        if(count($json)) {
            foreach($json as $key => $value) {
                $update = [
                    'order' => count($json) - $key,
                    'parent_id' => $parentId,
                ];

                $menu = $this->menuRepository->update($value['id'], $update);
                if (isset($value['children']) && count($value['children'])) {
                    $this->dragUpdate($value['children'], $menuCatalogueId, $languageId, $value['id']);
                }
            }
        }
        $this->initialize($languageId);
        $this->nestedset();
    }

    public function getAndConvertMenu($menu = null, $language = 1): array{
        $menuList = $this->menuRepository->findByCondition([
            ['parent_id', '=', $menu->id]
        ], TRUE, [
            'languages' => function ($query) use ($language) {
                $query->where('language_id', $language);
            },
        ]);
        $return = $this->convertMenu($menuList);
        return $return;
    }

    public function convertMenu($menuList = null){
        $temp = [];
        $fields = ['name', 'canonical', 'order', 'id'];
        if (count($menuList)) {
            foreach ($menuList as $key => $value) {
                foreach ($fields as $field) {
                    if ($field == 'name' || $field == 'canonical') {
                        $temp[$field][] = $value->languages->first()->pivot->{$field};
                    } else {
                        $temp[$field][] = $value->{$field};
                    }
                }
            }
        }
        return $temp;
    }


    public function destroy($id){
        DB::beginTransaction();
        try {
            // Xóa tất cả các menu liên quan tới menu_catalogue
            $menusDeleted = $this->menuRepository->forceDeleteByCondition([
                ['menu_catalogue_id', '=', $id],
            ]);

            // Xóa menu_catalogue
            $menuCatalogueDeleted = $this->menuCatalogueRepository->forceDelete($id);

            DB::commit();

            // Kiểm tra kết quả xóa
            if ($menusDeleted && $menuCatalogueDeleted) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            DB::rollBack();

            // Ghi log lỗi để dễ dàng debug
            // Log::error('Xóa menu thất bại: ' . $e->getMessage());

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
}
