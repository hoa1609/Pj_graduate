<?php

namespace App\Repositories;

use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepositoryInterface;


class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model) {
        $this->model  = $model;
    }

    public function create(array $payload = []){
        $model =  $this->model->create($payload);
        return $model->fresh();

    }

    public function update(int $id = 0, $payload = [])
    {
        $model = $this->findById($id);
        return $model->update($payload);
    }

    public function delete(int $id = 0)
    {
        return $this->findById($id)->delete();
    }

    public function updateByWhere($condition = [], array $payload = [])
    {
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where( $val[0], $val[1], $val[2]);
        }
        return $query->update($payload);
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
              $perPage = '',
        array $relations = []
    ){
        $query = $this->model->select($column)->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where('name', 'LIKE', '%' .$condition['keyword']. '%');
            }
        });

        if(isset($relations) && !empty($relations)) {
            foreach($relations as $relation){
                $query->withCount($relation);
            }
        }

        if(!empty($join)){
            $query->joins(...$join);
        }

        return $query
        ->paginate($perPage)
        ->withQueryString()
        ->withPath(env('APP_URL').$extend['path']);
    }

    public function all() {
        return $this->model->all();
    }

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = [],
    ) {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
}
