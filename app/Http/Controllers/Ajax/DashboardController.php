<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $language;
    public function changeStatus(Request $request)
    {
        $post = $request->input();
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
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
    // public function findModelObject(Request $request) {
    //     $get = $request->input();
    //     $alias = Str::snake($get['model']).'_language';
    //     $class = loadClass($get['model]);
    //     $object = $class->findWidgetItem([
    //         ['name', 'LIKE', '%'.$get['keyword'].'%'],
    //     ], $this->language, $alias);
    //     return reponse()->json($object);
    // }
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
