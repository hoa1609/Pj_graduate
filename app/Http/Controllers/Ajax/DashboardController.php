<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    protected $language;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            return $next($request);
        });
    }



    public function changeStatus(Request $request)
    {
        $post = $request->input();
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) .
        'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }

        $flag = $serviceInstance->updateStatus($post);

        return response()->json(['flag' => $flag, 'success' => true]);
    }
    public function changeStatusAll(Request $request){

        $post = $request->input();
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $flag = $serviceInstance->updateStatusAll($post);
        return response()->json(['flag' => $flag]);
    }
    public function findModelObject(Request $request)
    {
        $get = $request->input();
        $languageTable = Str::snake($get['model']).'_language';
        $language = $this->language;
        $class = $this->loadClassInterface($get['model'], 'Repository');
        $object = $class->findByWhereHas([
            ['name', 'like' ,'%'.$get['keyword'].'%'],
            // ['language_id','=', $this->language],
        ],'languages',$languageTable, TRUE, TRUE);

        return response()->json($object);

        // $get = $request->input();
        // $alias = Str::snake($get['model']).'_language';
        // $class = $this->loadClassInterface($get['model'], 'Repository');
        // $object = $class->findWidgetItem([
        //     ['name', 'like' ,'%'.$get['keyword'].'%'],
        // ],$this->language, $alias);
        // // dd($object);
        // return response()->json($object);
    }
    private function loadClassInterface(string $model = '', $interface = 'Repository')
    {
        $serviceInterfaceNamespace = '\App\Repositories\\' . ucfirst($model) . $interface;
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        return $serviceInstance;
    }
    public function getMenu(Request $request)
    {
        // Xác thực tham số 'model'
        $request->validate([
            'model' => 'required|string|alpha_dash',
        ]);

        $model = $request->input('model');

        $page = $request->input('page') ?? 1;
        $keyword = ($request->string('keyword')) ?? null;
        // echo $page;die();

        $serviceInterfaceNamespace = '\App\Repositories\\' . ucfirst($model) . 'Repository';

        // Kiểm tra xem repository class có tồn tại không
        if (!class_exists($serviceInterfaceNamespace)) {
            Log::error("Repository class does not exist: {$serviceInterfaceNamespace}");
            return response()->json(['error' => "Repository {$serviceInterfaceNamespace} does not exist."], 404);
        }

        // Tạo instance của repository
        $serviceInstance = app($serviceInterfaceNamespace);

        $arguments = $this->paginationArgument($model, $keyword);

        if (!method_exists($serviceInstance, 'pagination')) {
            Log::error("Pagination method does not exist in repository: {$serviceInterfaceNamespace}");
            return response()->json(['error' => 'Pagination method does not exist in the repository.'], 500);
        }

        $object = $serviceInstance->pagination(...array_values($arguments));

        if (empty($object)) {
            return response()->json(['data' => []]);
        }

        return response()->json($object);
    }

    private function paginationArgument(string $model = '', string $keyword): array
    {
        if (empty($model)) {
            throw new \InvalidArgumentException("Model cannot be empty.");
        }

        $model = \Illuminate\Support\Str::snake($model);
        $join = [
            [$model . '_language as tb2', 'tb2.' . $model . '_id', '=', $model . 's.id'],
        ];

        if (strpos($model, '_catalogue') === false) {
            $join[] = [$model . '_catalogue_' . $model . ' as tb3', $model . 's.id', '=', 'tb3.' . $model . '_id'];
        }

        $condition = [
            'where' => [
                ['tb2.language_id', '=', $this->language ?? 'default_language_id'],
            ],
            'keyword' => $keyword
        ];
        return [
            'select' => ['id', 'name', 'canonical'],
            'condition' => $condition,
            'perpage' => 5,
            'paginationConfig' => [
                'path' => $model . '.index',
                'groupBy' => ['id', 'name', 'canonical']
            ],
            'orderBy' => [$model . 's.id', 'DESC'],
            'join' => $join,
            'relations' => [],
        ];
    // public function findModelObject(Request $request) {
    //     $get = $request->input();
    //     $alias = Str::snake($get['model']).'_language';
    //     $class = loadClass($get['model]);
    //     $object = $class->findWidgetItem([
    //         ['name', 'LIKE', '%'.$get['keyword'].'%'],
    //     ], $this->language, $alias);
    //     return reponse()->json($object);
    }
    public function findPromotionObject(Request $request) {
        $get = $request->input();
        $model = $get['option']['model'];
        $keyword = $get['search'];
        $alias = Str::snake($model).'_language';
        $class = loadClass($model);
        $object = $class->findWidgetItem([
            ['name', 'LIKE', '%'.$keyword.'%'],
        ], $this->language, $alias);
        $temp = [];
        if(count($object)){
            foreach($object as $key => $val){
                $temp[] = [
                    'id' =>$val->id,
                    'text' => $val->languages->first()->pivot->name,
                ];
            }
            return response()->json(array('items' => $temp));
        }
    }
    public function getPromotionConditionValue(Request $request)
    {
        try {
            $get = $request->input();
        switch ($get['value']) {
            case 'staff_take_care_customer':
                $class = loadClass('User');
                $object = $class->all()->toArray();
                break;
             case 'customer_group':
                $class = loadClass('CustomerCatalogue');
                $object = $class->all()->toArray();
                break;
             case 'customer_gender':
                $object = __('module.gender');
                break;
             case 'customer_birthday':
                $object = __('module.day');
                break;
            default:
                break;
        }

        $temp = [];
        if(!is_null($object) && count($object)) {
            foreach ($object as $key => $val) {
                $temp[] = [
                    'id' => $val['id'],
                    'text' => $val['name'],
                ];
            }
        }
            return response()->json([
                'data' => $temp,
                'error' => false,
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => true,
                'messages' => $e->getMessage()
            ]);
        }

    }
}
