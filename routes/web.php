<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
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
Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'authenticate'])->name('admin.login.auth');

Route::group(['prefix' => 'admin', 'middleware' => ['admin.auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'movie'], function () {
        Route::get('/', [MovieController::class, 'index'])->name('movie.index');
        Route::get('/create', [MovieController::class, 'create'])->name('movie.create');
        Route::post('/store', [MovieController::class, 'store'])->name('movie.store');
        Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('movie.edit');
        Route::put('/update/{id}', [MovieController::class, 'update'])->name('movie.update');
        Route::delete('/delete/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');
    });
});
