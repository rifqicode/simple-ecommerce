<?php

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

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('dashboard');
Route::get('/get-product/{category}', [App\Http\Controllers\MainController::class, 'getProduct'])->name('list-product');


Route::prefix('xadmin')->middleware('auth', 'rolecheck')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('category', App\Http\Controllers\CategoryController::class);
    Route::resource('item', App\Http\Controllers\ItemController::class);
});

require __DIR__ . '/auth.php';
