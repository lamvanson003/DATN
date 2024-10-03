<?php

use Illuminate\Support\Facades\Route;

// Route cho người dùng chưa đăng nhập
Route::middleware('guest')->prefix('/admin')->as('admin.')
    ->controller(App\Http\Controllers\Auth\AuthController::class)
    ->group(function () {
        Route::get('/login', 'index')->name('login.index');
        Route::post('/login', 'login')->name('login.post');
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
    });
