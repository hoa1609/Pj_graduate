<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserCatalogueController;
use App\Http\Controllers\Backend\PostCatalogueController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\SlideController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('login', [AuthController::class, 'login'])->name('auth.login');

/*  AMDMIN  */

Route::group(['middleware' => ['admin', 'locale']], function(){
    Route::get('dashboard/index', [DashboardController::class, 'index'])-> name('dashboard.index');

    /*  USER */
    Route::group(['prefix' => 'user'], function (){
        Route::get('index', [UserController::class, 'index'])-> name('user.index');
        Route::get('create', [UserController::class, 'create'])-> name('user.create');
        Route::post('store', [UserController::class, 'store'])-> name('user.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->where(['id' => '[0-9]+'])-> name('user.edit');
        Route::post('update/{id}', [UserController::class, 'update'])->where(['id' => '[0-9]+'])-> name('user.update');
        Route::get('delete/{id}', [UserController::class, 'delete'])->where(['id' => '[0-9]+'])-> name('user.delete');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->where(['id' => '[0-9]+'])-> name('user.destroy');
    });

    /*  USER_CATALOGUE */
    Route::group(['prefix' => 'user/catalogue'], function (){
        Route::get('index', [UserCatalogueController::class, 'index'])-> name('user.catalogue.index');
        Route::get('create', [UserCatalogueController::class, 'create'])-> name('user.catalogue.create');
        Route::post('store', [UserCatalogueController::class, 'store'])-> name('user.catalogue.store');
        Route::get('edit/{id}', [UserCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])-> name('user.catalogue.edit');
        Route::post('update/{id}', [UserCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])-> name('user.catalogue.update');
        Route::get('delete/{id}', [UserCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])-> name('user.catalogue.delete');
        Route::delete('destroy/{id}', [UserCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])-> name('user.catalogue.destroy');
    });

     /*  LANGUAGE */
     Route::group(['prefix' => 'language'], function (){
        Route::get('index', [LanguageController::class, 'index'])-> name('language.index');
        Route::get('create', [LanguageController::class, 'create'])-> name('language.create');
        Route::post('store', [LanguageController::class, 'store'])-> name('language.store');
        Route::get('edit/{id}', [LanguageController::class, 'edit'])->where(['id' => '[0-9]+'])-> name('language.edit');
        Route::post('update/{id}', [LanguageController::class, 'update'])->where(['id' => '[0-9]+'])-> name('language.update');
        Route::get('delete/{id}', [LanguageController::class, 'delete'])->where(['id' => '[0-9]+'])-> name('language.delete');
        Route::delete('destroy/{id}', [LanguageController::class, 'destroy'])->where(['id' => '[0-9]+'])-> name('language.destroy');
        Route::get('switch/{id}', [LanguageController::class, 'switchBackendLanguage'])->where(['id' => '[0-9]+'])-> name('language.switch');
    });

    /*Post_Catalogue*/
    Route::group(['prefix' => 'post/catalogue'], function (){
        Route::get('index', [PostCatalogueController::class, 'index'])-> name('post.catalogue.index');
        Route::get('create', [PostCatalogueController::class, 'create'])-> name('post.catalogue.create');
        Route::post('store', [PostCatalogueController::class, 'store'])-> name('post.catalogue.store');
        Route::get('edit/{id}', [PostCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])-> name('post.catalogue.edit');
        Route::post('update/{id}', [PostCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])-> name('post.catalogue.update');
        Route::get('delete/{id}', [PostCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])-> name('post.catalogue.delete');
        Route::delete('destroy/{id}', [PostCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])-> name('post.catalogue.destroy');
    });

     /*  SLIDE */
     Route::group(['prefix' => 'slide'], function (){
        Route::get('index', [SlideController::class, 'index'])-> name('slide.index');
        Route::get('create', [SlideController::class, 'create'])-> name('slide.create');
        Route::post('store', [SlideController::class, 'store'])-> name('slide.store');
        Route::get('edit/{id}', [SlideController::class, 'edit'])->where(['id' => '[0-9]+'])-> name('slide.edit');
        Route::post('update/{id}', [SlideController::class, 'update'])->where(['id' => '[0-9]+'])-> name('slide.update');
        Route::get('delete/{id}', [SlideController::class, 'delete'])->where(['id' => '[0-9]+'])-> name('slide.delete');
        Route::delete('destroy/{id}', [SlideController::class, 'destroy'])->where(['id' => '[0-9]+'])-> name('slide.destroy');
    });

    /* ajax */
    Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index');
    Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus');

});




require __DIR__.'/auth.php';
