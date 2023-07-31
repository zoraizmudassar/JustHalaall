<?php

use App\Http\Controllers\API\Customer\CustomerController;
use App\Http\Controllers\Restaurant\Products\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('API\Restaurant')->prefix('restaurant')->as('restaurant.')->middleware('json.response')->group(function () {

    Route::post('signup', [\App\Http\Controllers\API\Restaurant\AuthenticationController::class, 'register'])->name('signup');
    Route::post('login', [\App\Http\Controllers\API\Restaurant\AuthenticationController::class, 'login'])->name('login');
    Route::post('forgetpassword', [\App\Http\Controllers\API\Restaurant\AuthenticationController::class, 'forgetPassword'])->name('forgetPassword');
    Route::post('verify-otp', [\App\Http\Controllers\API\Restaurant\AuthenticationController::class, 'verifyOtp'])->name('verifyOtp');
    Route::post('resend-otp', [\App\Http\Controllers\API\Restaurant\AuthenticationController::class, 'resendOtp'])->name('resendOtp');
    Route::post('change-password', [\App\Http\Controllers\API\Restaurant\AuthenticationController::class, 'changePassword'])->name('changePassword');


    Route::middleware(['auth:restaurant-api', 'Restaurant'])->group(function () {

        Route::post('get-profile', [\App\Http\Controllers\API\Restaurant\RestaurantController::class, 'getProfile'])->name('getProfile');
        Route::post('edit-profile', [\App\Http\Controllers\API\Restaurant\RestaurantController::class, 'editProfile'])->name('editProfile');
        Route::post('account-details', [\App\Http\Controllers\API\Restaurant\RestaurantController::class, 'accountDetails'])->name('accountDetails');
        Route::post('add-product', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'addProduct'])->name('addProduct');
        Route::get('delete-product', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'deleteProduct'])->name('deleteProduct');
        Route::post('edit-product', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'editProduct'])->name('editProduct');
        Route::get('product-details', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'productDetails'])->name('productDetails');
        Route::get('product-list', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'productList'])->name('productList');
        Route::get('featured-product-list', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'featuredProductList'])->name('featuredProductList');
        Route::post('add-featured-product', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'addFeaturedProduct'])->name('addFeaturedProduct');
        Route::get('delete-featured-product', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'deleteFeaturedProduct'])->name('deleteFeaturedProduct');
        Route::post('edit-featured-product', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'editFeaturedProduct'])->name('editFeaturedProduct');
        Route::get('featured-product-details', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'featuredProductDetails'])->name('featuredProductDetails');
        Route::get('enable-featured-product', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'enableFeaturedProduct'])->name('enableFeaturedProduct');
        Route::get('disable-featured-product', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'disableFeaturedProduct'])->name('disableFeaturedProduct');
        Route::get('dashboard', [\App\Http\Controllers\API\Restaurant\ProductController::class, 'dashBoard'])->name('dashBoard');

        //       Deals Route's
        Route::post('add-new-deal', [\App\Http\Controllers\API\Restaurant\DealController::class, 'addNewDeal'])->name('addNewDeal');
        Route::get('delete-deal', [\App\Http\Controllers\API\Restaurant\DealController::class, 'deleteDeal'])->name('deleteDeal');
        Route::post('edit-deal', [\App\Http\Controllers\API\Restaurant\DealController::class, 'editDeal'])->name('editDeal');
        Route::get('deal-details', [\App\Http\Controllers\API\Restaurant\DealController::class, 'dealDetail'])->name('dealDetail');
        Route::get('restaurant-deal-list', [\App\Http\Controllers\API\Restaurant\DealController::class, 'restaurantDealList'])->name('restaurantDealList');

        //        Route::post('test',[\App\Http\Controllers\API\Restaurant\CategoryController::class,'categoryList'])->name('test');

        // Orders Route's
        //        Route::post('pending-orders',[\App\Http\Controllers\API\Restaurant\OrderController::class,'pendingOrders'])->name('pendingOrders');
        Route::post('order-detail', [\App\Http\Controllers\API\Restaurant\OrderController::class, 'orderDetail'])->name('orderDetail');
        Route::post('order-list', [\App\Http\Controllers\API\Restaurant\OrderController::class, 'orderList'])->name('orderList');
        Route::post('history', [\App\Http\Controllers\API\Restaurant\OrderController::class, 'history'])->name('history');
        Route::post('history-online-payment', [\App\Http\Controllers\API\Restaurant\OrderController::class, 'historyOnlinePayment'])->name('historyOnlinePayment');
        Route::post('history-cod', [\App\Http\Controllers\API\Restaurant\OrderController::class, 'historyCOD'])->name('historyCOD');
        Route::post('order-status-change', [\App\Http\Controllers\API\Restaurant\OrderController::class, 'orderStatusChange'])->name('orderStatusChange');
        Route::post('order-statuses', [\App\Http\Controllers\API\Restaurant\OrderController::class, 'orderStatuses'])->name('orderStatuses');

        //        Category Route's
        Route::post('category-list', [\App\Http\Controllers\API\Restaurant\CategoryController::class, 'list'])->name('category-list');
        Route::post('edit-account', [\App\Http\Controllers\API\Restaurant\AccountController::class, 'editAccount'])->name('editAccount');

    });
});
//Customer Side Api's Routes
Route::namespace('API\Customer')->prefix('customer')->as('customer.')->middleware('json.response')->group(function () {

    Route::get('social-login/{driver}', [\App\Http\Controllers\API\SocialController::class, 'redirectToProvider'])->name('social');
    Route::post('store-social', [\App\Http\Controllers\API\SocialController::class, 'socialLogin'])->name('callback');

    Route::post('signup', [\App\Http\Controllers\API\Customer\AuthenticationController::class, 'register'])->name('signup');
    Route::match(['get', 'post'],'login', [\App\Http\Controllers\API\Customer\AuthenticationController::class, 'login'])->name('login');
    Route::post('forget-password', [\App\Http\Controllers\API\Customer\AuthenticationController::class, 'forgetPassword'])->name('forgetPassword');
    Route::post('verify-otp', [\App\Http\Controllers\API\Customer\AuthenticationController::class, 'verifyOtp'])->name('verifyOtp');
    Route::post('changeForgetPassword', [\App\Http\Controllers\API\Customer\AuthenticationController::class, 'changeForgetPassword'])->name('changeForgetPassword');
    Route::post('resend-otp', [\App\Http\Controllers\API\Customer\AuthenticationController::class, 'resendOtp'])->name('resendOtp');
    Route::get('getDashboard', [CustomerController::class, 'getDashboard'])->name('getDashboard');
    Route::get('getRestaurant', [CustomerController::class, 'getRestaurant'])->name('getRestaurant');
    Route::get('searchRestaurant', [CustomerController::class, 'searchRestaurant'])->name('searchRestaurant');
    Route::get('restaurantDetail', [CustomerController::class, 'restaurantDetail'])->name('restaurantDetail');
    Route::get('restaurantProducts', [CustomerController::class, 'restaurantProducts'])->name('restaurantProducts');
    Route::get('restaurantFeaturedProducts', [CustomerController::class, 'restaurantFeaturedProducts'])->name('restaurantFeaturedProducts');
    Route::get('restaurantDeals', [CustomerController::class, 'restaurantDeals'])->name('restaurantDeals');
    Route::get('searchFood', [CustomerController::class, 'searchFood'])->name('searchFood');
    Route::get('restaurantProductDetail', [CustomerController::class, 'restaurantProductDetail'])->name('restaurantProductDetail');
    Route::get('restaurantDealDetail', [CustomerController::class, 'restaurantDealDetail'])->name('restaurantDealDetail');
    Route::get('categoryList', [CustomerController::class, 'categoryList'])->name('categoryList');
    Route::post('getProfile', [CustomerController::class, 'getProfile'])->name('getProfile');
    Route::post('updateProfile', [CustomerController::class, 'updateProfile'])->name('updateProfile');
    Route::post('change-password', [\App\Http\Controllers\API\Customer\AuthenticationController::class, 'changePassword'])->name('changePassword');
    Route::get('categoryProducts', [CustomerController::class, 'categoryProducts'])->name('categoryProducts');

    Route::get('rating', [\App\Http\Controllers\API\Restaurant\RatingController::class, 'index'])->name('rating');
    Route::post('rating-store', [\App\Http\Controllers\API\Restaurant\RatingController::class, 'store'])->name('rating.store');
    Route::get('term', [\App\Http\Controllers\API\TermPrivacyController::class, 'term'])->name('term');
    Route::get('privacy', [\App\Http\Controllers\API\TermPrivacyController::class, 'privacy'])->name('privacy');

    // Route::middleware(['auth:customer-api'])->group(function (){
    //     Route::post('change-password',[\App\Http\Controllers\API\Customer\AuthenticationController::class,'changePassword'])->name('changePassword');
    // });


});



Route::middleware(['json.response'])->group(function () {
    Route::get('cartList', [CartController::class, 'cartList'])->name('cartList');
    Route::get('total-cart', [CartController::class, 'cartTotal']);
    Route::post('addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('removeFromCart', [CartController::class, 'removeFromCart'])->name('removeFromCart');

    Route::get('wish-list', [CartController::class, 'wishList'])->name('wishList');
    Route::post('add-to-wish-list', [CartController::class, 'addToWishList'])->name('addToWishList');
    Route::get('remove-to-wish-list/{id}', [CartController::class, 'removeToWishList'])->name('removeToWishList');

    Route::post('checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('stripe-payment/{amount}', [CartController::class, 'stripePayment'])->name('stripePayment');
    Route::get('orderList/{order_status?}', [CartController::class, 'orderList'])->name('orderList');
    Route::post('updateOrderStatus', [CartController::class, 'updateOrderStatus'])->name('updateOrderStatus');
    Route::post('get-delivery-charges', [CartController::class, 'getDeliveryCharges'])->name('getDeliveryCharges');
});
