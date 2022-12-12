<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Fondend\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('backend.dashboard.index');
        })->name('dashboard');

        Route::controller(CategoryController::class)->group(function(){
            Route::get('/category/create','create')->name('category-create');
            Route::post('/category/store', 'store')->name('category-store');
            Route::get('/categories','index')->name('category-manage');
            Route::get('/category/delete/{cat_id}',  'delete')->name('category-delete');
            Route::get('/category/edit/{cat_id}',  'edit')->name('category-edit');
            Route::post('/category/update/{cat_id}',  'update')->name('category-update');
            
        });
        Route::controller(BrandController::class)->group(function(){
            Route::get('/brand/create','create')->name('brand-create');
            Route::post('/brand/store', 'store')->name('brand-store');
            Route::get('/brands','index')->name('brand-manage');
            Route::get('/brand/delete/{brand_id}',  'delete')->name('brand-delete');
            Route::get('/brand/edit/{brand_id}/{cat_id}',  'edit')->name('brand-edit');
            Route::post('/brand/update/{brand_id}',  'update')->name('brand-update');
        });
        Route::controller(ProductController::class)->group(function() {
            Route::get('/product/create','create')->name('product-create');
            Route::post('/product/store','store')->name('product-store');
            Route::get('/product','index')->name('product-manage');
            Route::get('/product/delete/{product_id}','delete')->name('product-delete');
            Route::get('/product/status/{product_id}','status')->name('product-status');
            Route::get('/brand/edit/{cat_id}/{brand_id}/{product_id}', 'edit')->name('product-edit');
        });
});
