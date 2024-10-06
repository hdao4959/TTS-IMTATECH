<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PostController as ClientPostController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'homePage'])->name('home');
Route::get('/post/{slug}', [ClientPostController::class, 'detail'])->name('post.detail');
Route::get('/cate/{slug}', [HomeController::class, 'categoryPage'])->name('category.detail');
Route::get('/search', [HomeController::class, 'search'])->name("search");

Route::middleware('auth')->group(function () {
    // Route::get('/add-post', [ClientPostController::class, 'create']);
    // Route::post('/post/store', [ClientPostController::class, 'store'])->name('store');
    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.delete');
    Route::get('profile', [AuthController::class, 'showProfile'])->name('profile');
Route::post('profile', [AuthController::class, 'updateProfile'])->name('update-profile');
Route::post('profile/change-password', [AuthController::class, 'changePassword'])->name('change-password');
});




Route::get('login', [AuthController::class, 'formLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/subregister', [AuthController::class, 'subregister'])->name('subregister');

Route::middleware('role:5')
    ->prefix('admin')->as('admin.')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        // Route::group(['prefix' => 'posts'], function(){

        //     Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        //         \UniSharp\LaravelFilemanager\Lfm::routes();
        //     });
        // });
        Route::resource('categories', CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::resource('users', UserController::class);
        Route::resource('tags', TagController::class);
        Route::get('/user/{id}', [UserController::class, 'active']);

    });

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

 