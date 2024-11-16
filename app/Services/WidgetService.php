<?php

namespace App\Services;

use App\Services\Interfaces\WidgetServiceInterface;
use App\Repositories\Interfaces\WidgetRepositoryInterface as WidgetRepository;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class WidgetService implements WidgetServiceInterface
{
    protected $widgetRepository;

    public function __construct(
        WidgetRepository $widgetRepository
    ) {
        $this->widgetRepository = $widgetRepository;
    }

    public function paginate($request, $perPage = [])
    {
        $condition = [
            'keyword' => $request->input('keyword'),
            'publish' => $request->integer('publish'),
            'widget_role_id' => $request->integer('widget_role_id'),
        ];
        $widgets = $this->widgetRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'widget/index']
        );
        return $widgets;
    }


    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload = [$post['field'] => (($post['value'] == 1) ? 2 : 1)];
            $widget = $this->widgetRepository->update($post['modelId'], $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatusAll($post)
    {
        DB::beginTransaction();
        try {
            $payload = [$post['field'] => $post['value']];
            $flag = $this->widgetRepository->updateByWhereIn('id', $post['id'], $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only('name', 'keyword', 'short_code', 'description', 'model', 'album');
            $payload['model_id'] = $request->input('model_id.id');
            $widget = $this->widgetRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only('name', 'keyword', 'short_code', 'description', 'model', 'album');
            $payload['model_id'] = $request->input('model_id.id');
            $widget = $this->widgetRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $widget = $this->widgetRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }


    private function convertBirthdayDate($birthday = '')
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }

    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'keyword',
            'publish',
            'short_code'
        ];
    }


    /*FRONT END SERVICE*/
    public function findWidgetByKeyword(string $keyword = '', int $language = 1, $param = []){
        $widget = $this->widgetRepository->findByCondition(
            [
                ['keyword', '=', $keyword],
                config('apps.general.defaultPublish')
            ]
        );
        if(!is_null($widget)){
            $class = loadClass($widget->model);
            $agrument = $this->widgetAgrument($widget, $language, $param);
            $object = $class->findByCondition(...$agrument);
            $model = lcfirst(str_replace('Catalogue','', $widget->model));
            if(strpos($widget->model, 'Catalogue') && isset($param['children']) && $model == 'product'){
                if(count($object)){
                    foreach($object as $key =>$val){

                        if($val->id != 4) continue;
                        $productId = $val->products->pluck('id');
                        $promotions = $this->promotionRepository->findByProduct($productId);
                    }
                }


            };

        }
    } 

    private function widgetAgrument($widget, $language, $param){
        $relation = [
            'languages' => function($query) use ($language){
                $query->where('language_id', $language);
            }
        ];
        $withCount = [];
        if(strpos($widget->model, 'Catalogue') && isset($param['children'])){
            $model = lcfirst(str_replace('Catalogue','', $widget->model)).'s';
            $relation[$model] = function($query) use ($param, $language){
                $query->limit(($param['limit']) ?? 8);
                $query->where('publish', 2);
                $query->with('languages', function($query) use ($language){
                    $query->where('language_id', $language);
                });

                
            };
            $withCount[] = $model;
        }

        return [
            'condition' => [
                config('apps.general.defaultPublish')
            ],
            'flag' => true,
            'relation' => $relation,
            'param' => [
                'WhereIn' => $widget->model_id,
                'whereInField' => 'id'
            ],
            'withCount' => $withCount
        ];
    }
}


// $query->with('promotions', function($query){
//     $query->select(
//         'promotions.id',
//         'promotions.discountValue',
//         'promotions.discountType',
//         'promotions.maxDiscountValue',
//         DB::raw(
//             "
//             IF(promotions.maxdiscountValue != 0,
//                 LEAST(
//                     CASE
//                         WHEN discountType = 'cash' THEN (SELECT price FROM products
//                         WHERE products.id = product_id) - discountValue 
//                         WHEN discountType = 'percent' THEN (SELECT price FROM
//                         products WHERE products.id = product_id) - ((SELECT price FROM products
//                         WHERE products.id = product_id)*discountValue/100)
//                         ELSE (SELECT price FROM products
//                         WHERE products.id = product_id)
//                     END,
//                     promotions.maxDiscountValue
//                 ),

//                 CASE
//                     WHEN discountType = 'cash' THEN (SELECT price FROM products
//                     WHERE products.id = product_id) - discountValue 
//                     WHEN discountType = 'percent' THEN (SELECT price FROM
//                     products WHERE products.id = product_id) - ((SELECT price FROM products
//                     WHERE products.id = product_id)*discountValue/100)
//                     ELSE (SELECT price FROM products
//                     WHERE products.id = product_id)
//                 END
//             )
//                 as discount
//             "
//         )
//     );
//     $query->where('publish', 2);
//     $query->where('endDate', '>', now());
//     $query->orderBy('discount', 'asc');
//     $query->take(5);
// });