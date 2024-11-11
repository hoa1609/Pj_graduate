<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\Backend\PostCatalogueController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProductCatalogueController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeCatalogueController;
use App\Http\Controllers\Backend\PromotionController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Ajax\AttributeController as AjaxAttributeController;
use App\Http\Controllers\Ajax\ProductController as AjaxProductController;
use App\Http\Controllers\Backend\SlideController;






use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Routing\RouteGroup;











// Route::get('/', [HomeController::class, 'index'])->name('home.index');










Route::middleware(['admin', 'locale'])->group(function () {

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

    Route::group(['prefix' => 'promotion'], function () {
        Route::get('index', [PromotionController::class, 'index'])->name('promotion.index');
        Route::get('create', [PromotionController::class, 'create'])->name('promotion.create');
        Route::post('store', [PromotionController::class, 'store'])->name('promotion.store');
        Route::get('edit/{id}', [PromotionController::class, 'edit'])->name('promotion.edit');
        Route::post('update/{id}', [PromotionController::class, 'update'])->name('promotion.update');
        Route::get('delete/{id}', [PromotionController::class, 'delete'])->name('promotion.delete');
        Route::delete('destroy/{id}', [PromotionController::class, 'destroy'])->name('promotion.destroy');

    });


    /* AJAX */
    Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index');
    Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus');
    Route::post('ajax/dashboard/changeStatusAll', [AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll');
    Route::get('ajax/dashboard/findPromotionObject', [AjaxDashboardController::class, 'findPromotionObject'])->name('ajax.dashboard.findPromotionObject');
    Route::get('ajax/product/loadProductPromotion', [AjaxProductController::class, 'loadProductPromotion'])->name('ajax.loadProductPromotion');
    Route::get('ajax/attribute/getAttribute', [AjaxAttributeController::class, 'getAttribute'])->name('ajax.attribute.getAttribute');
    Route::get('ajax/attribute/loadAttribute', [AjaxAttributeController::class, 'loadAttribute'])->name('ajax.attribute.loadAttribute');

});


/*   */
Route::get('admin', [AuthController::class, 'index'])->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');



