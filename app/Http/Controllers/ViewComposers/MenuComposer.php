<?php
namespace App\Http\Controllers\ViewComposers;
use Illuminate\View\View;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;

class MenuComposer{

    protected $language;


    public function __construct(
        // MenuCatalogueRepository $menuCatalogueRepository,
        $language,
    ){
        // $this->menuCatalogueRepository = $menuCatalogueRepository;
        $this->language = $language;
     }



    public function composer(View $view){

        $agrument = $this->agrument($this->language);
        $menuCatalogue = $this->menuCatalogueRepository->findByCondition(...$agrument);
        // $menus = recursive($menuCatalogue->menus); //ham bên helper

        // $view->with('menu', $menus);
    }

    private function agrument($language){
        return [
            'condition' => [
                    ['keyword', '=', 'main_menu']
                ],
            'flag' => false,
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