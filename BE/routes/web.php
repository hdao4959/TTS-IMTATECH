<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
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
})->name('home');

Route::get('login', [AuthController::class, 'formLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout',[AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/subregister', [AuthController::class, 'subregister'])->name('subregister');





Route::middleware('role:5')
    ->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class);
    Route::get('/user/{id}', [UserController::class, 'active']);
});
