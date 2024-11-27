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
use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\Payment\PaymentController;
use App\Http\Controllers\Api\Slider\SliderController;
use App\Http\Controllers\Api\FlashSale\FlashSaleController;
use App\Http\Controllers\Api\Search\SearchController;

Route::controller(CategoryController::class)->prefix('/categories')
->as('category')
->group(function(){
    Route::get('/', 'index');
});

Route::controller(ProductController::class)->prefix('/products')
    ->as('product')
    ->group(function(){
        Route::get('/', 'index');
        Route::get('/hotdeal', 'hotdeal');
        Route::get('/{slug}', 'detail');

        Route::get('/category/{slug}', 'productByCate');
    });

Route::controller(BrandController::class)->prefix('/brands')
->as('brand')
->group(function(){
    Route::get('/', 'index');
});

Route::controller(SearchController::class)->prefix('/searchs')
->as('search')
->group(function(){
    Route::get('/', 'searchByProductOrVariant');
});

Route::controller(OrderController::class)->prefix('/orders')
->as('order')
->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'create');
    Route::get('/detail/{id}', 'detail')->name('detail');
    Route::get('/detail-by-phone', 'detailByPhone')->name('detailByPhone');
});



Route::controller(CommentController::class)->prefix('/comments')
->as('comment')
->group(function(){
    Route::post('/', 'create');
    Route::get('/{product_variant_id}', 'index');

});

Route::controller(FlashSaleController::class)->prefix('/flash-sales')
->as('flashSale')
->group(function(){
    Route::get('/{active}', 'flashSaleActive');

});


Route::controller(UsersLoginController::class)->prefix('/logins')
->as('login')
->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'index');
    Route::post('/request-otp', 'requestOtp')->name('requestOtp');
    Route::post('/verify-otp', 'verifyOtpAndResetPassword')->name('verifyOtp');

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
    Route::post('/logout', 'logout');
    Route::post('/change-password', 'changePassword')->name('changePassword');


});
Route::controller(DiscountController::class)->prefix('/discounts')
    ->as('discount')
    ->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
        Route::post('/update', 'updateDiscount');
    });

Route::controller(PaymentController::class)->prefix('/payments')
->as('payment.')
->group(function(){
    Route::post('/', 'createPayment');
    Route::get('/callback', 'callback')->name('callback');
});

Route::controller(SliderController::class)->prefix('/sliders')
->as('slider.')
->group(function(){
    Route::get('/', 'index');
});

Route::controller(PostController::class)->prefix('/posts')
    ->as('post')
    ->group(function () {
        Route::get('/', 'index');  
        Route::get('/is_featured', 'postFeatured');
        Route::get('/category', 'category');
        Route::get('/{slug}', 'detail');  
        Route::get('/category/{slug}', 'postsByCategory');  
    });

Route::get('/firebase-config', function () {
    return response()->json([
        'apiKey' => config('firebase.server_key'),
        'authDomain' => config('firebase.auth_domain'),
        'projectId' => config('firebase.project_id'),
        'storageBucket' => config('firebase.storage_bucket'),
        'messagingSenderId' => config('firebase.sender_id'),
        'appId' => config('firebase.app_id'),
    ]);
});