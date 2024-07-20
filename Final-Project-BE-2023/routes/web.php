<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ToyController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::controller(AppController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', 'login')->name('login'); // login view working
        Route::get('register', 'register')->name('register'); // register view working
        route::post('login', 'userLogin')->name('user.login'); // login repository working
        route::post('register', 'userRegister')->name('user.register'); // register repository working
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', 'logout')->name('logout'); // logout repository working
        Route::get('account', 'userAccount')->name('user.account'); // user account working
        Route::get('topup', 'userTopup')->name('user.topup'); // topup page working
        Route::post('topup/add_balance', 'userAddBalance')->name('user.add'); // working
        Route::get('transaction/payment/{total}', 'userReduceBalance')->name('payment'); // reduce balance working

        Route::middleware([AdminMiddleware::class])->group(function () { // middleware working
            Route::get('admin', 'administration')->name('admin.home'); // repo admin working
            Route::get('admin/filter/{category}', 'filter')->name('admin.filter'); // repo filter working
            Route::get('admin/search', 'admin_search')->name('admin.search'); // working
        });
    });

    Route::get('/', 'index')->name('home'); // home page working
    Route::get('search', 'search')->name('home.search'); // working
    Route::get('product', 'product')->name('home.product'); // header working
    Route::get('product/filter/{category}', 'filter_product')->name('product.filter'); // repo filter working
    Route::get('detail/product/{toy}', 'detail')->name('product.detail'); // detail view working
});

Route::prefix('toys')->controller(ToyController::class)->group(function () {
    Route::get('create', 'create')->name('toys.create'); // create view controller working
    Route::post('createToy', 'createToy')->name('toys.creation'); // create repo working
    Route::get('edit/{toy}', 'edit')->name('toys.edit'); // update / edit view controller working
    Route::post('update/{toy}', 'update')->name('toys.update'); // update / view repo working
    Route::delete('delete/{toy}', 'delete')->name('toys.delete'); // delete repo and view working
    Route::get('order/{toy}', 'order')->name('toys.order'); // order repo working
    Route::delete('order/delete/{id}', 'deleteOrder')->name('toys.order.delete'); // delete repo working
});

Route::controller(InvoiceController::class)->group(function() {
    Route::middleware('auth')->group(function () {
        Route::get('invoice', 'index')->name('invoice.home'); // view invoice working
    });
});

Route::controller(CheckoutController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('cart', 'cart')->name('cart.home'); // view cart working
        Route::post('cart/update', 'cart')->name('cart.update'); // update cart
        Route::post('checkout', 'store')->name('checkout.store'); // checkout working
    });
});
