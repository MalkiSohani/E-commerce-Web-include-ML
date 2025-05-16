<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [UserController::class, 'logout'])->name('admin.logout');

Route::prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->middleware(['auth', 'permitted'])->name('admin.users');
    Route::post('/enroll', [UserController::class, 'enroll'])->name('admin.users.enroll')->middleware(['auth']);
    Route::get('/get', [UserController::class, 'getOne'])->name('admin.users.get.one')->middleware(['auth']);
    Route::get('/delete', [UserController::class, 'deleteOne'])->name('admin.users.delete.one')->middleware(['auth']);
    Route::get('/find', [UserController::class, 'find'])->name('admin.users.find.one')->middleware(['auth']);
});

Route::prefix('/usertypes')->group(function () {
    Route::get('/', [UserTypeController::class, 'index'])->middleware(['auth', 'permitted'])->name('admin.usertypes');
    Route::post('/enroll', [UserTypeController::class, 'enroll'])->name('admin.usertypes.enroll')->middleware(['auth']);
    Route::get('/get', [UserTypeController::class, 'getOne'])->name('admin.usertypes.get.one')->middleware(['auth']);
    Route::get('/delete', [UserTypeController::class, 'deleteOne'])->name('admin.usertypes.delete.one')->middleware(['auth']);
});

Route::prefix('/shops')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->middleware(['auth', 'permitted'])->name('admin.shops');
    Route::post('/enroll', [ShopController::class, 'enroll'])->name('admin.shops.enroll')->middleware(['auth']);
    Route::get('/get', [ShopController::class, 'getOne'])->name('admin.shops.get.one')->middleware(['auth']);
    Route::get('/delete', [ShopController::class, 'deleteOne'])->name('admin.shops.delete.one')->middleware(['auth']);
    Route::get('/find', [ShopController::class, 'find'])->name('admin.shops.find.one')->middleware(['auth']);
});

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->middleware(['auth', 'permitted'])->name('admin.products');
    Route::post('/enroll', [ProductsController::class, 'enroll'])->name('admin.products.enroll')->middleware(['auth']);
    Route::get('/get', [ProductsController::class, 'getOne'])->name('admin.products.get.one')->middleware(['auth']);
    Route::get('/delete', [ProductsController::class, 'deleteOne'])->name('admin.products.delete.one')->middleware(['auth']);
    Route::get('/find', [ProductsController::class, 'find'])->name('admin.products.find.one')->middleware(['auth']);
    Route::get('/view/{id}', [ProductsController::class, 'productView'])->name('product.view');
});

Route::prefix('/cart')->group(function () {
    Route::get('/view', [CartController::class, 'view'])->name('cart.view');
    Route::post('/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/payment/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/payment/done', [CartController::class, 'paymentDone'])->name('cart.checkout.pay');
    Route::get('/orders', [CartController::class, 'orders'])->name('orders');
    Route::get('/orders/view/{id}', [CartController::class, 'orderView'])->name('order.view');
    Route::get('/orders/comment', [CartController::class, 'comment'])->name('order.comment');
});
