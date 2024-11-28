<?php
namespace App\Http\Controllers\ViewComposers;
use Illuminate\View\View;
use App\Repositories\Interfaces\SystemRepositoryInterface as SystemRepository;

class SystemComposer
{
    protected $language;


    public function __construct(
        SystemRepository $systemRepository,
        $language,
    ){
        $this->systemRepository = $systemRepository;
        $this->language = $language;
     }



    public function composer(View $view){
        $system = $this->systemRepository->findByCondition(
            [
                ['language_id', '=', $this->language]
            ],
            TRUE
        );
        $systeArray = convert_array($system, 'keyword', 'content');
        $view->with('system', $systeArray);
        // dd($system['homepage_logo']);
    }
}