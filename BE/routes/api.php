<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Brand\BrandController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Login\UsersLoginController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Comment\CommentController;
use App\Http\Controllers\Api\Register\UsersRegisterController;
use App\Http\Controllers\Api\Profile\UserProfileController;
use App\Http\Controllers\Api\Discount\DiscountController;



Route::controller(CategoryController::class)->prefix('/categories')
->as('category')
->group(function(){
    Route::get('/', 'index');
});

Route::controller(ProductController::class)->prefix('/products')
    ->as('product')
    ->group(function(){
        Route::get('/', 'index');
        Route::get('/{slug}', 'detail');

        Route::get('/category/{slug}', 'productByCate');
    });

Route::controller(BrandController::class)->prefix('/brands')
->as('brand')
->group(function(){
    Route::get('/', 'index');
});

Route::controller(OrderController::class)->prefix('/orders')
->as('order')
->group(function(){
    Route::get('/', 'index');

    Route::post('/', 'create');
});

Route::controller(CommentController::class)->prefix('/comments')
->as('comment')
->group(function(){
    Route::post('/', 'create');
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
Route::controller(UserProfileController::class)->prefix('/profiles')
->as('profile')
->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'index');
    Route::patch('/','index');

});
Route::controller(DiscountController::class)->prefix('/discounts')
    ->as('discount')
    ->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

