<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SourceServiceInterface as SourceService;
use App\Repositories\Interfaces\SourceRepositoryInterface as SourceRepository;


use App\Http\Requests\Source\StoreSourceRequest;
use App\Http\Requests\Source\UpdateSourceRequest;
use Illuminate\Http\Request;


class SourceController extends Controller{

    protected $sourceService;
    protected $sourceRepository;
    protected $language;

    public function __construct(
        SourceService $sourceService,
        SourceRepository $sourceRepository,
    ) {
        $this->sourceService = $sourceService;
        $this->sourceRepository = $sourceRepository;

        $this->middleware(function ($request, $next){
            $locale = app()->getLocale();
            return $next($request);
        });
    }

    public function index(Request $request){
        $this->authorize('modules', 'source.index');

        $perPage = $request->integer('perPage', 10);
        $sources = $this->sourceService->paginate($request, $perPage);

        $config['seo'] = config('apps.source.index');
        $template = 'backend.source.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'sources',
        ));
    }


    public function create(){
        $this->authorize('modules', 'source.create');

        $config['method'] = 'create';
        $config['seo'] = config('apps.source.create');

        $template = 'backend.source.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
        ));
    }


    public function store(StoreSourceRequest $request){
        if ($this->sourceService->create($request)) {
            return redirect()->route('source.index')->with('success', 'Thêm bản ghi thành công !');
        }
        return redirect()->route('source.index')->with('error', 'Thêm bản ghi thất bại !');
    }

    // private function menuItemAgrument(array $whereIn = []){
    //     $language = $this->language ;
    //     return [
    //         'condition' => [],
    //         'flag' => true,
    //         'relation' => [
    //             'languages' => function ($query) use ($language){
    //                 $query->where('language_id',$language);
    //             }
    //         ],
    //         'orderBy' => ['id','desc'],
    //         'param' => [
    //             'whereIn' => $whereIn,
    //             'whereInFiled' => 'id'
    //         ]
    //         ];
    // }

    public function edit($id){
        $this->authorize('modules', 'source.edit');
        $source = $this->sourceRepository->findById($id);
        $config['method'] = 'edit';
        $config['seo'] = config('apps.source.edit');

        $template = 'backend.source.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'source',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'source.delete');
        $source = $this->sourceRepository->findById($id);
        $template = 'backend.source.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'source',

        ));
    }


    public function update($id, UpdateSourceRequest $request){
        if ($this->sourceService->update($id, $request)) {
            return redirect()->route('source.index')->with('success', 'Cập nhập thành viên thành công !');
        }
        return redirect()->route('source.index')->with('error', 'Cập nhập thành viên thất bại !');
    }


    public function destroy($id){
        $this->authorize('modules', 'source.destroy');

        if ($this->sourceService->destroy($id)) {
            return redirect()->route('source.index')->with('success', 'Xóa thành viên thành công !');
        }
        return redirect()->route('source.index')->with('error', 'Xóa thành viên thất bại !');
    }
}
