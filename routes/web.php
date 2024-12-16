<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CustomerCatalogueController;
use App\Http\Controllers\Backend\PostCatalogueController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProductCatalogueController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeCatalogueController;
use App\Http\Controllers\Backend\PromotionController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Ajax\AttributeController as AjaxAttributeController;
use App\Http\Controllers\Ajax\ProductController as AjaxProductController;
use App\Http\Controllers\Ajax\SourceController as AjaxSourceController;
use App\Http\Controllers\Backend\SlideController;
use App\Http\Controllers\Backend\ReviewController;


use App\Http\Controllers\Backend\SourceController;
use App\Http\Controllers\Backend\WidgetController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\RouterController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\VnpayController;
use App\Http\Controllers\Ajax\CartController as AjaxCartController;
use App\Http\Controllers\Ajax\MenuController as AjaxMenuController;
use App\Http\Controllers\Ajax\ReviewController as AjaxReviewController;
use App\Http\Controllers\Ajax\OrderController as AjaxOrderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\SystemController;
use App\Http\Controllers\Frontend\MomoController;
use App\Http\Controllers\Frontend\OtherController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use Illuminate\Routing\RouteGroup;



<<<<<<< HEAD
=======


/*FE ROUTER */
>>>>>>> e5109ae2f6b1fc6625d5043377fea92d8e5c5469
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('don-hang'.config('apps.general.suffix'), [OtherController::class, 'find'])->name('find.result');
Route::get('thanh-toan'.config('apps.general.suffix'), [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('gioi-thieu'.config('apps.general.suffix'), [OtherController::class, 'intro'])->name('intro.index');
Route::get('tim-kiem-don-hang'.config('apps.general.suffix'), [OtherController::class, 'order'])->name('form.find');

Route::get('{canonical}'.config('apps.general.suffix'), [RouterController::class, 'index'])->name('router.index');
Route::get('{canonical}/trang-{page}.html', [RouterController::class, 'page'])->name('router.page');
Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('cart/{code}/success'.config('apps.general.suffix'), [CartController::class, 'success'])->name('cart.success');
Route::get('product-list', [HomeController::class, 'productlistAjax']); //danh sach khi search
Route::post('searchProduct', [HomeController::class, 'searchProduct']);
Route::get('ajax/product/quickview/{id}', [FrontendProductController::class, 'getProduct'])->name('product.get');


/*VNPAY */
Route::get('return/vnpay'.config('apps.general.suffix'), [VnpayController::class, 'vnpay_return'])->name('vnpay.vnpay_return');
Route::get('return/vnpay_ipn'.config('apps.general.suffix'), [VnpayController::class, 'vnpay_ipn'])->name('vnpay.vnpay_ipn');
Route::get('return/momo'.config('apps.general.suffix'), [MomoController::class, 'momo_return'])->name('momo.momo_return');
// Route::get('return/vnpay_ipn'.config('apps.general.suffix'), [VnpayController::class, 'vnpay_ipn'])->name('vnpay.vnpay_ipn');


/*FE AJAX */
Route::get('ajax/product/loadVariant', [AjaxProductController::class, 'loadVariant'])->name('ajax.loadVariant');
Route::post('ajax/cart/create', [AjaxCartController::class, 'create'])->name('ajax.cart.create');
Route::post('ajax/cart/update', [AjaxCartController::class, 'update'])->name('ajax.cart.update');
Route::post('ajax/cart/delete', [AjaxCartController::class, 'delete'])->name('ajax.cart.delete');
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index');
Route::post('ajax/review/create', [AjaxReviewController::class, 'create'])->name('ajax.dashboard.create');



<<<<<<< HEAD
=======
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:customer', 'verified'])->name('dashboard');

Route::middleware('auth:customer')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest:customer')->group(function () {
    Route::post('client/login', [AuthenticatedSessionController::class, 'store'])
        ->name('client.login'); 
});

Route::post('client/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:customer')
    ->name('client.logout');




    
require __DIR__.'/auth.php';








