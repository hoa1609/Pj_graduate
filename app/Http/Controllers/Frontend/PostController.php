<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Services\Interfaces\PostServiceInterface as PostService;
use Illuminate\Http\Request;


class PostController extends FrontendController{

    protected $language;
    protected $system;
    protected $postCatalogueRepository;
    protected $postRepository;
    protected $postService;


    public function __construct(
        PostCatalogueRepository $postCatalogueRepository,
        PostRepository $postRepository,
        PostService $postService,
    ){
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->postRepository = $postRepository;
        $this->postService = $postService;
        parent::__construct();
     }


     public function index($id, $request){
        $language = $this->language;
        $post =$this->postRepository->getPostById($id, $this->language);
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($post->post_catalogue_id, $this->language);
        $breadcrumb = $this->postCatalogueRepository->breadcrumb($postCatalogue, $this->language);
        /*---------------*/
        $category = recursive($this->postCatalogueRepository->all(['languages']));

        $config = $this->config();
        $system = $this->system;
        $seo = seo($post);

        return view('frontend.post.post.index', compact(
            'config',
            'system',
            'seo',
            'postCatalogue',
            'breadcrumb',
            'post',
            'category',
            'language',
        ));
     }



    private function config(){
        return [
            'language' => $this->language,
            'js' => [
                'frontend/assets/library/post.js',
                'frontend/assets/library/cart.js',
            ]
        ];
    }


}
