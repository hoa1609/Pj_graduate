<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Services\BaseService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Classes\Nestedsetbie;


/**
 * Class PostCatalogueService
 * @package App\Services
 */
class PostCatalogueService extends BaseService implements PostCatalogueServiceInterface
{
    protected $postCatalogueRepository;
    protected $nestedset;

    public function __construct(
        PostCatalogueRepository $postCatalogueRepository,
    ) {
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->currentLanguage(),
        ]);
    }

    private function paginateSelect()
    {
        return [
            'post_catalogues.id',
            'post_catalogues.image',
            'post_catalogues.level',
            'post_catalogues.publish',
            'post_catalogues.order',
            'tb2.name',
            'tb2.canonical',
        ];
    }

    private function payload()
    {
        return [
            'parent_id',
            'follow',
            'publish',
            'image'
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

    // public function paginate($request, $languageId){
    //     $perPage = $request->integer('perpage');
    //     $condition = [
    //         'keyword' => addslashes($request->input('keyword')),
    //         'publish' => $request->integer('publish'),
    //         'where' => [
    //             ['tb2.language_id', '=', $languageId]
    //         ]
    //     ];
    //     $postCatalogues = $this->postCatalogueRepository->pagination(
    //         $this->paginateSelect(),
    //         $condition,
    //         $perPage,
    //         ['path' => 'post.catalogue.index'],
    //         ['post_catalogues.lft', 'ASC'],
    //         [
    //             ['post_catalogue_language as tb2','tb2.post_catalogue_id', '=' , 'post_catalogues.id']
    //         ],
    //         ['languages']
    //     );


    //     return $postCatalogues;
    // }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');

        $postCatalogues = $this->postCatalogueRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'post.catalogue.index'],
            ['post_catalogues.lft', 'ASC'],
            [
                ['post_catalogue_language as tb2', 'tb2.post_catalogue_id', '=', 'post_catalogues.id']
            ],
            []
        );

        return $postCatalogues;
    }


    public function create($request)
    {
        DB::beginTransaction();
        try {

            $payload = $request->only($this->payload());
            $payload['user_id'] =  Auth::id();
            $postCatalogue = $this->postCatalogueRepository->create($payload);
            if ($postCatalogue->id > 0) {
                $payloadLanguage = $request->only($this->payloadLanguage());
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['post_catalogue_id'] = $postCatalogue->id;
                $language = $this->postCatalogueRepository->createLanguagePivot(
                $postCatalogue, $payloadLanguage);

            }
            $this->nestedset->Get('level ASC, order ASC');
            $this->nestedset->Recursive(0, $this->nestedset->Set());
            $this->nestedset->Action();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {

            $payload = $request->except(['_token', 'send']);
            $postCatalogue = $this->postCatalogueRepository->update($id, $payload);
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

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $postCatalogue = $this->postCatalogueRepository->delete($id);
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

    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            // Cập nhật trạng thái cho PostCatalogue
            // Nếu bật thì set thành 2, nếu tắt thì set thành 1
            $payload = [$post['field'] => (($post['value'] == 1) ? 2 : 1)];
            $this->postCatalogueRepository->update($post['modelId'], $payload);

            // $this->changeUserStatus($post, ($post['value'] == 1) ? 2 : 1);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function switch($id)
    {
        DB::beginTransaction();
        try {
            $postCatalogue = $this->postCatalogueRepository->update($id, ['current' => 1]);
            $payload = ['current' => 0];
            $where = [
                ['id', '!=', $id]
            ];
            $this->postCatalogueRepository->updateByWhere($where, $payload);
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
