<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
              $perPage = '',
        array $relation = []
    ){
        $query = $this->model->select($column)->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where('name', 'LIKE', '%' .$condition['keyword']. '%')
                ->orwhere('email', 'LIKE', '%' .$condition['keyword']. '%')
                ->orwhere('phone', 'LIKE', '%' .$condition['keyword']. '%')
                ->orwhere('address', 'LIKE', '%' .$condition['keyword']. '%');
            }
        })->with('user_catalogues');
        if(!empty($join)){
            $query->joins(...$join);
        }

        return $query
        ->paginate($perPage)
        ->withQueryString()
        ->withPath(env('APP_URL').$extend['path']);
    }

    public function updateByWhereIn($column, $values, $payload)
    {
        return DB::table('users') 
            ->whereIn($column, $values)
            ->update($payload);
    }

}