>>>>>>> e5109ae2f6b1fc6625d5043377fea92d8e5c5469
/*BACK END ROUTER */
Route::middleware(['admin', 'locale', 'backend_default_locale'])->group(function () {
    Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::group(['prefix' => 'user'], function () {
        Route::get('index', [UserController::class, 'index'])->name('user.index');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::group(['prefix' => 'user/role'], function () {
        Route::get('index', [UserRoleController::class, 'index'])->name('user.role.index');
        Route::get('create', [UserRoleController::class, 'create'])->name('user.role.create');
        Route::post('store', [UserRoleController::class, 'store'])->name('user.role.store');
        Route::get('edit/{id}', [UserRoleController::class, 'edit'])->name('user.role.edit');
        Route::post('update/{id}', [UserRoleController::class, 'update'])->name('user.role.update');
        Route::get('delete/{id}', [UserRoleController::class, 'delete'])->name('user.role.delete');
        Route::delete('destroy/{id}', [UserRoleController::class, 'destroy'])->name('user.role.destroy');
        Route::get('permission', [UserRoleController::class, 'permission'])->name('user.role.permission');
        Route::post('updatePermission', [UserRoleController::class, 'updatePermission'])->name('user.role.updatePermission');
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('index', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::get('delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
        Route::post('update/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    });

    Route::group(['prefix' => 'customer/catalogue'], function () {
        Route::get('index', [CustomerCatalogueController::class, 'index'])->name('customer.catalogue.index');
        Route::get('create', [CustomerCatalogueController::class, 'create'])->name('customer.catalogue.create');
        Route::post('store', [CustomerCatalogueController::class, 'store'])->name('customer.catalogue.store');
        Route::get('edit/{id}', [CustomerCatalogueController::class, 'edit'])->name('customer.catalogue.edit');
        Route::post('update/{id}', [CustomerCatalogueController::class, 'update'])->name('customer.catalogue.update');
        Route::get('delete/{id}', [CustomerCatalogueController::class, 'delete'])->name('customer.catalogue.delete');
        Route::delete('destroy/{id}', [CustomerCatalogueController::class, 'destroy'])->name('customer.catalogue.destroy');
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('index', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('store', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('update/{id}', [PermissionController::class, 'update'])->name('permission.update');
        Route::get('delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');
        Route::delete('destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
    });

    Route::group(['prefix' => 'post/catalogue'], function () {
        Route::get('index', [PostCatalogueController::class, 'index'])->name('post.catalogue.index');
        Route::get('create', [PostCatalogueController::class, 'create'])->name('post.catalogue.create');
        Route::post('store', [PostCatalogueController::class, 'store'])->name('post.catalogue.store');
        Route::get('edit/{id}', [PostCatalogueController::class, 'edit'])->name('post.catalogue.edit');
        Route::post('update/{id}', [PostCatalogueController::class, 'update'])->name('post.catalogue.update');
        Route::get('delete/{id}', [PostCatalogueController::class, 'delete'])->name('post.catalogue.delete');
        Route::delete('destroy/{id}', [PostCatalogueController::class, 'destroy'])->name('post.catalogue.destroy');
    });

    Route::group(['prefix' => 'post'], function () {
        Route::get('index', [PostController::class, 'index'])->name('post.index');
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('update/{id}', [PostController::class, 'update'])->name('post.update');
        Route::get('delete/{id}', [PostController::class, 'delete'])->name('post.delete');
        Route::delete('destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    });

    Route::group(['prefix' => 'product/catalogue'], function () {
        Route::get('index', [ProductCatalogueController::class, 'index'])->name('product.catalogue.index');
        Route::get('create', [ProductCatalogueController::class, 'create'])->name('product.catalogue.create');
        Route::post('store', [ProductCatalogueController::class, 'store'])->name('product.catalogue.store');
        Route::get('edit/{id}', [ProductCatalogueController::class, 'edit'])->name('product.catalogue.edit');
        Route::get('delete/{id}', [ProductCatalogueController::class, 'delete'])->name('product.catalogue.delete');
        Route::post('update/{id}', [ProductCatalogueController::class, 'update'])->name('product.catalogue.update');
        Route::delete('destroy/{id}', [ProductCatalogueController::class, 'destroy'])->name('product.catalogue.destroy');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('index', [ProductController::class, 'index'])->name('product.index');
        Route::get('create', [ProductController::class, 'create'])->name('product.create');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    Route::group(['prefix' => 'attribute'], function () {
        Route::get('index', [AttributeController::class, 'index'])->name('attribute.index');
        Route::get('create', [AttributeController::class, 'create'])->name('attribute.create');
        Route::post('store', [AttributeController::class, 'store'])->name('attribute.store');
        Route::get('edit/{id}', [AttributeController::class, 'edit'])->name('attribute.edit');
        Route::post('update/{id}', [AttributeController::class, 'update'])->name('attribute.update');
        Route::get('delete/{id}', [AttributeController::class, 'delete'])->name('attribute.delete');
        Route::delete('destroy/{id}', [AttributeController::class, 'destroy'])->name('attribute.destroy');
    });

    Route::group(['prefix' => 'attribute/catalogue'], function () {
        Route::get('index', [AttributeCatalogueController::class, 'index'])->name('attribute.catalogue.index');
        Route::get('create', [AttributeCatalogueController::class, 'create'])->name('attribute.catalogue.create');
        Route::post('store', [AttributeCatalogueController::class, 'store'])->name('attribute.catalogue.store');
        Route::get('edit/{id}', [AttributeCatalogueController::class, 'edit'])->name('attribute.catalogue.edit');
        Route::post('update/{id}', [AttributeCatalogueController::class, 'update'])->name('attribute.catalogue.update');
        Route::get('delete/{id}', [AttributeCatalogueController::class, 'delete'])->name('attribute.catalogue.delete');
        Route::delete('destroy/{id}', [AttributeCatalogueController::class, 'destroy'])->name('attribute.catalogue.destroy');
    });

    Route::group(['prefix' => 'language'], function () {
        Route::get('index', [LanguageController::class, 'index'])->name('language.index');
        Route::get('create', [LanguageController::class, 'create'])->name('language.create');
        Route::post('store', [LanguageController::class, 'store'])->name('language.store');
        Route::get('edit/{id}', [LanguageController::class, 'edit'])->name('language.edit');
        Route::post('update/{id}', [LanguageController::class, 'update'])->name('language.update');
        Route::get('delete/{id}', [LanguageController::class, 'delete'])->name('language.delete');
        Route::delete('destroy/{id}', [LanguageController::class, 'destroy'])->name('language.destroy');

        Route::get('switch/{id}', [LanguageController::class, 'swicthBackendLanguage'])->name('language.switch');
        Route::get('{id}/{languageId}/{model}/translate', [LanguageController::class, 'translate'])->name('language.translate');
        Route::post('storeTranslate', [LanguageController::class, 'storeTranslate'])->name('language.storeTranslate');
    });

    Route::group(['prefix' => 'slide'], function (){
        Route::get('index', [SlideController::class, 'index'])-> name('slide.index');
        Route::get('create', [SlideController::class, 'create'])-> name('slide.create');
        Route::post('store', [SlideController::class, 'store'])-> name('slide.store');
        Route::get('edit/{id}', [SlideController::class, 'edit'])-> name('slide.edit');
        Route::post('update/{id}', [SlideController::class, 'update'])-> name('slide.update');
        Route::get('delete/{id}', [SlideController::class, 'delete'])-> name('slide.delete');
        Route::delete('destroy/{id}', [SlideController::class, 'destroy'])-> name('slide.destroy');
    });

    Route::group(['prefix' => 'widget'], function (){
        Route::get('index', [WidgetController::class, 'index'])-> name('widget.index');
        Route::get('create', [WidgetController::class, 'create'])-> name('widget.create');
        Route::post('store', [WidgetController::class, 'store'])-> name('widget.store');
        Route::get('edit/{id}', [WidgetController::class, 'edit'])-> name('widget.edit');
        Route::post('update/{id}', [WidgetController::class, 'update'])-> name('widget.update');
        Route::get('delete/{id}', [WidgetController::class, 'delete'])-> name('widget.delete');
        Route::delete('destroy/{id}', [WidgetController::class, 'destroy'])-> name('widget.destroy');
    });

    Route::group(['prefix' => 'system'], function (){
        Route::get('index', [SystemController::class, 'index'])-> name('system.index');
        Route::post('store', [SystemController::class, 'store'])-> name('system.store');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('index', [MenuController::class, 'index'])->name('menu.index');
        Route::get('create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('store', [MenuController::class, 'store'])->name('menu.store');
        Route::get('edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
        Route::get('{id}/editMenu}', [MenuController::class, 'editMenu'])->where(['id' => '[0-9]+'])->name('menu.editMenu');
        Route::post('update/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::get('{id}/delete', [MenuController::class, 'delete'])->where(['id' => '[0-9]+'])->name('menu.delete');
        Route::delete('destroy/{id}', [MenuController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('menu.destroy');
        Route::get('{id}/children', [MenuController::class, 'children'])->where(['id' => '[0-9]+'])->name('menu.children');
        Route::post('{id}/saveChildren', [MenuController::class, 'saveChildren'])->where(['id' => '[0-9]+'])->name('menu.saveChildren');
    });
    Route::group(['prefix' => 'source'], function (){
        Route::get('index', [SourceController::class, 'index'])-> name('source.index');
        Route::get('create', [SourceController::class, 'create'])-> name('source.create');
        Route::post('store', [SourceController::class, 'store'])-> name('source.store');
        Route::get('edit/{id}', [SourceController::class, 'edit'])-> name('source.edit');
        Route::post('update/{id}', [SourceController::class, 'update'])-> name('source.update');
        Route::get('delete/{id}', [SourceController::class, 'delete'])-> name('source.delete');
        Route::delete('destroy/{id}', [SourceController::class, 'destroy'])-> name('source.destroy');
    });

    Route::group(['prefix' => 'promotion'], function () {
        Route::get('index', [PromotionController::class, 'index'])->name('promotion.index');
        Route::get('create', [PromotionController::class, 'create'])->name('promotion.create');
        Route::post('store', [PromotionController::class, 'store'])->name('promotion.store');
        Route::get('edit/{id}', [PromotionController::class, 'edit'])->name('promotion.edit');
        Route::post('update/{id}', [PromotionController::class, 'update'])->name('promotion.update');
        Route::get('delete/{id}', [PromotionController::class, 'delete'])->name('promotion.delete');
        Route::delete('destroy/{id}', [PromotionController::class, 'destroy'])->name('promotion.destroy');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('index', [OrderController::class, 'index'])->name('order.index');
        Route::get('detail/{id}', [OrderController::class, 'detail'])->name('order.detail');
    });

    Route::group(['prefix' => 'review'], function () {
        Route::get('index', [ReviewController::class, 'index'])->name('review.index');
        Route::get('delete/{id}', [ReviewController::class, 'delete'])->name('review.delete');
        Route::delete('destroy/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
    });


    /* AJAX */
    Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus');
    Route::post('ajax/dashboard/changeStatusAll', [AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll');
    Route::get('ajax/dashboard/findPromotionObject', [AjaxDashboardController::class, 'findPromotionObject'])->name('ajax.dashboard.findPromotionObject');
    Route::get('ajax/dashboard/getPromotionConditionValue', [AjaxDashboardController::class, 'getPromotionConditionValue'])->name('ajax.dashboard.getPromotionConditionValue');
    Route::get('ajax/product/loadProductPromotion', [AjaxProductController::class, 'loadProductPromotion'])->name('ajax.loadProductPromotion');
    Route::get('ajax/source/getAllSource', [AjaxSourceController::class, 'getAllSource'])->name('ajax.getAllSource');
    Route::get('ajax/dashboard/findModelObject', [AjaxDashboardController::class, 'findModelObject'])->name('ajax.dashboard.findModelObject');
    Route::get('ajax/attribute/getAttribute', [AjaxAttributeController::class, 'getAttribute'])->name('ajax.attribute.getAttribute');
    Route::get('ajax/attribute/loadAttribute', [AjaxAttributeController::class, 'loadAttribute'])->name('ajax.attribute.loadAttribute');
    Route::get('ajax/attribute/getAttribute', [AjaxAttributeController::class, 'getAttribute'])->name('ajax.attribute.getAttribute');
    Route::get('ajax/attribute/loadAttribute', [AjaxAttributeController::class, 'loadAttribute'])->name('ajax.attribute.loadAttribute');
    Route::post('ajax/menu/createCatalogue', [AjaxMenuController::class, 'createCatalogue'])->name('ajax.menu.createCatalogue');
    Route::post('ajax/menu/drag', [AjaxMenuController::class, 'drag'])->name('ajax.menu.drag');
    Route::get('ajax/dashboard/getMenu', [AjaxDashboardController::class, 'getMenu'])->name('ajax.dashboard.getMenu');
    Route::post('ajax/order/update', [AjaxOrderController::class, 'update'])->name('ajax.dashboard.update');
    Route::get('ajax/order/chart', [AjaxOrderController::class, 'chart'])->name('ajax.dashboard.chart');
});


// /*   */
Route::get('admin', [AuthController::class, 'index'])->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
