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
Route::get('/post/{safe_url}', [SiteController::class, 'post']);

Auth::routes();

Route::get('/home', [SiteController::class, 'index'])->name('home');
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/', [PostsController::class, 'index']);
    Route::get('/index', [PostsController::class, 'index']);
    Route::get('/posts', [PostsController::class, 'index']);

    

    Route::middleware(['checkRole:admin'])->group(function () {
        
        Route::post('/users', [UsersController::class, 'destroy'])->name('users.destroy');
        Route::get('/users', [UsersController::class, 'index']);
        Route::get('/poststatuschange/{post_id}/{new_status}', [PostsController::class, 'postStatusChange']);
        Route::post('/bulkremovepost', [PostsController::class, 'bulkRemovePost']);
        Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');
    });

    Route::middleware(['checkRole:admin,writer'])->group(function () {
        
        Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
        Route::get('/posts/{id}/edit', [PostsController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{id}', [PostsController::class, 'update'])->name('posts.update');
        
    });


});
Route::get('/logout', function(){
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
});