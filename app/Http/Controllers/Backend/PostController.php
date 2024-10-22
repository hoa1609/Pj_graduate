<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;

class PostController extends Controller{

    protected $postService;
    protected $postRepository;
    protected $language;

    public function __construct(
        PostService $postService,
        PostRepository $postRepository,
    ) {
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => 1,
        ]);
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request){
        $config = [
            'model' => 'Post',
        ];
        $this->authorize('modules', 'post.index');

        $perPage = $request->integer('perpage');
        $posts = $this->postService->paginate($request);
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
        if ($this->postService->create($request)) {
            return redirect()->route('post.index')->with('success', 'Thêm nhóm thành viên thành công !');
        }
        return redirect()->route('post.index')->with('error', 'Thêm nhóm thành viên thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'post.edit');

        $post = $this->postRepository->getPostById($id, $this->language);
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


    public function update($id, UpdatePostRequest $request){
        if ($this->postService->update($id, $request)) {
            return redirect()->route('post.index')->with('success', 'Cập nhập nhóm thành viên thành công !');
        }
        return redirect()->route('post.index')->with('error', 'Cập nhập nhóm thành viên thất bại !');
    }

    
    public function destroy($id){
        $this->authorize('modules', 'post.destroy');
        if ($this->postService->destroy($id)) {
            return redirect()->route('post.index')->with('success', 'Xóa nhóm thành viên thành công!');
        }

        return redirect()->route('post.index')->with('error', 'Xóa nhóm thành viên thất bại!');
    }


}
