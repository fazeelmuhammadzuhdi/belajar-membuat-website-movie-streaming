<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NotificationController;


Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/logout', [LoginController::class, 'logout'])->name('admin.login.logout');


Route::group(['prefix' => 'movie'], function () {
    Route::get('/', [MovieController::class, 'index'])->name('movie.index');
    Route::get('/create', [MovieController::class, 'create'])->name('movie.create');
    Route::post('/store', [MovieController::class, 'store'])->name('movie.store');
    Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('movie.edit');
    Route::put('/update/{id}', [MovieController::class, 'update'])->name('movie.update');
    Route::delete('/delete/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');
});

Route::get('/transaction', [TransactionController::class, 'index'])->name('admin.transaction');



// Route::get('/notification', [NotificationController::class, 'index'])->name('admin.notification');
// Route::post('/notification', [NotificationController::class, 'store'])->name('admin.notification.store');
