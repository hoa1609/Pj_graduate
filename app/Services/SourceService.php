<?php

namespace App\Services;

use App\Services\Interfaces\SourceServiceInterface;
use App\Repositories\Interfaces\SourceRepositoryInterface as SourceRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class SourceService implements SourceServiceInterface
{
    protected $sourceRepository;

    public function __construct(
        SourceRepository $sourceRepository
    ) {
        $this->sourceRepository = $sourceRepository;
    }

    public function paginate($request, $perPage = [])
    {
        $condition = [
            'keyword' => $request->input('keyword'),
            'publish' => $request->integer('publish'),
            'source_role_id' => $request->integer('source_role_id'),
        ];
        $sources = $this->sourceRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'source/index']
        );
        return $sources;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only('name', 'keyword', 'description');
            $source = $this->sourceRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }


    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only('name', 'keyword', 'description');
            $source = $this->sourceRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $source = $this->sourceRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }


    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload = [$post['field'] => (($post['value'] == 1) ? 2 : 1)];
            $source = $this->sourceRepository->update($post['modelId'], $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatusAll($post)
    {
        DB::beginTransaction();
        try {
            $payload = [$post['field'] => $post['value']];
            $flag = $this->sourceRepository->updateByWhereIn('id', $post['id'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }
    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'keyword',
            'publish',
            'description'
        ];
    }

}
