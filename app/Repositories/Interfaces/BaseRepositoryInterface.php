<?php

namespace App\Repositories\Interfaces;

/**
 * Interface ProvinceServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function update(int $id = 0 , array $payload = []);
    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
              $perPage = '',
    );
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = [] );
}
