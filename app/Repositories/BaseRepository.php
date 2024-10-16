<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


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
    ){
        $query = $this->model->select($column)->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where('name', 'LIKE', '%' .$condition['keyword']. '%');
            }
            if(isset($condition['publish']) && $condition['publish'] != 0){
                $query->where('publish', '=', $condition['publish']);
              }
            if(isset($condition['where']) && count($condition['where'])){
                foreach($condition['where'] as $key =>$val){
                    $query->where($val[0], $val[1], $val[2]);
                }
            }
        });

        if(isset($relations) && !empty($relations)){
            foreach($relations as $relation){
                $query->withCount($relation);
            }
        }
        
        if(isset($join) && is_array($join) && count($join)){
            foreach($join as $key => $val){
                $query->join($val[0], $val[1], $val[2], $val[3]);
            }
        }

        if(isset($orderBy) && !empty($orderBy)){
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        return $query->paginate($perPage)
        ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function all(){
        return $this->model->all();
    }

    public function create(array $payload =[]){
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function delete($id){
        return $this->findById($id)->delete();
    }

    public function forceDelete($id){
        return $this->findById($id)->forceDelete();
    }

    public function update(int $id = 0, array $payload = []){
        $model = $this->findById($id);
        return $model->update($payload);
    }

    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = [] ){
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }


    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = [],
    ) {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function createLanguagePivot($model, array $payload = []){
        // dd($model->languages());
        return $model->languages()->attach($model->id, $payload);
      }

    
}
