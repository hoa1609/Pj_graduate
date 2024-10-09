<?php

namespace App\Repositories;

use App\Models\UserRole;
use App\Repositories\Interfaces\UserRoleRepositoryInterface;
use App\Repositories\BaseRepository;


class UserRoleRepository extends BaseRepository implements UserRoleRepositoryInterface
{
    protected $model;

    public function __construct(
        UserRole $model
    ){
      $this-> model = $model;  
    }
}
