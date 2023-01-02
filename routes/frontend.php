<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/all-product',[ProductController::class, 'allProduct'])->name('all-product');
Route::get('/category-product/{cat_id}',[ProductController::class, 'categoryProduct'])->name('category-product');

