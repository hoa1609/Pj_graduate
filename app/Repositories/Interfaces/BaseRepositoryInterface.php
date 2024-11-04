<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function all(array $relation);
    public function findById(int $id);
    public function update(int $id = 0 , array $payload = []);

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        int $perPage = 10,
        array $extend = [],
        array $orderBy = [],
        array $join = [],
        array $relations = [], 
    );

    public function updateByWhereIn(
        string $whereInField = '',
        array $whereIn = [], 
        array $payload = [] 
        );
    public function createPivot($model, array $payload = [], string $relation = '');
    public function createBatch(array $payload = []);
}
