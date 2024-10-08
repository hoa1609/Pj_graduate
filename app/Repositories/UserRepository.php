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
        $perPage = ''
    ) {
        $query = $this->model->select($column);

        // Áp dụng các điều kiện tìm kiếm
        if (!empty($condition)) {
            $query->where(function($query) use ($condition) {
                // Điều kiện tìm kiếm từ khóa
                if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                    $query->where(function($subQuery) use ($condition) {
                        $subQuery->where('name', 'LIKE', '%' . $condition['keyword'] . '%')
                                 ->orWhere('email', 'LIKE', '%' . $condition['keyword'] . '%')
                                 ->orWhere('phone', 'LIKE', '%' . $condition['keyword'] . '%')
                                 ->orWhere('address', 'LIKE', '%' . $condition['keyword'] . '%');
                    });
                }

                // Điều kiện trạng thái 'publish'
                if (isset($condition['publish']) && $condition['publish'] != -1) {
                    $query->where('publish', '=', $condition['publish']);
                }

                // Bạn có thể thêm nhiều điều kiện hơn ở đây nếu cần
            });
        }

        // Thực hiện liên kết (join) nếu có
        if (!empty($join)) {
            foreach ($join as $joinCondition) {
                $query->join(...$joinCondition);
            }
        }

        // Áp dụng phân trang và trả về kết quả
        return $query->paginate($perPage)
            ->withQueryString() // Giữ các tham số truy vấn
            ->withPath(env('APP_URL') . ($extend['path'] ?? '')); // Đường dẫn tùy chỉnh nếu có
    }

}
