<?php

use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\Auth\RegisterController::class)
    ->prefix('admin/register')->as('register.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });
Route::controller(App\Http\Controllers\Auth\LoginController::class)
    ->prefix('admin/login')->as('admin.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'login')->name('login');
        Route::get('/logout', 'logout')->name('logout');
});


Route::middleware(['auth', 'auth.admin'])->prefix('/admin')->as('admin.')
    ->group(function () {
        Route::prefix('/dashboard')->as('dashboard.')->group(function () {
            Route::controller(App\Http\Controllers\Dashboard\DashboardController::class)->group(function () {
                Route::get('/them', 'create')->name('create');
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
                Route::put('/sua', 'update')->name('update');
                Route::post('/them', 'store')->name('store');
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });

        Route::prefix('/categories')->as('category.')->group(function () {
            Route::controller(App\Http\Controllers\Category\CategoryController::class)->group(function () {
                Route::get('/them', 'create')->name('create');
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
                Route::put('/sua', 'update')->name('update');
                Route::post('/them', 'store')->name('store');
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
});
