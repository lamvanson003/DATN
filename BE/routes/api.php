<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Category\CategoryController;

Route::controller(CategoryController::class)->prefix('/categories')
->as('category')
->group(function(){
    Route::get('/', 'index');
});