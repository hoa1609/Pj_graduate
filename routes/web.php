<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use Illuminate\Routing\RouteGroup;

/*  AMDMIN  */

Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('admin');


/*  USER */
Route::group(['prefix' => 'user'], function () {
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('admin');
    Route::get('create', [UserController::class, 'create'])->name('user.create')->middleware('admin');

    Route::post('store', [UserController::class, 'store'])->name('user.store')->middleware('admin');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('admin');
    Route::post('update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('admin');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('admin');
    Route::post('/user/change-status', [UserController::class, 'changeStatus'])->name('user.changeStatus');

});

Route::group(['prefix' => 'user/role'], function () {
    Route::get('index', [UserRoleController::class, 'index'])->name('user.role.index')->middleware('admin');
    Route::get('create', [UserRoleController::class, 'create'])->name('user.role.create')->middleware('admin');

    Route::post('store', [UserRoleController::class, 'store'])->name('user.role.store')->middleware('admin');
    Route::get('edit/{id}', [UserRoleController::class, 'edit'])->name('user.role.edit')->middleware('admin');
    Route::post('update/{id}', [UserRoleController::class, 'update'])->name('user.role.update')->middleware('admin');
    Route::delete('destroy/{id}', [UserRoleController::class, 'destroy'])->name('user.role.destroy')->middleware('admin');
    Route::post('/user/change-status', [UserRoleController::class, 'changeStatus'])->name('user.role.changeStatus');

});


/*  AJAX */
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index')->middleware('admin');
Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus')->middleware('admin');
Route::post('ajax/dashboard/changeStatusAll', [AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll')->middleware('admin');





Route::get('admin', [AuthController::class, 'index'])->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
