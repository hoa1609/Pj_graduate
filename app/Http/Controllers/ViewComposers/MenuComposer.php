<?php
namespace App\Http\Controllers\ViewComposers;
use Illuminate\View\View;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;

class MenuComposer{

    protected $language;


    public function __construct(
        MenuCatalogueRepository $menuCatalogueRepository,
        $language,
    ){
        $this->menuCatalogueRepository = $menuCatalogueRepository;
        $this->language = $language;
    }


    public function composer(View $view){
        $agrument = $this->agrument($this->language);
        $menuCatalogue = $this->menuCatalogueRepository->findByCondition(...$agrument);
        $menus = [];
        $htmlType = ['main-menu'];  //customer lại định dạng
        if(!is_null($menuCatalogue)){
            foreach($menuCatalogue as $key => $val){
                $type = (in_array($val->keyword, $htmlType)) ? 'html' : 'array';
                $menus[$val->keyword] = frontend_recursive_menu(recursive($val->menus), 0, 2, $type); 
            }
        }
        $view->with('menu', $menus);
    }

    private function agrument($language){
        return [
            // 'condition' => [
            //         ['keyword', '=', 'main-menu']
            // config('apps.general.defaultPublish')
            // ],
            'flag' => true,
            'relation' => [
                'menus' => function($query) use ($language){
                    $query->orderBy('order', 'desc');
                    $query->with([
                        'languages' => function($query) use ($language){
                            $query->where('language_id', $language);
                        }
                    ]);
                }
            ]
        ];
    }
}