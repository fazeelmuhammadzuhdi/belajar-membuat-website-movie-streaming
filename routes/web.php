<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::group(['prefix' => 'movie'], function () {
        Route::get('/create', [MovieController::class, 'create'])->name('movie.create');
        Route::post('/store', [MovieController::class, 'store'])->name('movie.store');
    });
});
