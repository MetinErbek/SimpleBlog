<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login',  [UserAuthController::class, 'login']);
Route::middleware(['auth:api'])->group(function () {

    Route::middleware(['checkRole:admin'])->group(function () {
            

        Route::get('/poststatuschange/{post_id}/{new_status}', [PostsController::class, 'postStatusChange']);
        Route::post('/bulkremovepost', [PostsController::class, 'bulkRemovePost']);
        Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');
    });

    Route::middleware(['checkRole:admin,writer'])->group(function () {
        
        Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
        Route::put('/posts/{id}', [PostsController::class, 'update'])->name('posts.update');
        
    });
});
Route::fallback(function () {

    return jsonResponse(FALSE, 'Route not found !', NULL, 404);

});