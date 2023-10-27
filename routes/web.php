<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function (){
    Route::get('/', 'IndexController')->name('admin.index');
    Route::group(['namespace' => 'Product', 'prefix' => 'orders'], function (){
        Route::get('/', 'IndexController')->name('admin.order.index');
    });

    Route::group(['namespace' => 'Order', 'prefix' => 'orders'], function (){
        Route::get('/', 'IndexController')->name('admin.order.index');
        Route::get('/create', 'CreateController')->name('admin.order.create');
        Route::post('/', 'StoreController')->name('admin.order.store');
        Route::get('/{order}', 'ShowController')->name('admin.order.show');
        Route::get('/{order}/edit', 'EditController')->name('admin.order.edit');
        Route::patch('/{order}', 'UpdateController')->name('admin.order.update');
        Route::delete('/{order}', 'DeleteController')->name('admin.order.delete');
    });

    Route::group(['namespace' => 'Product', 'prefix' => 'products'], function (){
        Route::get('/', 'IndexController')->name('admin.product.index');
        Route::get('/create', 'CreateController')->name('admin.product.create');
        Route::post('/', 'StoreController')->name('admin.product.store');
        Route::get('/{product}', 'ShowController')->name('admin.product.show');
        Route::get('/{product}/edit', 'EditController')->name('admin.product.edit');
        Route::patch('/{product}', 'UpdateController')->name('admin.product.update');
        Route::delete('/{product}', 'DeleteController')->name('admin.product.delete');
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function (){
        Route::get('/', 'IndexController')->name('admin.category.index');
        Route::get('/create', 'CreateController')->name('admin.category.create');
        Route::post('/', 'StoreController')->name('admin.category.store');
        Route::get('/{category}', 'ShowController')->name('admin.category.show');
        Route::get('/{category}/edit', 'EditController')->name('admin.category.edit');
        Route::patch('/{category}', 'UpdateController')->name('admin.category.update');
        Route::delete('/{category}', 'DeleteController')->name('admin.category.delete');
    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function (){
        Route::get('/', 'IndexController')->name('admin.tag.index');
        Route::get('/create', 'CreateController')->name('admin.tag.create');
        Route::post('/', 'StoreController')->name('admin.tag.store');
        Route::get('/{tag}', 'ShowController')->name('admin.tag.show');
        Route::get('/{tag}/edit', 'EditController')->name('admin.tag.edit');
        Route::patch('/{tag}', 'UpdateController')->name('admin.tag.update');
        Route::delete('/{tag}', 'DeleteController')->name('admin.tag.delete');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function (){
        Route::get('/', 'IndexController')->name('admin.user.index');
        Route::get('/create', 'CreateController')->name('admin.user.create');
        Route::post('/', 'StoreController')->name('admin.user.store');
        Route::get('/{user}', 'ShowController')->name('admin.user.show');
        Route::get('/{user}/edit', 'EditController')->name('admin.user.edit');
        Route::patch('/{user}', 'UpdateController')->name('admin.user.update');
        Route::delete('/{user}', 'DeleteController')->name('admin.user.delete');
    });

});

Route::get('/', \App\Http\Controllers\HomeController::class)->name('main.index');

Auth::routes();
