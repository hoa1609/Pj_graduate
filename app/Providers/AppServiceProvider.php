<?php

namespace App\Providers;

use Dotenv\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\ViewComposers\SystemComposer;
use App\Http\Controllers\ViewComposers\MenuComposer;
use App\Models\Language;
use Carbon\Carbon;
use DateTime;

class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',

        'App\Services\Interfaces\UserRoleServiceInterface' => 'App\Services\UserRoleService',
        'App\Repositories\Interfaces\UserRoleRepositoryInterface' => 'App\Repositories\UserRoleRepository',

        /* Language */
        'App\Services\Interfaces\LanguageServiceInterface' => 'App\Services\LanguageService',
        'App\Repositories\Interfaces\LanguageRepositoryInterface' => 'App\Repositories\LanguageRepository',

        /* post */
        'App\Services\Interfaces\PostServiceInterface' => 'App\Services\PostService',
        'App\Repositories\Interfaces\PostRepositoryInterface' => 'App\Repositories\PostRepository',

        /* product */
        'App\Services\Interfaces\ProductServiceInterface' => 'App\Services\ProductService',
        'App\Repositories\Interfaces\ProductRepositoryInterface' => 'App\Repositories\ProductRepository',

        /* product catalogue */
        'App\Services\Interfaces\ProductCatalogueServiceInterface' => 'App\Services\ProductCatalogueService',
        'App\Repositories\Interfaces\ProductCatalogueRepositoryInterface' => 'App\Repositories\ProductCatalogueRepository',

        /* attribute catalogue */
        'App\Services\Interfaces\AttributeCatalogueServiceInterface' => 'App\Services\AttributeCatalogueService',
        'App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface' => 'App\Repositories\AttributeCatalogueRepository',

        /* attribute */
        'App\Services\Interfaces\AttributeServiceInterface' => 'App\Services\AttributeService',
        'App\Repositories\Interfaces\AttributeRepositoryInterface' => 'App\Repositories\AttributeRepository',

        /* permission */
        'App\Services\Interfaces\PermissionServiceInterface' => 'App\Services\PermissionService',
        'App\Repositories\Interfaces\PermissionRepositoryInterface' => 'App\Repositories\PermissionRepository',

        /* post category */
        'App\Services\Interfaces\PostCatalogueServiceInterface' => 'App\Services\PostCatalogueService',
        'App\Repositories\Interfaces\PostCatalogueRepositoryInterface' => 'App\Repositories\PostCatalogueRepository',

        /* product variant languege */
        'App\Services\Interfaces\ProductVariantLanguageServiceInterface' => 'App\Services\ProductVariantLanguageService',
        'App\Repositories\Interfaces\ProductVariantLanguageRepositoryInterface' => 'App\Repositories\ProductVariantLanguageRepository',

        /* product variant */
        'App\Services\Interfaces\ProductVariantServiceInterface' => 'App\Services\ProductVariantService',
        'App\Repositories\Interfaces\ProductVariantRepositoryInterface' => 'App\Repositories\ProductVariantRepository',

        /* slide */
        'App\Services\Interfaces\SlideServiceInterface' => 'App\Services\SlideService',
        'App\Repositories\Interfaces\SlideRepositoryInterface' =>'App\Repositories\SlideRepository',

        /* ProductVariantAttribute */
        'App\Services\Interfaces\ProductVariantAttributeServiceInterface' => 'App\Services\ProductVariantAttributeService',
        'App\Repositories\Interfaces\ProductVariantAttributeRepositoryInterface' =>'App\Repositories\ProductVariantAttributeRepository',

        /* router */
        'App\Services\Interfaces\RouterServiceInterface' => 'App\Services\RouterService',
        'App\Repositories\Interfaces\RouterRepositoryInterface' => 'App\Repositories\RouterRepository',

        /* provine & ditrict*/
        'App\Repositories\Interfaces\ProvinceRepositoryInterface' => 'App\Repositories\ProvinceRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface' => 'App\Repositories\DistrictRepository',

        /* menu */
        'App\Services\Interfaces\MenuServiceInterface' => 'App\Services\MenuService',
        'App\Repositories\Interfaces\MenuRepositoryInterface' => 'App\Repositories\MenuRepository',

        /* system */
        'App\Services\Interfaces\SystemServiceInterface' => 'App\Services\SystemService',
        'App\Repositories\Interfaces\SystemRepositoryInterface' => 'App\Repositories\SystemRepository',

        /* menu catalogue*/
        'App\Services\Interfaces\MenuCatalogueServiceInterface' => 'App\Services\MenuCatalogueService',
        'App\Repositories\Interfaces\MenuCatalogueRepositoryInterface' => 'App\Repositories\MenuCatalogueRepository',
        /* Promotion */
       'App\Services\Interfaces\PromotionServiceInterface' => 'App\Services\PromotionService',
        'App\Repositories\Interfaces\PromotionRepositoryInterface' =>'App\Repositories\PromotionRepository',

        /* Promotion-Source */
       'App\Services\Interfaces\SourceServiceInterface' => 'App\Services\SourceService',
       'App\Repositories\Interfaces\SourceRepositoryInterface' =>'App\Repositories\SourceRepository',

        /* Customer */
        'App\Services\Interfaces\CustomerServiceInterface' => 'App\Services\CustomerService',
        'App\Repositories\Interfaces\CustomerRepositoryInterface' => 'App\Repositories\CustomerRepository',

        /* Customer_catalogue */
        'App\Services\Interfaces\CustomerCatalogueServiceInterface' => 'App\Services\CustomerCatalogueService',
        'App\Repositories\Interfaces\CustomerCatalogueRepositoryInterface' => 'App\Repositories\CustomerCatalogueRepository',

        // widget
        'App\Services\Interfaces\WidgetServiceInterface' => 'App\Services\WidgetService',
        'App\Repositories\Interfaces\WidgetRepositoryInterface' =>'App\Repositories\WidgetRepository',
    ];

    public function register(): void
    {
       foreach ($this->bindings as $key => $val) {
        $this-> app ->bind($key, $val);
       }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();

        view()->composer('frontend.homepage.layout', function($view) use ($language){

            $composerClass = [
                SystemComposer::class,
                // MenuComposer::class,
            ];
            foreach($composerClass as $key => $val){
                $composer = app()->make($val, ['language' => $language->id]);
                $composer->composer($view);
            }   
        });


        // Validator::extend('custom_date_format', function($attribute, $value, $parameters, $validator){
        //     return DateTime::createFromFormat('d/m/Y H:i', $value) !== false;
        // });

        // Validator::extend('custom_after', function($attribute, $value, $parameters, $validator){
        //     $starDate = Carbon::createFromFormat('d/m/Y H:i',$validator->getData()[$parameters[0]]) ;
        //     $endDate = Carbon::createFromFormat('d/m/Y H:i', $value);

        //     return $endDate->greaterThan($starDate) !== false;
        // });

        Schema::defaultStringLength(191);
    }
}
