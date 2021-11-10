<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
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
//Route::get('/home', function (){
//   return view('layouts.home');
//})->name('home');

Route::get('/', [HomeController::class, 'getHomeGuest'])->name('home.guest');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


//forget-password
Route::get('/forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password.get');
Route::post('/forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

//register
Route::get('/register', [WarehouseController::class, 'create'])->name('warehouse.create');
Route::post('/warehouse/store', [WarehouseController::class, 'store'])->name('warehouse.store');


Route::group(['middleware' => ['auth', 'user.active', 'warehouse.active']], function () {
    Route::get('/home', [HomeController::class, 'getHome'])->name('home');

    Route::group(['middleware' => ['role:' . config('common.role.admin')]], function () {
        Route::get('/warehouses', [WarehouseController::class, 'index'])->name('warehouse.index');
        Route::get('/warehouses/change-status/{id}', [WarehouseController::class, 'changeStatus'])->name('warehouse.change-status');
    });

    //Users
    Route::group(['middleware' => ['user.storekeeper']], function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
        Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    });

    //Warehouses

    //Brand
    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::post('/brands/update', [BrandController::class, 'update'])->name('brand.update');

    //Location
    Route::get('/location', [LocationController::class, 'index'])->name('location.index');
    Route::get('/location/edit/{id}', [LocationController::class, 'edit'])->name('location.edit');
    Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
    Route::post('/location/update', [LocationController::class, 'update'])->name('location.update');

    //Supplier
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/list', [SupplierController::class, 'getList'])->name('supplier.list');
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::post('/supplier/update', [SupplierController::class, 'update'])->name('supplier.update');
    Route::post('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');

    //Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/search', [CustomerController::class, 'search'])->name('customer.search');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customer/transaction', [CustomerController::class, 'transactions'])->name('customer.transaction');
    Route::get('/customer/transaction-detail/{id}', [CustomerController::class, 'getTransactionsOfCustomer'])->name('customer.transaction.detail');


    //Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');

    //Product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');
    Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.get');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/export-product', [ProductController::class, 'export'])->name('product.export');

    //Orders
    Route::get('/order/import', [OrderController::class, 'getImportHistory'])->name('order.import.history');
    Route::get('/order/import/create', [OrderController::class, 'getCreateImportPage'])->name('order.import.create');
    Route::post('/order/import-product', [OrderController::class, 'import'])->name('order.import');
    Route::get('/order/import/detail/{id}', [OrderController::class, 'detail'])->name('order.import.detail');
    Route::get('/order/sale', [OrderController::class, 'getSaleHistory'])->name('order.sale.history');
    Route::get('/order/sale/create', [OrderController::class, 'getCreateSalePage'])->name('order.sale.create');
    Route::post('/order/sale-product', [OrderController::class, 'sale'])->name('order.sale');
    Route::get('/order/sale/detail/{id}', [OrderController::class, 'saleDetail'])->name('order.sale.detail');
    Route::post('/order/sale/pay', [OrderController::class, 'pay'])->name('order.sale.pay');
    Route::get('/order/{id}', [OrderController::class, 'getById'])->name('order.edit');
    Route::post('/order/sale/payment', [OrderController::class, 'storePayment'])->name('order.sale.payment');

    //Report
    Route::get('/report/product', [ReportController::class, 'reportByProduct'])->name('report.product');


    //Auth
    Route::get('/change-password', [UserController::class, 'getChangePassword'])->name('password.change.get');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change.post');

});
