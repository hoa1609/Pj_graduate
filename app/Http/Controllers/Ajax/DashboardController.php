<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use App\Repositories\BaseRepository;



class DashboardController extends Controller
{

    protected $language = 1;

    public function changeStatus(Request $request){
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


}
