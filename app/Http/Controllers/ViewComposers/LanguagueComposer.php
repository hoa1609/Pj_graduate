<?php
namespace App\Http\Controllers\ViewComposers;
use Illuminate\View\View;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

class LanguagueComposer{

    protected $language;
    protected $languageRepository;

    public function __construct(
        LanguageRepository $languageRepository,
        $language,
    ){
        $this->languageRepository = $languageRepository;
    }


    public function composer(View $view){
        $languages = $this->languageRepository->findByCondition(...$this->agrument());
        $view->with('languages', $languages);

    }


    private function agrument(){
        return [
            'condition' => [
                config('apps.general.defaultPublish')
            ],
            'flag' => true,
            'relation' => [],
            'orderBy' => ['current', 'desc']
        ];
    }

    
}