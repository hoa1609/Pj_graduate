<?php

namespace App\Services;

use App\Services\Interfaces\PromotionServiceInterface;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use App\Enums\PromotionEnum;


/**
 * Class PromotionService
 * @package App\Services
 */
class PromotionService  extends BaseService implements PromotionServiceInterface
{
    protected $promotionRepository;

    public function __construct(
        PromotionRepository $promotionRepository
    ) {
        $this->promotionRepository = $promotionRepository;
    }

    private function paginateSelect(){
        return [
             'id',
             'name',
             'code',
             'description',
             'order',
             'method',
             'discountInformation',
             'neverEndDate',
             'startDate',
             'endDate',
             'order',
             'publish',
        ];
     }

    public function paginate($request, $languageId){

        $perPage = $request->integer('perpage', 10);
        $condition['keyword'] = $request->input('keyword');
        $promotions = $this->promotionRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'promotion/index']
        );
        return $promotions;
    }

    private function request($request)
    {
        $payload = $request->only(
            'name',
            'code',
            'description',
            'method',
            'discountValue',
            'startDate',
            'endDate',
            'neverEndDate'
        );
        $payload['maxDiscountValue'] = $request->input(PromotionEnum::PRODUCT_AND_QUANTITY.'.maxDiscountValue');
        $payload['discountValue'] = convert_price($request->input(PromotionEnum::PRODUCT_AND_QUANTITY.'.discountValue'));
        $payload['discountType'] = $request->input(PromotionEnum::PRODUCT_AND_QUANTITY.'.discountType');

        if (isset($payload['neverEndDate']) && $payload['neverEndDate'] === 'accept') {
            $payload['endDate'] = null;
        } elseif (!empty($payload['endDate'])) {
            try {
                $payload['endDate'] = Carbon::createFromFormat('d/m/Y H:i', $payload['endDate']);
            } catch (\Exception $e) {
                // Log::error("Lỗi: " . $payload['endDate'] . " | Error: " . $e->getMessage());

                $payload['endDate'] = Carbon::parse($payload['endDate']);
            }
        }
        $payload['code'] = (empty($payload['code'])) ? time() : $payload['code'];
        switch ($payload['method']) {
            case PromotionEnum::ORDER_AMOUNT_RANGE:
                $payload[PromotionEnum::DISCOUNT] = $this->orderByRange($request);
                break;
            case PromotionEnum::PRODUCT_AND_QUANTITY:
                $payload[PromotionEnum::DISCOUNT] = $this->productAndQuantity($request);

                break;
        }
        return $payload;
    }


    public function create($request, $languageId){
        DB::beginTransaction();
        try{

            $payload = $this->request($request);
            $promotion = $this->promotionRepository->create($payload);
            if($promotion->id > 0 ) {
                $this->handRelation($request, $promotion);
            }
            // $payload['user_id'] =  Auth::id();
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $this->request($request);
            $promotion = $this->promotionRepository->update($id, $payload);
            // dd($promotion);
            $this->handRelation($request, $promotion, 'update');
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }
    private function handRelation($request, $promotion, $method = 'create') {
        if($request->input('method') === PromotionEnum::PRODUCT_AND_QUANTITY){
            $object = $request->input('object');
            $payload = [];
            if(!is_null($object)) {
                foreach($object['id'] as $key => $val) {
                    $payload[] = [
                        'product_id' => $val,
                        'variant_uuid' => $object['variant_uuid'][$key],
                        'model' => $request->input(PromotionEnum::MODULE_TYPE),
                    ];
                }
            }
            if($method == 'update') {
                $promotion->products()->detach();
            }
            $promotion->products()->sync($payload);
        }
    }


    private function handleSourceAndCondition($request)
    {
        $data = [
            'source' => [
                'status' => $request->input('source'),
                'data' => $request->input('sourceValue'),
            ],
            'apply' => [
                'status' => $request->input('applyStatus'),
                'data' => $request->input('applyValue'),

            ]
        ];
        if(!is_null($data['apply']['data']))
        foreach ($data['apply']['data'] as $key => $val) {
            $data['apply']['condition'][$val] = $request->input($val);
        }
        return $data;
    }
    private function orderByRange($request)
    {
        $data['info'] = $request->input('promotion_order_amount_range');
        return $data + $this->handleSourceAndCondition($request);
    }

    private function productAndQuantity($request)
    {
        $data['info'] = $request->input('product_and_quantity');
        $data['info']['model'] = $request->input(PromotionEnum::MODULE_TYPE);
        $data['info']['object'] = $request->input('object');
        return $data + $this->handleSourceAndCondition($request);

    }

    public function destroy($id){
        DB::beginTransaction();
        try{
            $promotion = $this->promotionRepository->delete($id);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                // Log::error($e->getMessage());
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function updateStatus($promotion = [])
    {
        DB::beginTransaction();
        try {
            $payload = [$promotion['field'] =>(($promotion['value'] == 1) ? 2 : 1)];
            $promotion = $this->promotionRepository->update($promotion['modelId'], $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatusAll($promotion){
        DB::beginTransaction();
        try{
            $payload[$promotion['field']] = $promotion['value'];
            $flag = $this->promotionRepository->updateByWhereIn('id', $promotion['id'], $payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

}
