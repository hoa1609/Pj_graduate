<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class PostController extends Controller{

    protected $postService;
    protected $postRepository;
    protected $language;

    public function __construct(
        PostService $postService,
        PostRepository $postRepository,
    ){
        $this->middleware(function($request, $next){
            $locale = app()->getLocale(); // vn en
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            $this->initialize();
            return $next($request);
        });

        $this->postService = $postService;
        $this->postRepository = $postRepository;   
        $this->initialize();  
    }


    public function index(Request $request){$this->authorize('modules', 'post.index');

        $config = $this->configIndex();
        $perPage = $request->integer('perpage');
        $posts = $this->postService->paginate($request, $this->language);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.post.post.index';
        $config['seo'] = config('apps.post.index');
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'posts',
        ));
    }


    public function create(){
        $this->authorize('modules', 'post.create');

        $config = $this->configStore();
        $config['method'] = 'create';
        $config['seo'] = config('apps.post.create');
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.post.post.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
        ));
    }


    public function store(PostRequest $request){
        if ($this->postService->create($request, $this->language)) {
            return redirect()->route('post.index')->with('success', 'Thêm bản ghi thành công !');
        }
        return redirect()->route('post.index')->with('error', 'Thêm bản ghi thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'post.edit');
        $post = $this->postRepository->getPostById($id, $this->language);

        $config = $this->configStore();
        $config['method'] = 'edit';
        $config['seo'] = config('apps.post.edit');
        $album = json_decode($post->album);
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.post.post.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'dropdown',
            'post',
            'album',
        ));
    }


    public function delete($id){
        $this->authorize('modules', 'post.delete');
        $post = $this->postRepository->getPostById($id, $this->language);
        $template = 'backend.post.post.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'post',
        ));
    }


    public function update($id, UpdatePostRequest $request){
        if ($this->postService->update($id, $request, $this->language)) {
            return redirect()->route('post.index')->with('success', 'Cập nhập bản ghi thành công !');
        }
        return redirect()->route('post.index')->with('error', 'Cập nhập bản ghi thất bại !');
    }

    
    public function destroy($id){
        $this->authorize('modules', 'post.destroy');
        if ($this->postService->destroy($id, $this->language)) {
            return redirect()->route('post.index')->with('success', 'Xóa bản ghi thành công!');
        }

        return redirect()->route('post.index')->with('error', 'Xóa bản ghi thất bại!');
    }

    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 


    private function configIndex(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
            'model' => 'Post'
        ];
    }

    private function configStore(){
        return [
            'js' => [
                'backend/assets/js/select2_4.1.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/assets/library/seo.js',
                'backend/assets/library/finder.js',
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/plugins/nice-select/js/jquery.nice-select.min.js',
                'backend/plugins/jquery-ui.js',
                'backend/assets/library/renameCanonical.js',
                'backend/assets/library/set-up-ui.js',
            ],
            'css' => [
                'backend/assets/css/select2.min.css',
            ],
        ];
    }

}
