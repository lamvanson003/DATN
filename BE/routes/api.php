<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Brand\BrandController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Login\UsersLoginController;
use App\Http\Controllers\Api\Register\UsersRegisterController;



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

Route::controller(ProductController::class)->prefix('/products')
->as('product')
->group(function(){
    Route::get('/', 'index');

    Route::get('/{id}', 'detail');
});



Route::controller(UsersLoginController::class)->prefix('/logins')
->as('login')
->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'index');

});

Route::controller(UsersRegisterController::class)->prefix('/registers')
->as('register')
->group(function(){
    Route::post('/', 'store');
});

