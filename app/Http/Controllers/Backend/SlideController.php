<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SlideServiceInterface as SlideService;
use App\Repositories\Interfaces\SlideRepositoryInterface as SlideRepository;

use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Slide;
class SlideController extends Controller
{

    protected $slideService;
    protected $slideRepository;

    protected $language;

    public function __construct(
        SlideService $slideService,
        SlideRepository $slideRepository,
    ){
      $this->slideService = $slideService;
      $this->slideRepository = $slideRepository;
      $this->middleware(function($request, $next){
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();
        $this->language = $language ? $language->id : 1;
        return $next($request);
    });
    }

    public function index (Request $request){
        $slides = $this->slideService->paginate($request, $this->language);
          foreach ($slides as $slide) {
            if (is_string($slide->item)) {
                $slide->items = json_decode($slide->item, true);
            } else {

                $slide->items = $slide->item;
            }
    }
        // $config = $this->config();
        $config['seo'] = config('apps.slide');
        $template = 'backend.slide.slide.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'slides',
        ));

    }

    public function create(){
        $config['seo'] = config('apps.slide');
        $config['method'] = 'create';
        $template = 'backend.slide.slide.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    public function store (StoreSlideRequest $request)
    {
        if($this->slideService->create($request, $this->language)){
            return redirect()->route('slide.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('slide.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại.');
    }

    public function edit($id)
    {
        $slide = $this->slideRepository->findById($id);
        $slideItem = $this->slideService->coverSlideArray($slide->item[$this->language]);
        $config['seo'] = config('apps.slide');
        $config['method'] = 'edit';
        $template = 'backend.slide.slide.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'slide',
            'slideItem',
        ));
    }

    public function update($id, UpdateSlideRequest $request)
    {
        if($this->slideService->update($id, $request, $this->language)){
            return redirect()->route('slide.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('slide.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại.');
    }

    public function delete($id)
    {
        $slide = $this->slideRepository->findById($id);
        $config['seo'] = config('apps.slide');
        $template = 'backend.slide.slide.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'slide',
            'config'
        ));
    }

    public function destroy($id)
    {
        if($this->slideService->destroy($id)){
            return redirect()->route('slide.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('slide.index')->with('error', 'Xóa bản ghi thất bại. Hãy thử lại');
    }
}
