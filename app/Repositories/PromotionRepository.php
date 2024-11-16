<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\Interfaces\PromotionRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class UserService
 * @package App\Services
 */
class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    protected $model;

    public function __construct(
        Promotion $model
    ){
        $this->model = $model;
    }


    public function update(int $id = 0, array $payload = [])
    {
        // Tìm đối tượng Promotion dựa trên ID
        $promotion = $this->findById($id);

        if ($promotion) {
            // Thực hiện cập nhật dữ liệu
            $promotion->update($payload);
            // Trả về đối tượng Promotion sau khi cập nhật
            return $promotion;
        }

        return false; // Trả về false nếu không tìm thấy promotion
    }




}
