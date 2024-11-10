<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\Language;
use Illuminate\Support\Str;


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

    public function changeStatusAll(Request $request)
    {
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
}
