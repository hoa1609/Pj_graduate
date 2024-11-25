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


    // public function update(int $id = 0, array $payload = [])
    // {
    //     // Tìm đối tượng Promotion dựa trên ID
    //     $promotion = $this->findById($id);

    //     if ($promotion) {
    //         // Thực hiện cập nhật dữ liệu
    //         $promotion->update($payload);
    //         // Trả về đối tượng Promotion sau khi cập nhật
    //         return $promotion;
    //     }

    //     return false; // Trả về false nếu không tìm thấy promotion
    // }



    // ------ XỬ LÍ GIÁ KHUYẾN MÃI----------

    public function findByProduct(array $productId = []){
        return $this->model->select(
            'promotions.id as promotion_id',
            'promotions.discountValue',
            'promotions.discountType',
            'promotions.maxDiscountValue',
            'products.id as product_id',
            'products.price'
        )
        ->selectRaw(
            "
                MAX(
                    IF(promotions.maxdiscountValue != 0,
                        LEAST(
                            CASE
                            WHEN discountType = 'cash' THEN discountValue
                            WHEN discountType = 'percent' THEN products.price * discountValue / 100
                            ELSE 0
                            END,
                            promotions.maxDiscountValue
                        ),
                            CASE
                            WHEN discountType = 'cash' THEN discountValue
                            WHEN discountType = 'percent' THEN products.price * discountValue / 100
                            ELSE 0
                            END
                    )
                ) as discount
            "
        )
        ->join('promotion_product_variant as ppv', 'ppv.promotion_id', '=', 'promotions.id')
        ->join('products', 'products.id', '=', 'ppv.product_id')
        ->where('products.publish', 2)
        ->where('promotions.publish', 2)
        ->whereIn('products.id', $productId)
        ->where(function ($query) {
            $query->whereDate('promotions.endDate', '>', now())
                ->orWhereNull('promotions.endDate')
                ->orWhere('promotions.neverEndDate', 'accept');
        })
        ->groupBy(
            'products.id',
            'promotions.id',
            'promotions.discountValue',
            'promotions.discountType',
            'promotions.maxDiscountValue',
            'products.price'
        )
        ->get()->toArray();
    }


    public function findPromotionByVariantUuid($uuid = ''){
        return $this->model->select(
            'promotions.id as promotion_id',
            'promotions.discountValue',
            'promotions.discountType',
            'promotions.maxDiscountValue',
        )
        ->selectRaw(
            "
                MAX(
                    IF(promotions.maxdiscountValue != 0,
                        LEAST(
                            CASE
                            WHEN discountType = 'cash' THEN discountValue
                            WHEN discountType = 'percent' THEN pv.price * discountValue / 100
                            ELSE 0
                            END,
                            promotions.maxDiscountValue
                        ),
                            CASE
                            WHEN discountType = 'cash' THEN discountValue
                            WHEN discountType = 'percent' THEN pv.price * discountValue / 100
                            ELSE 0
                            END
                    )
                ) as discount
            "
        )
        ->join('promotion_product_variant as ppv', 'ppv.promotion_id', '=', 'promotions.id')
        ->join('product_variants as pv', 'pv.uuid', '=', 'ppv.variant_uuid')
        ->where('promotions.publish', 2)
        ->where('ppv.variant_uuid', $uuid)
        ->where(function ($query) {
            $query->whereDate('promotions.endDate', '>', now())
                ->orWhereNull('promotions.endDate')
                ->orWhere('promotions.neverEndDate', 'accept');
        })
        ->groupBy(
            'promotions.id',
            'promotions.discountValue',
            'promotions.discountType',
            'promotions.maxDiscountValue'
        )
        ->get();
    }
}
