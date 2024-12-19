<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(
        Model $model
    ) {
        $this->model = $model;
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        int $perPage = 1,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = [],
        array $relations = [],
        array $rawQuery = []
    ) {
        $query = $this->model->select($column);
        return $query
            ->keyword($condition['keyword'] ?? null)
            ->publish($condition['publish'] ?? null)
            ->userCatalogueId($condition['user_role_id'] ?? null)
            ->relationCount($relations ?? null)
            ->CustomWhere($condition['where'] ?? null)
            ->customWhereRaw($rawQuery['whereRaw'] ?? null)
            ->customJoin($join ?? null)
            ->customGroupBy($extend['groupBy'] ?? null)
            ->customOrderBy($orderBy ?? null)
            ->paginate($perPage)
            ->withQueryString()
            ->withPath(env('APP_URL') . $extend['path']);
    }


    public function all(array $relation = [])
    {
        return $this->model->with($relation)->get();
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function delete($id)
    {
        return $this->findById($id)->delete();
    }

    public function forceDelete($id)
    {
        return $this->findById($id)->forceDelete();
    }

    public function updateOrInsert(array $payload = [], array $condition = []){
        return $this->model->updateOrInsert($condition, $payload);
    }

    // 103 chỉnh như update như vậy
    // public function update(int $id = 0, array $payload = [])
    // {
    //     $model = $this->findById($id);
    //     return $model->update($payload);
    // }
    public function update(int $id = 0, array $payload = [])
    {
        $model = $this->findById($id);
        $model->fill($payload);
        $model->save();
        return $model;
    }

    public function createBatch(array $payload = [])
    {
        return $this->model->insert($payload);
    }


    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = [])
    {
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }

    public function updateByWhere($condition = [], array $payload = [])
    {
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0], $val[1], $val[2]);
        }
        return $query->update($payload);
    }

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = [],
    ) {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function forceDeleteByCondition(array $condition = [])
    {
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0], $val[1], $val[2]);
        }
        return $query->forceDelete();
    }

    public function findByCondition(
        $condition = [],
        $flag = false,
        $relation =[],
        array $orderBy = ['id', 'desc'],
        array $param = [],
        array $withCount = [],
    ){
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0], $val[1], $val[2]);
        }
        if(isset($param['whereIn'])){
            $query->whereIn($param['whereInField'], $param['whereIn']);
        }
        $query->with($relation);
        $query->withCount($withCount);
        $query->orderBy($orderBy[0], $orderBy[1]);
        return ($flag == false) ? $query->first() : $query->get();
    }

    public function createPivot($model, array $payload = [], string $relation = '')
    {
        return $model->{$relation}()->attach($model->id, $payload);
    }

    public function findByWhereHas(array $condition = [], string $relation = '', string $alias = '', $flag = false, $redirectWhere = false)
    {
        $query = $this->model->with($relation);
        $query->whereHas($relation, function ($query) use ($condition, $alias, $redirectWhere) {
            if ($redirectWhere == true) {
                foreach ($condition as $key => $value) {
                    $query->where($alias . '.' . $value[0], $value[1],$value[2]);
                }
            } else {
                foreach ($condition as $key => $value) {
                    $query->where($alias . '.' . $key, $value);
                }
            }
        });
        return ($flag == false) ? $query->first() : $query->get() ;
    }

    public function findWidgetItem(array $condition = [], int $language_id = 1, string $alias = ''){
        return $this->model->with([
            'languages' => function ($query) use ($language_id){
                $query->where('language_id',$language_id);
            }
        ])
        ->where('languages',function ($query) use ($condition,$alias){
            foreach($condition as $key => $val){
                $query->where($alias.'.'.$val[0],$val[1],$val[2]);
            }
        })->get();
    }

    public function findByConditionEdit(
        $condition = [],
        $flag = false,
        $relation = [],
        array $orderBy = ['id','desc'],
        array $param = [],
    ){
        $query = $this->model->newQuery();
        foreach ($condition as $key => $value) {
            $query->where($value[0],$value[1],$value[2]);
        }

        if (isset($param['whereIn'])) {
            $query->whereIn($param['whereInFiled'],$param['whereIn']);
        }
        $query->with($relation);
        $query->orderBy($orderBy[0],$orderBy[1]);
        return ($flag == false) ? $query->first() : $query->get();
    }

    public function recursiveCategory(string $parameter = '', $table = ''){
        $table = $table.'_catalogues';
        $query = "
            WITH RECURSIVE category_tree AS (
                SELECT id, parent_id, deleted_at
                FROM $table
                WHERE id IN (?)
                UNION ALL
                SELECT c.id, c.parent_id, c.deleted_at
                FROM $table as c
                JOIN category_tree as ct ON ct.id = c.parent_id
            )
            SELECT id FROM category_tree WHERE deleted_at IS NULL
        ";
        $results = DB::select($query, [$parameter]);
        return $results;
    }

    public function findObjectByCatelogueIds($catIds = [], $model, $language){
        $query = $this->model->newQuery();
        $this->model->select(
                $model.'s.*',
            )
            ->where(
                [config('apps.general.defaultPublish')]
            )
            ->with('languages', function($query) use ($language){
                $query->where('language_id', $language);
            })
            ->with($model.'_catalogues', function($query) use ($language){
                $query->with('languages', function($query) use ($language){
                    $query->where('language_id', $language);
                });
            });

            if($model === 'product'){
                $query ->with('product_variants');
            }

            $query->join($model.'_catalogue_'.$model.' as tb2', 'tb2.'.$model.'_id', '=', $model.'s.id')
            ->whereIn('tb2.'.$model.'_catalogue_id', $catIds)
            ->orderBy('order', 'desc')
            ->limit(5)
            ->get();

        return $query->get();
    }


    public function breadcrumb($model, $language){
        return $this->findByCondition([
            ['lft', '<=', $model->lft],
            ['rgt', '>=', $model->rgt],
            config('apps.general.defaultPublish'),
        ], true, [
            'languages' => function($query) use ($language){
                $query->where('language_id', $language);
            }
        ], ['lft', 'asc']);
    }



}
