<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;



class RouterController extends FrontendController{

    protected $language;
    protected $routerRepository;
 
    public function __construct(
        RouterRepository $routerRepository
    ){
        $this->routerRepository = $routerRepository;
        parent::__construct();
     }
  


     public function index(string $canonical = ''){
        $router = $this->routerRepository->findByCondition(
            [
                ['canonical', '=', $canonical],
                ['language_id', '=', $this->language]
            ]
        );

        if(!is_null($router) && !empty($router)){
            $method = 'index';
            echo app($router->controllers)->{$method}($router->module_id, $this->language);
        }
    }


}
