<?php
use App\Http\Controllers\Fondend\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/all-product',[ProductController::class, 'allProduct'])->name('all-product');
Route::get('/category-product/{cat_id}',[ProductController::class, 'categoryProduct'])->name('category-product');

