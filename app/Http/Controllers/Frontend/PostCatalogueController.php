<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Services\Interfaces\PostServiceInterface as PostService;

class PostCatalogueController extends FrontendController{

    protected $language;
    protected $system;
    protected $postCatalogueRepository;
    protected $postService;


    public function __construct(
        PostCatalogueRepository $postCatalogueRepository,
        PostService $postService,
    ){
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->postService = $postService;
        parent::__construct();
    }


    public function index($id, $request, $page = 1){
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($id, $this->language);
        $breadcrumb = $this->postCatalogueRepository->breadcrumb($postCatalogue, $this->language);
    
        $posts = $this->postService->paginate(
            $request,
            $this->language,
            $postCatalogue,
            ['path' => $postCatalogue->canonical],
            $page
        );

        $config = $this->config();
        $system = $this->system;
        $seo = seo($postCatalogue, $page);
        return view('frontend.post.catalogue.index', compact(
            'config',
            'system',
            'seo',
            'postCatalogue',
            'breadcrumb',
            'posts'
        ));
    }


    private function config(){
        return [
            'language' => $this->language,
        ];
    }

}
