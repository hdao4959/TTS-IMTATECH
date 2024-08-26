<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
<<<<<<< HEAD
use App\Http\Controllers\Admin\UserController;
=======
>>>>>>> d8f7330d8926e641b314c1c19d565f5b23f24d87
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->as('admin.')->group(function() {
    Route::get('/', function() {
        return view('admin.dashboard');
    })->name('dashboard');

<<<<<<< HEAD
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class);
    Route::get('/user/{id}', [UserController::class, 'active']);

});
=======
    Route::resource('posts', PostController::class);

    Route::resource('categories', CategoryController::class);

});

>>>>>>> d8f7330d8926e641b314c1c19d565f5b23f24d87
