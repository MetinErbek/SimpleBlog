<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SiteController::class, 'index']);

Auth::routes();

Route::get('/home', [SiteController::class, 'index'])->name('home');
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [PostsController::class, 'index']);
    Route::get('/index', [PostsController::class, 'index']);
    Route::get('/users', [UsersController::class, 'index']);
    Route::resource('posts', PostsController::class);
    /*
    Route::get('/posts', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::delete('/posts', [PostsController::class, 'destroy'])->name('posts.destroy');
    */
    Route::post('/users', [UsersController::class, 'destroy'])->name('users.destroy');
});