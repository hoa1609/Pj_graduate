<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;
use App\Classes\Nestedsetbie;
class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;
    protected $nestedset;
    protected $language;

    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository,
    ){
      $this->postCatalogueService = $postCatalogueService;
      $this->postCatalogueRepository = $postCatalogueRepository;
      $this->nestedset = new Nestedsetbie([
        'table' => 'post_catalogues',
        'foreignkey' => 'post_catalogue_id',
        'language_id' => 1,
    ]);
    $this->language = $this->currentLanguage();
    }

    public function index (Request $request){

        $postCatalogues = $this->postCatalogueService->paginate($request, $this->language);

        // $config = $this->config();
        $config['seo'] = config('apps.postCatalogue');
        $template = 'backend.post.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'postCatalogues',
        ));

    }

    public function create()
    {

        $config['seo'] = config('apps.postCatalogue');
        $config['method'] = 'create';
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'dropdown',
            'config',
        ));
    }

    public function store (StorePostCatalogueRequest $request)
    {
        if($this->postCatalogueService->create($request)){
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại.');
    }

    public function edit($id)
    {
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($id, $this->language);
        $config['seo'] = config('apps.postCatalogue');
        $config['method'] = 'edit';
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'dropdown',
            'postCatalogue',
        ));
    }

    public function update($id, UpdatePostCatalogueRequest $request)
    {
        if($this->postCatalogueService->update($id, $request)){
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại.');
    }

    public function delete($id)
    {
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        $config['seo'] = config('apps.postCatalogue');
        $template = 'backend.post.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'post.catalogue',
            'config'
        ));
    }

    public function destroy($id)
    {
        if($this->postCatalogueService->destroy($id)){
            return redirect()->route('post.catalogue.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Xóa bản ghi thất bại. Hãy thử lại');
    }


    public function switchBackendPostCatalogue($id)
    {
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        if ($this->postCatalogueService->switch($id)) {
            session(['app_locale' => $postCatalogue->canonical]);
            \App::setLocale($postCatalogue->canonical);
        }
       return back();
    }
}
