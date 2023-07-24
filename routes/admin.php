<?php

use Illuminate\Support\Facades\Route;


//we 'll not use admin prefix in this file because already fix in ROute service provider

Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        //        Route::get('/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('showLoginForm');
        //        Route::post('/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login');
        Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'loginForm'])->name('showLoginForm');
        Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
        Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    });

    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');
    Route::get('/edit/{admin}', [\App\Http\Controllers\Admin\AdminController::class, 'editProfile'])->name('editProfile');
    Route::post('/update-profile', [\App\Http\Controllers\Admin\AdminController::class, 'updateProfile'])->name('updateProfile');



    // restaurants routes
    Route::namespace('Restaurant')->prefix('restaurants')->as('restaurant.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\Restaurant\RestaurantsController::class, 'approved'])->name('approved');
        Route::get('/pending', [\App\Http\Controllers\Admin\Restaurant\RestaurantsController::class, 'pending'])->name('pending');
        Route::get('/rejected', [\App\Http\Controllers\Admin\Restaurant\RestaurantsController::class, 'rejected'])->name('rejected');
        Route::get('/form', [\App\Http\Controllers\Admin\Restaurant\RestaurantsController::class, 'form'])->name('form');
        Route::post('/store', [\App\Http\Controllers\Admin\Restaurant\RestaurantsController::class, 'store'])->name('store');
        Route::post('/update', [\App\Http\Controllers\Admin\Restaurant\RestaurantsController::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\Restaurant\RestaurantsController::class, 'destroy'])->name('delete');
        Route::post('/change-status', [\App\Http\Controllers\Admin\Restaurant\RestaurantsController::class, 'changeStatus'])->name('changeStatus');
    });

    // Users routes
    Route::namespace('User')->prefix('users')->as('user.')->group(function () {
        Route::get('/form', [\App\Http\Controllers\Admin\User\UsersController::class, 'form'])->name('form');
        Route::get('/active', [\App\Http\Controllers\Admin\User\UsersController::class, 'active'])->name('active');
        Route::get('/inactive', [\App\Http\Controllers\Admin\User\UsersController::class, 'inActive'])->name('inActive');
        Route::post('/store', [\App\Http\Controllers\Admin\User\UsersController::class, 'store'])->name('store');
        //        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\User\UsersController::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\User\UsersController::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\User\UsersController::class, 'destroy'])->name('delete');
        Route::post('/change-status', [\App\Http\Controllers\Admin\User\UsersController::class, 'changeStatus'])->name('changeStatus');
    });

    //    Category Route's
    Route::namespace('Categories')->prefix('category')->as('category.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\Categories\CategoryController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\Categories\CategoryController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\Categories\CategoryController::class, 'store'])->name('store');
        Route::post('/update', [\App\Http\Controllers\Admin\Categories\CategoryController::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\Categories\CategoryController::class, 'destroy'])->name('delete');
        Route::post('/change-status', [\App\Http\Controllers\Admin\Categories\CategoryController::class, 'changeStatus'])->name('changeStatus');
    });


    //    Product Route's
    Route::namespace('Products')->prefix('product')->as('product.')->group(function () {

        Route::get('/approved', [\App\Http\Controllers\Admin\Products\ProductController::class, 'approved'])->name('approved');
        Route::get('/pending', [\App\Http\Controllers\Admin\Products\ProductController::class, 'pending'])->name('pending');
        Route::get('/rejected', [\App\Http\Controllers\Admin\Products\ProductController::class, 'rejected'])->name('rejected');
        Route::post('/update', [\App\Http\Controllers\Admin\Products\ProductController::class, 'update'])->name('update');
        Route::post('/change-status', [\App\Http\Controllers\Admin\Products\ProductController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/delete', [\App\Http\Controllers\Admin\Products\ProductController::class, 'delete'])->name('delete');
    });

    //    Product Route's
    Route::namespace('Order')->prefix('order')->as('order.')->group(function () {

        Route::get('/pending', [\App\Http\Controllers\Admin\Order\OrderController::class, 'pending'])->name('pending');
        Route::get('/accepted', [\App\Http\Controllers\Admin\Order\OrderController::class, 'accepted'])->name('accepted');
        Route::get('/on-way', [\App\Http\Controllers\Admin\Order\OrderController::class, 'onWay'])->name('on-way');
        Route::get('/complete', [\App\Http\Controllers\Admin\Order\OrderController::class, 'complete'])->name('complete');
        Route::get('/rejected', [\App\Http\Controllers\Admin\Order\OrderController::class, 'rejected'])->name('rejected');
        Route::post('/change-status', [\App\Http\Controllers\Admin\Order\OrderController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/order-accepted-status', [\App\Http\Controllers\Admin\Order\OrderController::class, 'acceptedStatus'])->name('acceptedStatus');
        Route::get('/details/{id}', [\App\Http\Controllers\Admin\Order\OrderController::class, "orderDetails"])->name('orderDetails');
    });

    //    Product Route's
    Route::namespace('Deals')->prefix('deal')->as('deal.')->group(function () {

        Route::get('/approved', [App\Http\Controllers\Admin\Deals\DealController::class, 'approved'])->name('approved');
        Route::get('/pending', [App\Http\Controllers\Admin\Deals\DealController::class, 'pending'])->name('pending');
        Route::get('/rejected', [App\Http\Controllers\Admin\Deals\DealController::class, 'rejected'])->name('rejected');
        Route::post('/change-status', [\App\Http\Controllers\Admin\Deals\DealController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/delete', [\App\Http\Controllers\Admin\Deals\DealController::class, 'destroy'])->name('delete');
    });
    //    Payment Route's
    Route::namespace('Payment')->prefix('payment')->as('payment.')->group(function () {

        Route::get('/', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payment');
        Route::post('/pay', [App\Http\Controllers\Admin\PaymentController::class, 'pay'])->name('pay');
        Route::get('/restaurant', [App\Http\Controllers\Admin\PaymentController::class, 'restaurant'])->name('restaurant_payment');
        Route::post('/restaurant-pay', [App\Http\Controllers\Admin\PaymentController::class, 'restaurant_pay'])->name('restaurant_pay');
    });
    //    Term Route's
    Route::namespace('Term')->prefix('term')->as('term.')->group(function () {

        Route::get('/', [\App\Http\Controllers\Admin\TermController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\TermController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\TermController::class, 'store'])->name('store');
        Route::post('/update', [\App\Http\Controllers\Admin\TermController::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\TermController::class, 'destroy'])->name('delete');
    });
    //    Privacy Route's
    Route::namespace('Privacy')->prefix('privacy')->as('privacy.')->group(function () {

        Route::get('/', [\App\Http\Controllers\Admin\PrivacyController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\PrivacyController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\PrivacyController::class, 'store'])->name('store');
        Route::post('/update', [\App\Http\Controllers\Admin\PrivacyController::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\PrivacyController::class, 'destroy'])->name('delete');
    });
});
