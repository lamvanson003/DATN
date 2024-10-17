<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Brand\BrandController;
use App\Http\Controllers\Api\Product\ProductController;

Route::controller(CategoryController::class)->prefix('/categories')
->as('category')
->group(function(){
    Route::get('/', 'index');
});

Route::controller(BrandController::class)->prefix('/brands')
->as('brand')
->group(function(){
    Route::get('/', 'index');
});

Route::controller(ProductController::class)->prefix('/products')
->as('product')
->group(function(){
    Route::get('/', 'index');

    Route::get('/{id}', 'detail');
});
