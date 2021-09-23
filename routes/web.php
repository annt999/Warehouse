<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//forget-password
Route::get('/forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password.get');
Route::post('/forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['auth', 'user.active']], function () {
    Route::get('/', [HomeController::class, 'getHome'])->name('home');

    //Users
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::patch('/user/update', [UserController::class, 'update'])->name('user.update');

    //Brand
    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::patch('/brands/update', [BrandController::class, 'update'])->name('brand.update');

    //Location
    Route::get('/location', [LocationController::class, 'index'])->name('location.index');
    Route::get('/location/edit/{id}', [LocationController::class, 'edit'])->name('location.edit');
    Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
    Route::patch('/location/update', [LocationController::class, 'update'])->name('location.update');

    //Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::patch('/category/update', [CategoryController::class, 'update'])->name('category.update');
    //Auth
    Route::get('/change-password', [UserController::class, 'getChangePassword'])->name('password.change.get');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change.post');

});
