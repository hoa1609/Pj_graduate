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
             'keyword',
             'publish',
             'item',
        ];
     }

    public function paginate($request, $languageId){

        $perPage = $request->integer('perpage', 10);
        $condition['keyword'] = $request->input('keyword');
        $promotions = $this->promotionRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'promotion/index'],
        );

        return $promotions;
    }


    public function create($request, $languageId){
        DB::beginTransaction();
        try{
            $payload = $request->only(['_token', 'name', 'keyword', 'setting', 'short_code']);
            $payload['user_id'] =  Auth::id();
            $promotion = $this->promotionRepository->create($payload);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function update($id, $request, $languageId){
        DB::beginTransaction();
        try{
            $payload = $request->only(['_token', 'name', 'keyword', 'setting', 'short_code']);
            $promotion = $this->promotionRepository->update($id, $payload);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                // Log::error($e->getMessage());
                // echo $e->getMessage(); die();
                return false;
            }
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
