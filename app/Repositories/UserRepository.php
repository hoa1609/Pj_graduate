<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(
        User $model
    ){
      $this-> model = $model;  
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
                    ->orWhere('email', 'LIKE', '%' .$condition['keyword']. '%')
                    ->orWhere('phone', 'LIKE', '%' .$condition['keyword']. '%')
                    ->orWhere('address', 'LIKE', '%' .$condition['keyword']. '%');
          }

          if(isset($condition['publish']) && $condition['publish'] != 0){
            $query->where('publish', '=', $condition['publish']);
          }
      })
      ->with('user_roles');
      
      if(!empty($join)){
          $query->join(...$join);
      }

      return $query->paginate($perPage)
                   ->withQueryString()->withPath(env('APP_URL').$extend['path']); // withQueryString giữ lại các gt query
  }
  
}
