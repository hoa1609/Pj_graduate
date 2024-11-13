<?php

namespace App\Services;

use App\Services\Interfaces\WidgetServiceInterface;
use App\Repositories\Interfaces\WidgetRepositoryInterface as WidgetRepository;

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
            $object = $class->findByCondition(...$agrument)->toArray();
            dd($object);
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
