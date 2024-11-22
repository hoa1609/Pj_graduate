<?php

namespace App\Services;

use App\Services\Interfaces\OrderServiceInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
use App\Repositories\Interfaces\ProductVariantRepositoryInterface as ProductVariantRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class OrderService extends BaseService implements OrderServiceInterface
{
    protected $orderRepository;
    protected $productVariantRepository;
    protected $productRepository;

    public function __construct(
        OrderRepository $orderRepository,
        ProductVariantRepository $productVariantRepository,
        ProductRepository $productRepository,
    ) {
        $this->orderRepository = $orderRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->productRepository = $productRepository;
    }

    public function paginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->input('publish');

        foreach (__('cart') as $key => $val) {
            $condition['dropdown'][$key] = $request->string($key);
        }


        $perPage = $request->integer('perpage');
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'order/index'],
            // ['id' => 'desc'],
        );
        return $orders;
    }

    public function getOrderItemImage($order) {
        foreach ($order->products as $key => $val) {
            $uuid = $val->pivot->uuid;
            if(is_null($order->uuid)){
                $variant = $this->productVariantRepository->findByCondition([
                    ['uuid', '=', $order->uuid]
                ]);
                $variantImage = explode(',' ,$variant->album)[0] ?? null;
                $val->image = $variantImage;
            }
        }
        return $order;
    }

    private function paginateSelect(){
       return [
            'id',
            'code',
            'fullname',
            'phone',
            'email',
            'province_id',
            'district_id',
            'ward_id',
            'address',
            'description',
            'promotion',
            'cart',
            'customer_id',
            'guest_cookie',
            'method',
            'confirm',
            'payment',
            'delivery',
            'shipping',
            'created_at',
       ];
    }
}

