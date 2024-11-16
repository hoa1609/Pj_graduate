<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\WidgetServiceInterface as WidgetService;
use App\Repositories\Interfaces\WidgetRepositoryInterface as WidgetRepository;


use App\Models\Language;
use App\Http\Requests\StoreWidgetRequest;
use App\Http\Requests\UpdateWidgetRequest;
use Illuminate\Http\Request;


class WidgetController extends Controller{

    protected $widgetService;
    protected $widgetRepository;
    protected $language;

    public function __construct(
        WidgetService $widgetService,
        WidgetRepository $widgetRepository,
    ) {
        $this->widgetService = $widgetService;
        $this->widgetRepository = $widgetRepository;

        $this->middleware(function ($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical',$locale)->first();
            $this->language = $language->id;
            return $next($request);
        });
    }

    public function index(Request $request){
        $this->authorize('modules', 'widget.index');

        $perPage = $request->integer('perPage', 10);
        $widgets = $this->widgetService->paginate($request, $perPage);
        
        $config['seo'] = config('apps.widget.index');
        $template = 'backend.widget.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'widgets',
        ));
    }


    public function create(){
        $this->authorize('modules', 'widget.create');

        $config['method'] = 'create';
        $config['seo'] = config('apps.widget.create');

        $template = 'backend.widget.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
        ));
    }


    public function store(StoreWidgetRequest $request){
        if ($this->widgetService->create($request)) {
            return redirect()->route('widget.index')->with('success', 'Thêm Widget thành công !');
        }
        return redirect()->route('widget.index')->with('error', 'Thêm widget thất bại !');
    }

    private function menuItemAgrument(array $whereIn = []){
        $language = $this->language ;
        return [
            'condition' => [],
            'flag' => true,
            'relation' => [
                'languages' => function ($query) use ($language){
                    $query->where('language_id',$language);
                }
            ],
            'orderBy' => ['id','desc'],
            'param' => [
                'whereIn' => $whereIn,
                'whereInFiled' => 'id'
            ]
            ];
    }

    public function edit($id){
        $this->authorize('modules', 'widget.edit');
        $widget = $this->widgetRepository->findById($id);
        $modelClass = loadClass($widget->model);
        $widgetItem = convertArrayByKey($modelClass->findByConditionEdit(
            ...array_values($this->menuItemAgrument($widget->model_id))
        ),['id','name.languages','image']);
        $config['method'] = 'edit';
        $album = ($widget->album);
        $config['seo'] = config('apps.widget.edit');
        $template = 'backend.widget.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'widget',
            'album',
            'widgetItem'
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'widget.delete');
        $widget = $this->widgetRepository->findById($id);
        $template = 'backend.widget.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'widget',
            
        ));
    }


    public function update($id, UpdateWidgetRequest $request){
        if ($this->widgetService->update($id, $request)) {
            return redirect()->route('widget.index')->with('success', 'Cập nhập thành viên thành công !');
        }
        return redirect()->route('widget.index')->with('error', 'Cập nhập thành viên thất bại !');
    }


    public function destroy($id){
        $this->authorize('modules', 'widget.destroy');

        if ($this->widgetService->destroy($id)) {
            return redirect()->route('widget.index')->with('success', 'Xóa thành viên thành công !');
        }
        return redirect()->route('widget.index')->with('error', 'Xóa thành viên thất bại !');
    }
}
