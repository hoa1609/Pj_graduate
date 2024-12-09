<?php

namespace App\Services;

use App\Services\Interfaces\ReviewServiceInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface as ReviewRepository ;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Classes\ReviewNested;
use Illuminate\Support\Facades\Auth;

class ReviewService extends BaseService implements ReviewServiceInterface
{

    protected $reviewRepository;

    public function __construct(
        ReviewRepository $reviewRepository
    ) {
        $this->reviewRepository = $reviewRepository;
    }

    public function create($request) {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');
            // $payload['user_id'] = Auth::id();
            $review = $this->reviewRepository->create($payload);

            $this->reviewnestedset = new ReviewNested([
                'table' => 'reviews',
                'reviewable_type' => $payload['reviewable_type']
            ]);

            $this->reviewnestedset->Get();
            $set = $this->reviewnestedset->Set();
            $this->reviewnestedset->Recursive(0, $set);
            $this->reviewnestedset->Action();
            DB::commit();
            return [
                'code' => 10,
                'message' => 'Đánh giá sản phẩm thành công'
            ];
        } catch(\Exception $e ){
            DB::rollBack();
            // echo $e->getMessage(); die();
            return [
                'code' => 11,
                'message' => 'Có lỗi vui lòng thử lại: ' . $e->getMessage()
            ];
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try{
            $review = $this->reviewRepository->delete($id);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                echo $e->getMessage(); die();
                return false;
            }
    }


    public function paginate($request){

        $perPage = $request->integer('perpage', 10);
        $condition['keyword'] = $request->input('keyword');
        $reviews = $this->reviewRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'review/index'],
        );


        return $reviews;
    }
    private function paginateSelect(){
        return [
             'id',
             'reviewable_id',
             'reviewable_type',
             'fullname',
             'email',
             'phone',
             'description',
             'score',
             'gender',
        ];
     }

}
